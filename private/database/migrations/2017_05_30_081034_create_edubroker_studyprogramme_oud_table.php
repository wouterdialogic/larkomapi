<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerStudyprogrammeOudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_studyprogramme_oud', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 256);
			$table->string('shortname', 256);
			$table->string('englishname', 256);
			$table->string('type', 1);
			$table->string('skd_isat', 11);
			$table->string('level', 1);
			$table->boolean('is_obsolete');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_studyprogramme_oud');
	}

}
