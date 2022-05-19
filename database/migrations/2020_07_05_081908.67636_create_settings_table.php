<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function($table) {
			$table->increments('id');
			$table->string('setting_key', 100)->index()->unique('key');
			$table->string('setting_data_type')->nullable();
			$table->text('setting_value', 65535)->nullable();
			$table->string('description')->nullable();
			$table->boolean('is_key_editable')->default(true);
			$table->boolean('is_value_editable')->default(true);
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
		Schema::drop('settings');
    }
}
