<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_module', function(Blueprint $table)
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
			$table->text('subject');
			$table->text('goals');
			$table->decimal('contacthours', 5, 1)->nullable();
			$table->decimal('ects', 5, 1)->nullable();
			$table->text('roster');
			$table->string('language', 2);
			$table->text('requirements');
			$table->boolean('is_commercial')->nullable();
			$table->decimal('costs')->nullable();
			$table->text('enrollment');
			$table->string('level', 8);
			$table->string('educationtype', 2);
			$table->string('url', 200);
			$table->string('module_code', 32);
			$table->text('literature');
			$table->text('extrainformation');
			$table->text('examination');
			$table->string('moduletype', 1);
			$table->boolean('is_published');
			$table->boolean('is_enrollable');
			$table->boolean('allow_sk123');
			$table->string('keywords', 256);
			$table->integer('organisationalunit_id')->nullable()->index();
			$table->integer('contact_id')->nullable()->index();
			$table->integer('informationrequest_id')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_module');
	}

}
