<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerStudyprogrammeOrganisationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_studyprogramme_organisations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('studyprogramme_id')->index();
			$table->integer('organisation_id')->index();
			$table->unique('studyprogramme_id');
			$table->unique('organisation_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_studyprogramme_organisations');
	}

}
