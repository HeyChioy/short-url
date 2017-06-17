<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/','IndexController@index');

Route::post('/api/create','IndexController@store');

Route::get('/api/token',function(){
    return csrf_token();
});

Route::get('/api/summary',function(){
    $result = array('status' => 'success', 'status_code' => 200);
    $result['summary'] = \App\Url::getSummary();
    return $result;
});

Route::get('/{shortKey}', function(\App\Url $url){
    $uri = $url->uri;
    if($url->scheme == 'file'){
        return view('url.redirect',compact('uri'));
    }
    $url->visit_time++;
    $url->save();
    return redirect($uri);
});
