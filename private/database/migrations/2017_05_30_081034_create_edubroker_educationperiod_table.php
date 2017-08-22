<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerEducationperiodTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_educationperiod', function(Blueprint $table)
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
			$table->date('startdate')->nullable();
			$table->date('enddate')->nullable();
			$table->date('enroll_startdate')->nullable();
			$table->date('enroll_enddate')->nullable();
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
		Schema::drop('e_educationperiod');
	}

}
