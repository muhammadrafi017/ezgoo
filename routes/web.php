<?php
Route::get('test', function() {
  return auth()->user()->groups()->get();
});
// AJAX
Route::get('plane/ajax/{id}','AdminController@planeAjax');
Route::get('airport/ajax/{id}','AdminController@airportAjax');
Route::get('train/ajax/{id}','AdminController@trainAjax');
Route::get('station/ajax/{id}','AdminController@stationAjax');
//auth
Auth::routes();
//home / index
Route::get('', 'HomeController@index');
//booking
Route::group(['prefix' => 'booking'], function(){
  Route::post('search', 'BookingController@search');
  Route::post('order', 'BookingController@order');
  Route::post('fixOrder', 'BookingController@fixOrder');
  Route::put('payment/{id}', 'BookingController@payment');
});
//admin
Route::group(['prefix'=>'admin', 'middleware' => 'group:admin'], function(){
  Route::get('', 'AdminController@index');
  Route::get('users','AdminController@showUsers');
  //Download PDF
  Route::get('pdfUsers', 'UserController@pdf');

  //booking
  Route::resource('booking','BookingController');
  //plane
  Route::resource('plane', 'PlaneController');
  //airport
  Route::resource('airport', 'AirportController');
  //plane schedule
  Route::group(['prefix'=>'plane/schedule'], function(){
    Route::get('index', 'PlaneController@schedule');
    Route::get('detail/{id}','PlaneController@detailSchedule');
    Route::get('create','PlaneController@createSchedule');
    Route::post('store','PlaneController@storeSchedule');
    Route::get('edit/{id}','PlaneController@editSchedule');
    Route::put('update/{id}','PlaneController@updateSchedule');
    Route::delete('destroy/{id}','PlaneController@destroySchedule');
  });
  //train
  Route::resource('train', 'TrainController');
  //airport
  Route::resource('station', 'TrainStationController');
  //train schedule
  Route::group(['prefix'=>'train/schedule'], function(){
    Route::get('index','TrainController@schedule');
    Route::get('detail/{id}','TrainController@detailSchedule');
    Route::get('create','TrainController@createSchedule');
    Route::post('store','TrainController@storeSchedule');
    Route::get('edit/{id}','TrainController@editSchedule');
    Route::put('update/{id}','TrainController@updateSchedule');
    Route::delete('destroy/{id}','TrainController@destroySchedule');
  });
});
//user
Route::group(['prefix' => 'user', 'middleware'=> ['isVerified', 'group:member']], function(){
  Route::get('edit/{id}/{type}', 'UserController@edit')->name('edit');
  Route::put('update', 'UserController@update')->name('update');
  Route::put('updatePass', 'UserController@updatePassword')->name('updatePass');
  Route::get('booking/{id}/{id_booking?}', 'UserController@showBooking');
  Route::get('ticket/{id}/{id_booking}', 'UserController@showTicket');
});
Route::group(['prefix'=>'test'], function(){
  Route::get('test', 'BookingController@test');
  Route::get('export/{type}', 'BookingController@export');
  Route::post('import', 'BookingController@import');
});
