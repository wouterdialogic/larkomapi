<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerOrganisationalunitEditGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_organisationalunit_edit_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('organisationalunit_id')->index();
			$table->integer('edubrokergroup_id')->index();
			$table->unique('organisationalunit_id');
			$table->unique('edubrokergroup_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_organisationalunit_edit_groups');
	}

}
