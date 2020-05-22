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

Route::get('/', 'HomePageController@home_page')->name('home_page');

Auth::routes();

include 'web/front-end.php';

include 'web/admin.php';

include 'web/registrar.php';

include 'web/faculty.php';

include 'web/finance.php';

include 'web/student.php';
















