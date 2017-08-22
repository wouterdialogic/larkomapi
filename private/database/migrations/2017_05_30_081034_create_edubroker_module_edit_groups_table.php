<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerModuleEditGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_module_edit_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('module_id')->index();
			$table->integer('edubrokergroup_id')->index();
			$table->unique(['module_id','edubrokergroup_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_module_edit_groups');
	}

}
