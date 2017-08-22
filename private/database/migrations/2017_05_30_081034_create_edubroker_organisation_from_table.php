<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerOrganisationFromTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_organisation_from', function(Blueprint $table)
		{
			$table->integer('from_id', true);
			$table->string('from_name', 191)->index();
			$table->string('from_abbreviation', 32);
			$table->string('from_type', 1);
			$table->string('from_url', 191);
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
		Schema::drop('e_organisation_from');
	}

}
