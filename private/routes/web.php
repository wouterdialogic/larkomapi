<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------- 	----------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/start', function () {
    return "view('welcomwe');";
});

Route::get('/lol', function () {
    return view('welcome');;
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/commandTest', function() {
	return "command test";
});

Route::get('/komgetdata', 'komCrawler@index'); 

function printer($content, $title = null) {
	echo "<br>";
	if ($title) {
		echo "<b>$title: </b>";
	}
	if (gettype($content = "array")) {
		echo "<pre>";
		print_r($content);
		echo "</pre>";
	} else {
		echo $content;
	}
}