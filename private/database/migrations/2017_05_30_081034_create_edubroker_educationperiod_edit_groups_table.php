<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerEducationperiodEditGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_educationperiod_edit_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('educationperiod_id')->index();
			$table->integer('edubrokergroup_id')->index();
			$table->unique('edubrokergroup_id');
			$table->unique('educationperiod_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_educationperiod_edit_groups');
	}

}
