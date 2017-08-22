<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class e_agreement extends Model
{
    protected $table = 'e_agreement';
	public $timestamps = false;

	public $changedColumnNames = [
		"student" => "student_id",
		"student_studyprogramme" => "student_studyprogramme_id",
		"module" => "module_id",
		"organisation_from" => "organisation_from_id",
		"organisation_to" => "organisation_to_id",
		"educationperiod" => "educationperiod_id",
	];
}
