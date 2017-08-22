<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerPersonEditGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_person_edit_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('person_id')->index();
			$table->integer('edubrokergroup_id')->index();
			$table->unique(['person_id','edubrokergroup_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_person_edit_groups');
	}

}
