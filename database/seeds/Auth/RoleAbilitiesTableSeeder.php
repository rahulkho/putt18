<?php

use EMedia\MultiTenant\Facades\TenantManager;
use EMedia\Oxygen\Database\Seeds\Traits\SeedsPermissions;
use Illuminate\Database\Seeder;

class RoleAbilitiesTableSeeder extends Seeder
{

	use SeedsPermissions;

	private $abilityModel;
	private $roleModel;

	public function __construct()
	{
		$this->abilityModel = app(config('oxygen.abilityModel'));
		$this->roleModel    = app(config('oxygen.roleModel'));
	}


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (TenantManager::multiTenancyIsActive())
		{
			$tenant = app(config('auth.tenantModel'))->find(1);
			TenantManager::setTenant($tenant);
		}
		$this->assignSuperAdminPermissions();
		$this->assignAdminPermissions();
	}


	/**
	 *
	 * Give all permissions to Super-Admins
	 *
	 */
	private function assignSuperAdminPermissions()
	{
		$allAbilities = $this->abilityModel->all();
		$adminRoles   = $this->roleModel->where('name', 'super-admin')->get();

		foreach($adminRoles as $adminRole) {
			$adminRole->abilities()->sync($allAbilities, false);
		}
	}


	/**
	 *
	 * Assign permissions to admins
	 *
	 */
	private function assignAdminPermissions()
	{
		$this->assignPermissionsToRole('admin', [
			'user-management',
		], [], [], false);
	}


	// TODO: add additional role permissions

}
