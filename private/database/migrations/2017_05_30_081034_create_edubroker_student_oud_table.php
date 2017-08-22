<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerStudentOudTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_student_oud', function(Blueprint $table)
		{
			$table->integer('id')->index();
			$table->string('username', 30)->unique();
			$table->string('password', 128);
			$table->string('initials', 20);
			$table->string('firstname', 128);
			$table->string('middlename', 64);
			$table->string('lastname', 128);
			$table->date('birthdate')->nullable();
			$table->string('bsn', 9)->nullable();
			$table->boolean('no_bsn');
			$table->string('email', 75)->unique();
			$table->string('telephone', 24);
			$table->string('phase', 1);
			$table->string('address_street', 128);
			$table->string('address_number', 16);
			$table->string('address_zip', 20);
			$table->string('address_city', 128);
			$table->dateTime('created');
			$table->dateTime('modified')->nullable();
			$table->integer('organisation_id')->index();
			$table->integer('studyprogramme_id')->nullable()->index();
			$table->boolean('is_active');
			$table->string('address_country', 2);
			$table->string('student_number', 24)->nullable();
			$table->boolean('rejected_tos');
			$table->integer('signed_tos_id')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_student_oud');
	}

}
