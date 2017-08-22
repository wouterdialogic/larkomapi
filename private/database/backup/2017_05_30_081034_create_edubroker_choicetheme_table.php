<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerChoicethemeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_choicetheme', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 256);
			$table->string('skd_Cluster_CD', 64);
			$table->integer('sector_id')->nullable()->index();
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
		Schema::drop('edubroker_choicetheme');
	}

}
