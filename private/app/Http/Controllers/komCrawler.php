<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StandaardAPI;
use edubroker_agreement;
use edubroker_student;
use edubroker_module;
use edubroker_organisationalunit;
use edubroker_educationperiod;
use edubroker_person;
use edubroker_contact;
use edubroker_informationrequest;
use edubroker_organisationdata;
use edubroker_organisation;
use edubroker_studyprogramme;
use edubroker_choicetheme;
use edubroker_choicesector;
use edubroker_location;

use edubroker_module_locations;
use edubroker_organisation_locations;

use phpmailer\phpmailer;

use DB;

class komCrawler extends Controller
{

    public $_TOKEN = "2dfd5261ce40a524c2950d036870a0433032cbb5";
	public $url = "https://www.kiesopmaat.nl/api/dialogic/";
	public $urlHeaders = [
		"format" => "json",
		"access_token" => "2dfd5261ce40a524c2950d036870a0433032cbb5"
	];
	public $mainpage = [];
	public $queue = [];
	public $pageCounter = 0;
	public $debuggingCLI = true;
	public $fields = [
	    "https://www.kiesopmaat.nl/api/dialogic/agreements/?format=json" => "agreements",
	    "https://www.kiesopmaat.nl/api/dialogic/students/?format=json" => "students",
	    "https://www.kiesopmaat.nl/api/dialogic/modules/?format=json" => "modules",
	    "https://www.kiesopmaat.nl/api/dialogic/organisationalunits/?format=json" => "organisationalunits",
	    "https://www.kiesopmaat.nl/api/dialogic/educationperiods/?format=json" => "educationperiods",
	    "https://www.kiesopmaat.nl/api/dialogic/persons/?format=json" => "persons",
	    "https://www.kiesopmaat.nl/api/dialogic/contacts/?format=json" => "contacts",
	    "https://www.kiesopmaat.nl/api/dialogic/informationrequests/?format=json" => "informationrequests",
	    "https://www.kiesopmaat.nl/api/dialogic/organisations/?format=json" => "organisations",
	    "https://www.kiesopmaat.nl/api/dialogic/organisationdatas/?format=json" => "organisationdata",
	    "https://www.kiesopmaat.nl/api/dialogic/studyprogrammes/?format=json" => "studyprogramme",
	    "https://www.kiesopmaat.nl/api/dialogic/choicethemes/?format=json" => "choicethemes",
	    "https://www.kiesopmaat.nl/api/dialogic/choicesectors/?format=json" => "choicesectors",
	    "https://www.kiesopmaat.nl/api/dialogic/locations/?format=json" => "locations"
	];

	public $tableTranslations = [

		"agreements" => "edubroker_agreement",
        "students" => "edubroker_student",
        "modules" => "edubroker_module",
        "organisationalunits" => "edubroker_organisationalunit",
        "educationperiods" => "edubroker_educationperiod",
        "persons" => "edubroker_person",
        "contacts" => "edubroker_contact",
        "informationrequests" => "edubroker_informationrequest",
        "organisationdata" => "edubroker_organisationdata",
        "organisations" => "edubroker_organisation",
        "studyprogramme" => "edubroker_studyprogramme",
        "choicethemes" => "edubroker_choicetheme",
        "choicesectors" => "edubroker_choicesector",
        "locations" => "edubroker_location",

	];

	public function index() {
		set_time_limit ( 0 );

		$this->printerCLI("Turning off foreign keys.");
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->printerCLI("Getting main pages.");
		$this->getMainPage();

		$this->printerCLI("Getting sub pages.");
		$this->getSubpages();

		$this->printerCLI("Turning on foreign keys.");
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

	public function clitest($bar, $users) {
		echo "\r\nStarting crawling...";

		$this->index();

		//$users = [1, 2, 3, 4, 5];

		return true;

	}

	public function makeUrl() {
		$url = $this->url . "?";
		foreach ($this->urlHeaders as $key => $urlHeader) {
			$url .= $key . "=" . $urlHeader . "&";
		}

		return $url;
	} 

	public function getPageWithCurl($uri, $_TOKEN) {
		$headers = [];
		$headers[] = 'Content-length: 0';
		$headers[] = 'Content-type: application/json';
		$headers[] = 'Authorization: Token '.$_TOKEN;
	
		$curl = curl_init($uri);
	
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
		$result = json_decode(curl_exec($curl));
		curl_close($curl);
	
		return $result;
	}

	//haalt alles van de mainpage op:
	public function getMainPage() {
		$this->sapi = new StandaardAPI;
		$mainpage = $this->sapi->getPageWithCurl($this->makeUrl(), $this->_TOKEN);
		$this->printer($mainpage, "MAINPAGE");

		foreach ($mainpage as $key => $subpage) {
			$this->mainpage[$key] = $subpage;
		}
	}

	//haalt eerst alles op van de mainpage
	//daarna alles van subpages
	public function getSubpages() {
		$mainpageCounter = count($this->mainpage);
		$this->printerCLI("mainpageCounter: ".$mainpageCounter);
		while ($this->mainpage) {
			$lastitem = array_pop($this->mainpage);
			$this->getSubpage($lastitem);
		}

		$queueCounter = count($this->queue);
		$this->printerCLI($queueCounter);
		while ($this->queue) {
			$lastitem = array_pop($this->queue);

			$this->pageCounter ++;
			if ($this->pageCounter % 10 == 0) {
				$this->printerCLI("Getting data from: ".$lastitem.".");
			}
			$this->getSubpage($lastitem);
		}

		$this->printerCLI("I`ve gotten content from ".$this->pageCounter." pages!");
	}

	//zorgen dat we met de uri kunnen werken.
	//&page=2 moet bij opeenvolgende paginas worden verwijderd.
	public function makeWorkableUri($uri) {
		$positionOfPageInUri = strpos($uri, "&page");
		if ($positionOfPageInUri) {
			$workableUri = substr($uri, 0, $positionOfPageInUri);
		} else {
			$workableUri = $uri;
		}

		return $workableUri;
	}

	//per queue item een pagina downloaden, controleren of hier een "volgende link" in staat en deze zo ja toevoegen
	public function getSubpage($uri) {

		$workableUri = $this->makeWorkableUri($uri);

		$subpage =  $this->getPageWithCurl($uri, $this->_TOKEN);
		
		//if (!strpos($uri, "agreements") or  strpos($uri, "orgasnisations") or strpos($uri, "agrewdwements") ) {

			$field = $this->fields[$workableUri];

			foreach ($subpage->results as $key => $instance) {
				$this->saveInstance($field, $instance);
			}

			if ($subpage->next != null) {
				array_push($this->queue, $subpage->next);

			} else {
				echo "<br>all done for this instance: ".$workableUri;
			}
		//}
	
		//printer($subpage->count, "count");
	}	


	//een dynamisch model genereren en deze vullen. Rekening houden met afwijkende column names.
	function saveInstance($field, $instance) {
		$modelName = $this->tableTranslations[$field];

		$fullClassName = 'App\\'.$modelName;

		$generatedClass = new $fullClassName;

		foreach ($instance as $key => $field) {

			//voorbeeld, als in de keys van de array van e_agreement->changedColumnNames de volgende waarde voorkomt:
			//	"student" => "student_id"
			//	gebruik dan student_id ipv student om de variable op te slaan
			//if ( array_key_exists( $key, $generatedClass->changedColumnNames)) {
			//	
			//	$generatedClass[$generatedClass->changedColumnNames[$key]] = $field;
			//} 

			//zo niet, gebruik dan de standaard waarde:
			//else {
			//

			//contacts - agreement_required_items = array
			if ($modelName == "edubroker_contact") {
				if ($key == "agreement_required_items") {
					break;
				}
			}			

			//edubroker_module - educationperiods = unknown column
			if ($modelName == "edubroker_module") {
				if ($key == "educationperiods") {
					break;
				}
			}

			//studyprogramme - organisations = array
			if ($modelName == "edubroker_studyprogramme") {
				if ($key == "organisations") {
					break;
				}
			}

			//voor de edit_groups, dit is een array, niet opslaan
			if ($key == "edit_groups") {
				
			} else {

				$generatedClass[$key] = $field;
			}
		}
		
		//check if generated class exists
		$classFound = new $fullClassName;
		$result = $classFound->where('id', $generatedClass['id'])->first();
		
		if ($result) {
		//wanneer het niet bestaat:
		} else {

		//for module, save locations in a many 2 many table:
		if ($modelName == "edubroker_module") {

			if (count($generatedClass['locations']) > 0) {
				foreach ($generatedClass['locations'] as $location_id) {
					$module_location = new \App\edubroker_module_locations;
		
					//controleren of deze al bestaat
					$result = \App\edubroker_module_locations::where('module_id', $generatedClass['id'])->first();
					
					if (!isset($result["id"])) {
						echo "but save plx";
						$module_location->module_id = $generatedClass['id'];
						$module_location->location_id = $location_id;
		
						$module_location->save();
					}
				}
			}

			unset($generatedClass['locations']);
		}

		//en het resultaat opslaan:
		$result = $generatedClass->save();
		}
	}

	function printer($content, $title = null) {
		echo "<br>";
		if ($title) {
			echo "<b>$title: </b>";
		}
		if (gettype($content == "array")) {
			echo "<pre>";
			print_r($content);
			echo "</pre>";
		} else {
			echo $content;
		}
	}

	function printerCLI($message, $custom = null) {
		if ($this->debuggingCLI) {
			echo "\r\n".$message;
		}
	}
}
