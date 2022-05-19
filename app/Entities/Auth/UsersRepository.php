<?php


namespace App\Entities\Auth;


use App\Entities\BaseRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UsersRepository extends BaseRepository
{

	public function __construct(User $model)
	{
		parent::__construct($model);
	}

	/**
	 *
	 * Find user by email
	 *
	 * @param $email
	 *
	 * @return mixed
	 */
	public function findByEmail($email)
	{
		return $this->model->where('email', $email)->first();
	}

	/**
	 *
	 * Get users who belongs to a role, excluding a given Users collection.
	 *
	 * @param array           $roleNames
	 * @param Collection|null $excludeUsers
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getUsersInRole(array $roleNames, Collection $excludeUsers = null, $onlyActive = true)
	{
		$query = User::query();

		// get only active users
		if ($onlyActive) $query->active();

		$query->whereHas('roles', function ($q) use ($roleNames) {
			$q->whereIn('name', $roleNames);
		});
		
		if ($excludeUsers) $query->whereNotIn('id', $excludeUsers->pluck('id'));

		return $query->get();
	}


	public function searchUsersInRole(array $roleNames, $searchQuery = null, $perPage = null, $orderBy = [], $relationships = [], Collection $excludeUsers = null, $onlyActive = true)
	{
		$searchQuery = ($searchQuery)?: request()->get('q');

		$query = $this->model->query();

		if ($searchQuery) $query->search($searchQuery);

		// get only active users
		if ($onlyActive) $query->active();

		$query->orderBy('id', 'desc');
		if (!empty($orderBy)) {
			foreach ($orderBy as $orderCol => $orderDirection) {
				$query->orderBy($orderCol, $orderDirection);
			}
		}

		if (!empty($relationships)) {
			$query->with($relationships);
		}

		$query->whereHas('roles', function ($q) use ($roleNames) {
			$q->whereIn('name', $roleNames);
		});

		if ($excludeUsers) $query->whereNotIn('id', $excludeUsers->pluck('id'));

		$perPage = ($perPage)?: config('oxygen.dashboard.perPage', 20);

		return $query->paginate($perPage);
	}

	public function disable(User $instance)
	{
		$instance->disabled_at = Carbon::now();
		if (auth()->user()) $instance->disabled_by_user_id = auth()->user()->id;
		$instance->save();
		return $instance;
	}

	public function enable(User $instance)
	{
		$instance->disabled_at = null;
		// we're not intentionally removing the disabled user_id
		$instance->save();
		return $instance;
	}

	public function getUserByEmail($email, $onlyActiveUsers = true)
	{
		$query = User::where('email', $email);

		if ($onlyActiveUsers) $query->whereNull('disabled_at');

		return $query->first();
	}

}