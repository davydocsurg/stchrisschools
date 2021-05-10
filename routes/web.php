<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// guest routes

// teacher registeration
Route::post('/teacher_signup', [RegisterController::class, 'signUpAsTeacher'])->name('parent_sign_up');

// parent registeration
Route::post('/parent_signup', [RegisterController::class, 'signUpAsParent'])->name('parent_sign_up');

// Route::post('/signup', 'RegisterController@signUp')->name('sign_up');

// Route::get('/signup', [ViewController::class, 'adminSignup'])->name('adminSignup');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::post('/sign-up', 'RegisterController@adminSignup')->name('adminSignup');
Route::post('create_teacher', [TeacherController::class, 'create_teacher'])->name('create_teacher');
