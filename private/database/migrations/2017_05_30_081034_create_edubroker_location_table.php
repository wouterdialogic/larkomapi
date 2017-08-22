<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_location', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('ownedby_organisation_id')->index();
			$table->string('name', 256);
			$table->boolean('primarylocation');
			$table->string('skd_Vestiging_ID', 8);
			$table->string('url', 200);
			$table->string('mailaddress', 256);
			$table->string('mailzip', 16);
			$table->string('mailcity', 256);
			$table->string('visitingaddress', 256);
			$table->string('visitingzip', 16);
			$table->string('visitingcity', 256);
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
		Schema::drop('e_location');
	}

}
