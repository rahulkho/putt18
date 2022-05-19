<?php


namespace App\Http\Controllers\Auth\Admin;


use App\Http\Controllers\Controller;

class AccessController extends Controller
{

	public function index()
	{
		$data = [
			'pageTitle' => 'Manage Access Permissions',
		];

		return view('oxygen::auth.admin.access', $data);
	}

}