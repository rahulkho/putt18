<?php

namespace App\Entities\Files;

use App\Entities\BaseRepository;

class FilesRepository extends BaseRepository
{

	public function __construct(File $model)
	{
		parent::__construct($model);
	}

	public function findByUuid($uuid)
	{
		return File::where('uuid', $uuid)->first();
	}

	public function findByKey($key)
	{
		return File::where('key', $key)->first();
	}

	public function addSearchQueryFilters($query)
	{
		$query->where('category', 'admin_uploads');
	}

	public function getByUuids(array $uuids)
	{
		return File::whereIn('uuid', $uuids)->get();
	}
}