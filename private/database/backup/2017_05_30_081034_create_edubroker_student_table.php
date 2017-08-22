<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_student', function(Blueprint $table)
		{
			$table->integer('stu_id')->index();
			$table->string('stu_username', 30);
			$table->string('stu_password', 128);
			$table->string('stu_initials', 20);
			$table->string('stu_firstname', 128);
			$table->string('stu_middlename', 64);
			$table->string('stu_lastname', 128);
			$table->date('stu_birthdate')->nullable();
			$table->string('stu_bsn', 9)->nullable();
			$table->boolean('stu_no_bsn');
			$table->string('stu_email', 75);
			$table->string('stu_telephone', 24);
			$table->string('stu_phase', 1);
			$table->string('stu_address_street', 128);
			$table->string('stu_address_number', 16);
			$table->string('stu_address_zip', 20);
			$table->string('stu_address_city', 128);
			$table->dateTime('stu_created');
			$table->dateTime('stu_modified')->nullable();
			$table->integer('stu_organisation_id');
			$table->integer('stu_studyprogramme_id')->nullable();
			$table->boolean('stu_is_active');
			$table->string('stu_address_country', 2);
			$table->string('stu_student_number', 24)->nullable();
			$table->boolean('stu_rejected_tos');
			$table->integer('stu_signed_tos_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_student');
	}

}
