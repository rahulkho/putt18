<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
			$table->increments('id');

			$table->string('uuid')->unique()->nullable();
			$table->string('key')->unique()->nullable();
			$table->string('category')->nullable();
			$table->string('name')->nullable();
			$table->text('description')->nullable();
			$table->nullableMorphs('attachable');
			$table->boolean('allow_public_access')->default(false);
			$table->string('original_filename')->nullable();
			$table->string('file_path')->nullable();
			$table->string('file_disk')->nullable();
			$table->string('file_url')->nullable();
			$table->bigInteger('file_size_bytes')->unsigned()->nullable();
			$table->integer('uploaded_by_user_id')->nullable()->references('id')->on('users');

			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('files');
	}
}
