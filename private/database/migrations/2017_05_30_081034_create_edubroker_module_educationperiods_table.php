<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerModuleEducationperiodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_module_educationperiods', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('module_id')->index();
			$table->integer('educationperiod_id')->index();
			$table->unique(['module_id','educationperiod_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_module_educationperiods');
	}

}
