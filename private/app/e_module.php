<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class e_module extends Model
{
    protected $table = 'e_module';
	public $timestamps = false;

	public $changedColumnNames = [
		"created_by" => "created_by_id",
		"modified_by" => "modified_by_id",
		"ownedby_organisation" => "ownedby_organisation_id",
		"organisationalunit" => "organisationalunit_id",
		"contact" => "contact_id",
		"informationrequest" => "informationrequest_id",
		"edit_groups" => "edit_groups_id",
		//"student_studyprogramme" => "student_studyprogramme_id",
		//"module" => "module_id",
		//"organisation_from" => "organisation_from_id",
		//"organisation_to" => "organisation_to_id",
		//"educationperiod" => "educationperiod_id",
	];
}
