<?php

namespace App\Http\Controllers\Auth\Abilities;

use App\Entities\Auth\AbilityCategoryRepository;
use EMedia\MultiTenant\Facades\TenantManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Silber\Bouncer\Bouncer;

class AbilityCategoriesController extends Controller
{

	protected $abilityRepository;
	protected $roleRepository;
	protected $tenantRepository;
	protected $abilityCategoryRepository;

	/**
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->abilityRepository = app(config('oxygen.abilityRepository'));
		$this->roleRepository = app(config('oxygen.roleRepository'));
		$this->abilityCategoryRepository = new AbilityCategoryRepository();

		if (TenantManager::multiTenancyIsActive()) $this->tenantRepository = app(config('auth.tenantRepository'));

		// access control
		// view, create -> admin/super admin
		// edit, delete -> super admin
		$this->middleware('auth.acl:permissions[view-permissions]', ['only' => [
			'index'
		]]);

		$this->middleware('auth.acl:permissions[add-permissions]', ['only' => [
			'create', 'store'
		]]);

		$this->middleware('auth.acl:permissions[edit-permissions]', ['only' => [
			'edit', 'update', 'editRoleAbilities', 'updateRoleAbilities'
		]]);

		$this->middleware('auth.acl:permissions[delete-permissions]', ['only' => [
			'destroy'
		]]);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$allItems = $this->abilityCategoryRepository->paginate(20, ['abilities']);
		return view('oxygen::ability-categories.index', compact('allItems'));
	}

	public function create()
	{
		$item = $this->abilityCategoryRepository->newModel();
		return view('oxygen::ability-categories.edit', compact('item'));
	}

	protected function validateRequest($request)
	{
		$this->validate($request, [
			'name' => 'required',
			'default_abilities' => 'required',

			// display_name is required, only if name is given
			'permission::name' => 'required_with:permission::name|array|match_count_with:permission::name',
			'permission::id' => 'required_with:permission::name|array|match_count_with:permission::name'
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validateRequest($request);

		return $this->saveOrUpdate($request);
	}

	protected function saveOrUpdate($request, $categoryId = null)
	{
		if ($categoryId) {
			$category = $this->abilityCategoryRepository->find($categoryId);
		} else {
			$category = $this->abilityCategoryRepository->newModel();
		}
		$category->fill(request()->all());
		$category->default_abilities = json_encode(request()->get('default_abilities'));
		$category->save();

		// set/update the permissions for this category
		$abilityIds = request()->get('permission::id');
		$abilityNames = request()->get('permission::name');
		$abilityDisplayNames = request()->get('permission::title');

		$errors = [];
		$updatedAbilityIds = [];
		for ($i = 0; $i < (is_countable($abilityIds) ? count($abilityIds) : 0); $i++) {
			// if there's a record, update it, else, create new
			$abilityId = $abilityIds[$i];
			$name = $abilityNames[$i];
			$displayName = $abilityDisplayNames[$i];

			if (empty($displayName)) {
				// can't continue without a display name
				$errors[] = 'At least one display name is missing.';
				continue;
			}

			if (!empty($abilityId)) {
				$ability = $this->abilityRepository->find($abilityId);
				if (!empty($name)) $ability->name = $name;
			} else {
				$ability = $this->abilityRepository->newModel();
				$ability->ability_category_id = $category->id;
			}

			$ability->title = $displayName;
			$ability->save();
			$updatedAbilityIds[] = $ability->id;
		}

		// remove deleted ones
		$newAbility = $this->abilityRepository->newModel();
		$newAbility->where('ability_category_id', $category->id)
				   ->whereNotIn('id', $updatedAbilityIds)
				   ->delete();

		if (count($errors))
			return back()->with('error', implode(' ', $errors));

		return back()->with('success', 'The records are updated.');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$item = $this->abilityCategoryRepository->find($id, ['abilities']);
		return view('oxygen::ability-categories.edit', compact('item'));
	}

	public function update(Request $request, $id)
	{
		$this->validateRequest($request);

		// TODO: FIX: duplicate 'name' fields with the same value causes an error

		return $this->saveOrUpdate($request, $id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$this->abilityRepository->deleteByCategory($id);
		$this->abilityCategoryRepository->delete($id);
		return back()->with('success', 'Permissions category deleted.');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function editRoleAbilities($roleId)
	{
		$abilityCategories  = $this->abilityCategoryRepository->all(['abilities']);
		$role = $this->roleRepository->find($roleId);

		$currentAbilities = Arr::pluck($role->abilities->toArray(), 'name');

		return view('oxygen::abilities.abilities-editRoleAbilities', compact('abilityCategories', 'currentAbilities', 'role'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateRoleAbilities(Request $request, $roleId)
	{
		$role = $this->roleRepository->find($roleId);

		$existingAbilities = $role->abilities;
		$existingAbilities = Arr::pluck($existingAbilities->toArray(), 'name');

		$newAbilities = request()->get('abilities');
		if (!$newAbilities) $newAbilities = [];

		// TODO: SEC: we're using user input as the key - retrieve this from DB for better security

		// add the new permissions
		$abilitiesToAdd = array_diff($newAbilities, $existingAbilities);
		foreach ($abilitiesToAdd as $abilityName)
			Bouncer::allow($role->name)->to($abilityName);

		// remove non-existing ones
		$abilitiesToRemove = array_diff($existingAbilities, $newAbilities);
		foreach($abilitiesToRemove as $abilityName)
			Bouncer::disallow($role->name)->to($abilityName);


		$message = count($abilitiesToAdd) . ' permissions granted. ' . count($abilitiesToRemove) . ' permissions revoked.';

		return back()->with('success', $message);
	}
}
