<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerAgreementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_agreement', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('student_id')->index();
			$table->integer('module_id')->index();
			$table->string('reference_number', 50);
			$table->string('module_name', 256)->nullable()->index();
			$table->string('module_code', 32);
			$table->decimal('module_ects', 5, 1)->nullable();
			$table->string('module_educationtype', 2);
			$table->integer('organisation_from_id')->index();
			$table->integer('organisation_to_id')->index();
			$table->integer('educationperiod_id')->nullable()->index();
			$table->date('period_startdate')->nullable()->index();
			$table->date('period_enddate')->nullable();
			$table->dateTime('created_date');
			$table->dateTime('modified_date')->nullable();
			$table->text('log');
			$table->string('monitor_status', 3)->index();
			$table->string('student_bsn', 9)->nullable();
			$table->string('student_firstname', 128)->nullable();
			$table->string('student_middlename', 32)->nullable();
			$table->string('student_lastname', 128)->nullable();
			$table->integer('student_studyprogramme_id')->nullable()->index();
			$table->string('period_name', 128)->nullable();
			$table->boolean('profile_validated');
			$table->string('scanned_agreement', 100)->nullable();
			$table->text('data');
			$table->string('student_student_number', 24)->nullable();
			$table->string('enroll_step', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_agreement');
	}

}
