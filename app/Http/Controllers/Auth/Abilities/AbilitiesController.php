<?php

namespace App\Http\Controllers\Auth\Abilities;

use App\Entities\Auth\AbilityCategoryRepository;
use EMedia\MultiTenant\Facades\TenantManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Bouncer;

class AbilitiesController extends Controller
{

	protected $abilitiesRepository;
	protected $roleRepository;
	protected $tenantRepository;
	protected $abilityCategoryRepository;

	/**
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->ablilityRepository   = app(config('oxygen.abilityRepository'));
		$this->roleRepository		= app(config('oxygen.roleRepository'));
		$this->abilityCategoryRepository = new AbilityCategoryRepository();

		if (TenantManager::multiTenancyIsActive()) $this->tenantRepository = app(config('auth.tenantRepository'));

		// access control
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

		return view('oxygen::abilities.abilities-all', compact('allItems'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		$this->validate($request, [
			'category_name' => 'required',
			'abilities'		=> 'required'
		]);

		$model = $this->abilityCategoryRepository->create([
			'display_name' => request()->get('category_name')
		]);

		$this->abilityCategoryRepository->addAbilities($model, request()->get('abilities'));

		return back()->with('success', 'New category added.');
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
		return view('oxygen::abilities.abilities-edit', compact('item'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'display_name' => 'required',
			'default_categories' => 'required'
		]);

		$item = $this->abilityCategoryRepository->find($id);
		$item->fill(request()->all());
		$item->default_categories = json_encode(request()->get('default_categories'));
		$item->save();

		return back()->with('success', 'The records are updated.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
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
