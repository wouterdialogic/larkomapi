<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerPersonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('e_person', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('created_date');
			$table->dateTime('modified_date')->nullable();
			$table->integer('created_by_id')->nullable()->index();
			$table->integer('modified_by_id')->nullable()->index();
			$table->integer('ownedby_organisation_id')->nullable()->index();
			$table->integer('status')->nullable();
			$table->boolean('is_deleted');
			$table->string('titles', 16);
			$table->string('firstname', 64);
			$table->string('middlename', 64);
			$table->string('lastname', 128);
			$table->string('email', 75);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('e_person');
	}

}
