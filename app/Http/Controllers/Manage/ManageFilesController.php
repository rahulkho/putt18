<?php


namespace App\Http\Controllers\Manage;


class ManageFilesController extends \EMedia\Oxygen\Http\Controllers\Manage\ManageFilesController
{

	protected $uploadDisk = 'public';

	/**
	 *
	 * Show a file on browser
	 *
	 * @param $uuid
	 *
	 * @return mixed
	 * @throws \EMedia\FileControl\Exceptions\FailedToResolvePathException
	 */
	public function publicView($uuid)
	{
		$file = $this->dataRepo->findByUuid($uuid);

		if (!$file) abort(404);

		// check if the user is allowed to see this file here
		if (!$file->allow_public_access) {
			$user = auth()->user();
			if (!$user) {
				// handle api requests
				if (request()->header('x-api-key')) {
					$user = \EMedia\Devices\Auth\DeviceAuthenticator::getUserByAccessToken();
				}
			}
			if (!$user) abort(401);
		}

		// TODO: add any other file access permission checks here

		$filePath = $this->resolvePathFromFile($file);

		return response()->file($filePath);
	}

}