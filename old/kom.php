<?php

require(__DIR__ . '/bootstrap.php');

use \Httpful\Request;

$_TOKEN = 'aec070645fe53ee3b3763059376134f058cc337247c978add178b6ccdfb0019f';
$_TOKEN = 'eff98a5ec05fd241ad36718f216572cdadf4339c';

// Get event details for a public event
$uri = "https://test.kiesopmaat.nl/api/public/?access_token=".$_TOKEN."&format=json";
$uri = "https://michiel.kiesopmaat.nl/api/dialogic/?access_token=".$_TOKEN."&format=json";

class KiesOpMaatAPI {
	public $_TOKEN = "eff98a5ec05fd241ad36718f216572cdadf4339c";
	//public $format = "json";
	public $url = "https://michiel.kiesopmaat.nl/api/dialogic/";
	public $urlHeaders = [
		"format" => "json",
		"access_token" => "eff98a5ec05fd241ad36718f216572cdadf4339c"
	];
	public $mainpage = [];
	public $queue = [];

	public function makeUrl() {
		$url = $this->url . "?";
		foreach ($this->urlHeaders as $key => $urlHeader) {
			$url .= $key . "=" . $urlHeader . "&";
		}

		return $url;
	} 

	public function getMainPage() {
		$mainpage = StandaardAPI::getPageWithCurl($this->makeUrl(), $this->_TOKEN);

		foreach ($mainpage as $key => $subpage) {
			$this->mainpage[$key] = $subpage;
		}
	}

	public function getSubpages() {
		while ($this->mainpage) {
			$lastitem = array_pop($this->mainpage);
			
			printer($lastitem);
			$this->getSubpage($lastitem);
		}

		while ($this->queue) {
			$lastitem = array_pop($this->queue);

			$this->getSubpage($lastitem);
		}
	}

	function getSubpage($uri) {
		$subpage = StandaardAPI::getPageWithCurl($uri, $this->_TOKEN);
		printer($subpage, "lol");
		exit();
		printer($uri, "url");
		if ( strpos($uri, "organisations") ) {
			echo "<Br>save this page: $uri";


			if ($subpage->next != null) {
				array_push($this->queue, $subpage->next);
				getSubpage($subpage->next, $_TOKEN);
			} else {
				echo "<br>all done for organisations!";
			}
		}
	
		printer($subpage->count);

	}	
}

class StandaardAPI {
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
}

$API = new StandaardAPI;
$KOMAPI = new KiesOpMaatAPI;
$KOMAPI->getMainPage();
$KOMAPI->getSubpages();

printer($KOMAPI->mainpage);
printer($KOMAPI->queue);
//printer($KOMAPI->queue);

$queue = [];
$queue = getMainPage($uri, $_TOKEN);

//while ($queue) {
//	getSubpage($uri, $_TOKEN);
//}

function getMainPage($uri, $_TOKEN) {
	$mainpage = getPageWithCurl($uri, $_TOKEN);
	$queue = [];

	foreach ($mainpage as $subpage) {
		array_push($queue, $subpage);
		//getSubpage($subpage, $_TOKEN);
	}

	return $queue;
}

function savePage($content) {
	echo "<br>saved!";
}

function getSubpage($uri, $_TOKEN) {
	$subpage = getPageWithCurl($uri, $_TOKEN);

	printer($uri, "url");
	if ( strpos($uri, "organisations") ) {
		echo "<Br>save this page: $uri";
		if ($subpage->next != null) {
			getSubpage($subpage->next, $_TOKEN);
		} else {
			echo "<br>all done for organisations!";
		}
	}

	printer($subpage->count);
	//if ()


	//foreach ($mainpage as $key => $subpage) {
	//	printer($subpage, $uri);
	//}
}

function getPageWithCurl($uri, $_TOKEN) {

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

function printer($content, $title = null) {
	echo "<Br>";
	if ($title) {
		echo "<b>$title:</b>";
	}

	if (gettype($content) == "string") {
		echo $content;
	} else {
		echo "<pre>";
		print_r($content);
		echo "</pre>";
	}
}
