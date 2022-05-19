<?php

use App\Entities\Auth\RolesRepository;
use App\Entities\Auth\UsersRepository;
use EMedia\Helpers\Exceptions\Auth\UserNotFoundException;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{

	private $usersRepo;
	private $rolesRepo;

	public function __construct(UsersRepository $usersRepo, RolesRepository $rolesRepo)
	{
		$this->usersRepo = $usersRepo;
		$this->rolesRepo = $rolesRepo;
	}

	public function run()
	{
		if (!app()->environment('production')) {
			$this->seedUserRoles();
		}
	}

	protected function seedUserRoles()
	{
		$user = $this->usersRepo->find(1);
		if (!$user) throw new UserNotFoundException("A user with an ID of 1 not found.");
		$this->assignRoleToEmail($user->email, 'super-admin');

		$user = $this->usersRepo->find(2);
		if (!$user) throw new UserNotFoundException("A user with an ID of 2 not found.");
		$this->assignRoleToEmail($user->email, 'admin');
	}

	/**
	 *
	 * Assign a role to a given user by email
	 *
	 * @param $email
	 * @param $roleName
	 */
	protected function assignRoleToEmail($email, $roleName)
	{
		$user = $this->getUserByEmail($email);
		$role = $this->getRoleByName($roleName);
		$user->roles()->save($role);
	}

	/**
	 *
	 * Get a user by email
	 *
	 * @param $email
	 *
	 * @return mixed
	 */
	protected function getUserByEmail($email)
	{
		$user = $this->usersRepo->findByEmail($email);
		if (!$user) throw new InvalidArgumentException("Unable to find a user with email {$email}.");

		return $user;
	}

	/**
	 *
	 * Get a role by name
	 *
	 * @param $roleName
	 *
	 * @return mixed
	 */
	private function getRoleByName($roleName)
	{
		$role = $this->rolesRepo->findByName($roleName);
		if (!$role) throw new InvalidArgumentException("Unable to find a role with the name {$roleName}.");

		return $role;
	}

}