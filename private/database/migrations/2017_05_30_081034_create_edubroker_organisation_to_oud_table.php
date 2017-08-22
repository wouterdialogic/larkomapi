<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerOrganisationToOudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_organisation_to_oud', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('to_name', 256);
			$table->string('to_abbreviation', 32);
			$table->string('to_type', 1);
			$table->string('to_url', 200);
			$table->boolean('to_participates');
			$table->integer('to_skd_Instelling_ID');
			$table->string('to_brin_code', 4);
			$table->boolean('to_is_obsolete');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_organisation_to_oud');
	}

}
