<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerOrganisationFromOudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_organisation_from_oud', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('from_name', 256);
			$table->string('from_abbreviation', 32);
			$table->string('from_type', 1);
			$table->string('from_url', 200);
			$table->boolean('from_participates');
			$table->integer('from_skd_Instelling_ID');
			$table->string('from_brin_code', 4);
			$table->boolean('from_is_obsolete');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_organisation_from_oud');
	}

}
