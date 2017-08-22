<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerOrganisationalunitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_organisationalunit', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('created_date');
			$table->dateTime('modified_date')->nullable();
			$table->integer('created_by_id')->nullable()->index();
			$table->integer('modified_by_id')->nullable()->index();
			$table->integer('ownedby_organisation_id')->nullable()->index();
			$table->integer('status')->nullable();
			$table->boolean('is_deleted');
			$table->string('name', 256);
			$table->string('abbreviation', 32);
			$table->string('type', 3);
			$table->integer('main_location_id')->nullable()->index();
			$table->integer('contact_id')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_organisationalunit');
	}

}
