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





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
   Route::get('/', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

   Route::group(['middleware' => ['web']], function () {
       //



      Route::auth();

      Route::get('home', 'HomeController@index');




      route::get('dashboard','Desktop\DashboardController@index');


      //Marcas
      route::resource('mark','MarkController');
      route::resource('/categories','CategoryController');
      route::resource('/genders','GenderController');
      route::resource('/pricePer','PricePerController');
      route::resource('/provinces','ProvinceController');
      route::resource('/districts','DistrictController');
      route::resource('/services','ServiceController');
      route::resource('user','UserController');
      route::get('listallservice/{page?}','ServiceController@listall');
      route::get('listallmark/{page?}','MarkController@listall');
      route::get('listalluser/{page?}','UserController@listall');
      
      // Productos
      route::resource('product','ProductController');
      route::get('listall/{page?}','ProductController@listall');
      Route::get('districsByProvince/{id}','DistrictController@showDistrictsByProvince');

      route::get('modelweb','DashboardController@modelweb');



   });

