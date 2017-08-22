<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerOrganisationdataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_organisationdata', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('created_date');
			$table->dateTime('modified_date')->nullable();
			$table->integer('created_by_id')->nullable()->index();
			$table->integer('modified_by_id')->nullable()->index();
			$table->integer('ownedby_organisation_id')->nullable()->index();
			$table->integer('status')->nullable();
			$table->string('logo', 100);
			$table->string('billingaddress_secondline', 128);
			$table->string('billingaddress_street', 128);
			$table->string('billingaddress_number', 20);
			$table->string('billingaddress_zip', 20);
			$table->string('billingaddress_city', 128);
			$table->text('billingaddress_remarks');
			$table->integer('organisation_id')->unique();
			$table->string('billingaddress_firstline', 128);
			$table->string('billing_email', 75);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_organisationdata');
	}

}
