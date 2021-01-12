<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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

route::get('autologin/{id}', function(Request $request){
    $word = $request->id;
    $removePrefix = str_replace(config('autologin.prefix'),'', $word);
    $id = str_replace(config('autologin.suffix'), '', $removePrefix);
    
    Auth::loginUsingId($id);
    $user = User::whereId($id)->first();

    if($user->role == 4 ){
        return redirect('/faculty/dashboard');
    }

    if($user->role == 5 ){
        return redirect('/student/dashboard');
    }    
})->name('autologin');

include 'web/front-end.php';

include 'web/admin.php';

include 'web/registrar.php';

include 'web/faculty.php';

include 'web/finance.php';

include 'web/student.php';

include 'web/admission.php';