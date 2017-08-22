<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEdubrokerChoicethemeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('e_choicetheme', function(Blueprint $table)
		{
			$table->foreign('sector_id')->references('id')->on('e_choicesector')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('e_choicetheme', function(Blueprint $table)
		{
			$table->dropForeign('e_choicetheme_sector_id_foreign');
		});
	}

}
