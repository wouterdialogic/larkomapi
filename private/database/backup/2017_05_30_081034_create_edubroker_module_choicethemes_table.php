<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdubrokerModuleChoicethemesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edubroker_module_choicethemes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('module_id')->index();
			$table->integer('choicetheme_id')->index();
			$table->unique(['module_id','choicetheme_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('edubroker_module_choicethemes');
	}

}
