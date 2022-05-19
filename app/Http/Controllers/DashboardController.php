<?php

namespace App\Http\Controllers;

use App\User;
use EMedia\Devices\Entities\Devices\Device;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{

	public function dashboard()
	{
		$data = [
			'appName' => config('app.name'),
			'pageTitle' => config('app.name') . ' Dashboard',
		];

		$metrics = new Collection();
		$metrics->push([
			'title' => 'Total Users',
			'count' => User::count(),
			'description' => 'Current registered users',
			'route' => 'manage.users.index',
		]);

		$metrics->push([
			'title' => 'Total Devices',
			'count' => Device::count(),
			'description' => 'Current registered devices',
			'route' => 'manage.devices.index',
		]);

		$data['metrics'] = $metrics;

		return view('oxygen::dashboard.dashboard', $data);
	}

}
