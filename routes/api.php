<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'student', 'middleware' => ['auth', 'userroles'], 'roles' => ['student']], function() {
    Route::group(['namespace' => 'Control_Panel_Student'], function(){
        Route::middleware('auth:api')->group(function () {
            // Route::get('/posts/{post}/comment', 'CommentController@store');
            Route::get('/student-assessment/subject/{id}/new-assessment', 'AssessmentController@getAssessmentData')->name('student.assessment.get.data');
        });
    });
});