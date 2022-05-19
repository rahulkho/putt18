<?php

use EMedia\MultiTenant\Facades\TenantManager;
use EMedia\QuickData\Database\Seeds\Traits\SeedsWithoutDuplicates;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

	use SeedsWithoutDuplicates;

	public function run()
	{
		$this->seedRoles();
	}

	public function seedRoles()
	{
		$defaultRoles = [
			[
				'title' 		=> 'Super Admin',
				'description' 	=> 'Super Admins of the system (For Developer/SysAdmin Use)',
				'allow_to_be_deleted' => false,
			],
			[
				'title' 		=> 'Admin',
				'description' 	=> 'Admins of the system (For Clients)',
				'allow_to_be_deleted' => false,
			],
			[
				'title' 		=> 'User',
				'description' 	=> 'Regular Users of the System',
				'assign_by_default'   => true,
				'allow_to_be_deleted' => false,
			],
			/*
			[
				'title' 		=> 'Business',
				'description' 	=> 'Business User of the System',
				'assign_by_default'   => false,
				'allow_to_be_deleted' => false,
			],
			*/
		];

		$roleModel = config('oxygen.roleModel');
		if (TenantManager::multiTenancyIsActive())
		{
			$tenant = app(config('auth.tenantModel'))->find(1);
			TenantManager::setTenant($tenant);
		}
		$this->seedButDontCreateDuplicates($defaultRoles, $roleModel, 'title', 'name');

	}

	protected function appendCustomFields($entityModel, $entityData)
	{
		if (isset($entityData['allow_to_be_deleted'])) {
			$entityModel->allow_to_be_deleted = $entityData['allow_to_be_deleted'];
			$entityModel->save();
		}

		if (isset($entityData['assign_by_default'])) {
			$entityModel->assign_by_default = $entityData['assign_by_default'];
			$entityModel->save();
		}
	}
}
