<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerStudyprogrammeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_studyprogramme', function(Blueprint $table)
		{
			$table->integer('study_id')->index();
			$table->string('study_name', 191)->index();
			$table->string('study_shortname', 191);
			$table->string('study_englishname', 191);
			$table->string('study_type', 1);
			$table->string('study_skd_isat', 11);
			$table->string('study_level', 1);
			$table->boolean('study_is_obsolete');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_studyprogramme');
	}

}
