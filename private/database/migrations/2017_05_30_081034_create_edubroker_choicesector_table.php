<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerChoicesectorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_choicesector', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 256);
			$table->string('skd_Sector_CD', 8);
			$table->boolean('is_obsolete')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_choicesector');
	}

}
