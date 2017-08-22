<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerModuleContainsmodulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_module_containsmodules', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('from_module_id')->index();
			$table->integer('to_module_id')->index();
			$table->unique('from_module_id');
			$table->unique('to_module_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_module_containsmodules');
	}

}
