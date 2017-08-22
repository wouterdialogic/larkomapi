<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAGemeentecodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('a_gemeentecode', function(Blueprint $table)
		{
			$table->string('gemcode', 10)->primary();
			$table->string('provcode', 5);
			$table->string('gemnaam', 75);
			$table->string('provenaam', 75);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('a_gemeentecode');
	}

}
