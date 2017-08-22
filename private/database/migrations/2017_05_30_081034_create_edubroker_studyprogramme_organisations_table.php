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
		Schema::create('e_studyprogramme_organisations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('studyprogramme_id')->index();
			$table->integer('organisation_id')->index();
			$table->unique('organisation_id');
			$table->unique('studyprogramme_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_studyprogramme_organisations');
	}

}
