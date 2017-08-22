<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEdubrokerAgreementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('e_agreement', function(Blueprint $table)
		{
			$table->foreign('educationperiod_id')->references('id')->on('e_educationperiod')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('module_id')->references('id')->on('e_module')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('organisation_from_id')->references('id')->on('e_organisation_from_oud')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('organisation_to_id')->references('id')->on('e_organisation_from_oud')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('student_id')->references('id')->on('e_student_oud')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('student_studyprogramme_id')->references('id')->on('e_studyprogramme_oud')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('e_agreement', function(Blueprint $table)
		{
			$table->dropForeign('e_agreement_educationperiod_id_foreign');
			$table->dropForeign('e_agreement_module_id_foreign');
			$table->dropForeign('e_agreement_organisation_from_id_foreign');
			$table->dropForeign('e_agreement_organisation_to_id_foreign');
			$table->dropForeign('e_agreement_student_id_foreign');
			$table->dropForeign('e_agreement_student_studyprogramme_id_foreign');
		});
	}

}
