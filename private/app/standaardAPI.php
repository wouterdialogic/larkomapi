<?php

namespace App;

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