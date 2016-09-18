<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Cache;

/**
 * Set the default documentation version...
 */
define('DEFAULT_VERSION', env('DEFAULT_VERSION', 'master'));

/**
 * Convert some text to Markdown...
 */
function markdown($text) {
	return (new ParsedownExtra)->text($text);
}

Route::get('/flush/{version?}', function($version = null) {
	if($version){
		Cache::forget($version);
	}
	
	Cache::flush();

	return redirect('docs/'.DEFAULT_VERSION);
});

Route::get('/', 'DocsController@showRootPage');
Route::get('docs', 'DocsController@showRootPage');
Route::get('docs/{version}/{page?}', 'DocsController@show');
