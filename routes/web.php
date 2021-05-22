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
})->name('welcome');

// guest routes

// student registeration
Route::post('/student_signup', [RegisterController::class, 'signUpAsStudent'])->name('student_sign_up');

// parent registeration
Route::post('/parent_signup', [RegisterController::class, 'signUpAsParent'])->name('parent_sign_up');

// Route::post('/signup', 'RegisterController@signUp')->name('sign_up');

// Route::get('/signup', [ViewController::class, 'adminSignup'])->name('adminSignup');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
// Route::post('/sign-up', 'RegisterController@adminSignup')->name('adminSignup');
Route::post('create_teacher', [TeacherController::class, 'create_teacher'])->name('create_teacher');

/** admin routes */
Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    // teachers' management
    Route::resource('teachers', 'TeacherController');
    // parents' management
    Route::resource('parents', 'ParentsController');
    // students' management
    Route::resource('students', 'StudentController');
    // class management
    Route::resource('classes', 'GradeController');
    // subject management
    Route::resource('subjects', 'SubjectController');
    // assign subjects
    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubjectToGrade')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');
    // roles & users management
    Route::resource('assign_roles', 'AssignRoleController');
    /**
     * roles and permissions management
     * */
    // roles
    Route::get('/roles_and_permissions', 'RolePermissionController@getRolesPermissions')->name('roles-permissions.index');
    Route::get('/create-role', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/store-role', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/edit-role/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/update-role/{id}', 'RolePermissionController@updateRole')->name('role.update');

    // permissions
    Route::get('/create-permission', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/store-permission', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/edit-permission/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/update-permission/{id}', 'RolePermissionController@updatePermission')->name('permission.update');
});
