<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AccountController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\BackendmenuController;
use App\Http\Controllers\backend\BackendsubmenuController;
use App\Http\Controllers\backend\AdminusersController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\AcademicYearController;
use App\Http\Controllers\backend\BatchesController;
use App\Http\Controllers\backend\SubjectsController;
use App\Http\Controllers\backend\TeacherController;
use App\Http\Controllers\backend\StudentsController;
use App\Http\Controllers\backend\StudentAdmissionsController;


use App\Http\Controllers\backend\LogController;
use App\Models\backend\AdminUsers;
use App\Http\Controllers\backend\FrgtpassController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
//Clear configurations:
			Route::get('/config-clear', function() {
				$status = Artisan::call('config:clear');
				return '<h1>Configurations cleared</h1>';
			});

//Clear cache:
			Route::get('/cache-clear', function() {
				$status = Artisan::call('cache:clear');
				return '<h1>Cache cleared</h1>';
			});

//Clear configuration cache:
			Route::get('/config-cache', function() {
				$status = Artisan::call('config:cache');
				return '<h1>Configurations cache cleared</h1>';
			});

			//Clear route cache:
			Route::get('/route-cache', function() {
				$status = Artisan::call('route:cache');
				return '<h1>Route cache cleared</h1>';
			});

//Clear view cache:
			Route::get('/view-clear', function() {
				$status = Artisan::call('view:clear');
				return '<h1>View cache cleared</h1>';
			});

//dump autoload:
			Route::get('/dump-autoload', function() {
				$status = Artisan::call('dump-autoload');
				return '<h1>Dumped Autoload</h1>';
			});


// Route::get('/', 'HomeController@index');
// Route::get('/', function(){
//     return view('welcome');
// } );

Route::get('/', [AccountController::class,'showLoginForm'])->name('admin.login' );


Route::prefix('admin')->group(function () {

  Route::group(['middleware'=>'admin.guest'],function (){
    Route::get('/login', [AccountController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login', [AccountController::class,'login'])->name('admin.login.submit');
  });



  Route::group(['middleware'=>'admin.auth'], function () {
  // Route::get('/', [AdminController::class,'index'])->name('admin');
  Route::get('/', [AdminController::class,'index'])->name('admin.dashboard');
  Route::get('/profile', [AdminController::class,'myProfile'])->name('admin.profile');
  Route::post('/update_profile', [AdminController::class,'updateProfile'])->name('admin.update_profile');
  Route::get('/changepassword', [AdminController::class,'changePassword'])->name('admin.change_password');
  Route::post('/updatepassword', [AdminController::class,'updatePassword'])->name('admin.update_password');
  Route::get('/logout', [AccountController::class,'logout'])->name('admin.logout');
  Route::get('/permissions', [PermissionController::class,'index'])->name('admin.permissions');
  Route::get('/permissions/create', [PermissionController::class,'create'])->name('admin.permissions.create');
  Route::post('/permissions/store', [PermissionController::class,'store'])->name('admin.permissions.store');
  Route::get('/permissions/edit/{id}', [PermissionController::class,'edit'])->name('admin.permissions.edit');
  Route::post('/permissions/update', [PermissionController::class,'update'])->name('admin.permissions.update');
  Route::get('/permissions/delete/{id}', [PermissionController::class,'destroy'])->name('admin.permissions.delete');
  Route::resource('admin/permission', 'PermissionController');
  Route::get('/backendmenu', [BackendmenuController::class,'index'])->name('admin.backendmenu');
  Route::get('/backendmenu/create', [BackendmenuController::class,'create'])->name('admin.backendmenu.create');
  Route::post('/backendmenu/store', [BackendmenuController::class,'store'])->name('admin.backendmenu.store');
  Route::get('/backendmenu/edit/{id}', [BackendmenuController::class,'edit'])->name('admin.backendmenu.edit');
  Route::post('/backendmenu/update', [BackendmenuController::class,'update'])->name('admin.backendmenu.update');
  Route::get('/backendmenu/delete/{id}', [BackendmenuController::class,'destroy'])->name('admin.backendmenu.delete');
  Route::get('/backendmenu/view/{id}', [BackendmenuController::class,'show'])->name('admin.backendmenu.view');
  Route::resource('admin/backendmenu', 'BackendmenuController');
  Route::get('/backendsubmenu', [BackendsubmenuController::class,'index'])->name('admin.backendsubmenu');
  Route::get('/backendsubmenu/menu/{menu_id}', [BackendsubmenuController::class,'menu'])->name('admin.backendsubmenu.menu');
  Route::get('/backendsubmenu/create/{menu_id?}', [BackendsubmenuController::class,'create'])->name('admin.backendsubmenu.create');
  Route::post('/backendsubmenu/store', [BackendsubmenuController::class,'store'])->name('admin.backendsubmenu.store');
  Route::get('/backendsubmenu/edit/{id}', [BackendsubmenuController::class,'edit'])->name('admin.backendsubmenu.edit');
  Route::post('/backendsubmenu/update', [BackendsubmenuController::class,'update'])->name('admin.backendsubmenu.update');
  Route::get('/backendsubmenu/delete/{id}', [BackendsubmenuController::class,'destroy'])->name('admin.backendsubmenu.delete');
  Route::get('/backendsubmenu/view/{id}', [BackendsubmenuController::class,'show'])->name('admin.backendsubmenu.view');
  Route::resource('admin/backendsubmenu', 'BackendsubmenuController');

//   Route::get('/adminusers', [AdminusersController::class,'index'])->name('admin.adminusers');
//   Route::get('/adminusers/create', [AdminusersController::class,'create'])->name('admin.adminusers.create');
//   Route::post('/adminusers/store', [AdminusersController::class,'store'])->name('admin.adminusers.store');
//   Route::get('/adminusers/edit/{id}', [AdminusersController::class,'edit'])->name('admin.adminusers.edit');
//   Route::post('/adminusers/update', [AdminusersController::class,'update'])->name('admin.adminusers.update');
//   Route::get('/adminusers/delete/{id}', [AdminusersController::class,'destroy'])->name('admin.adminusers.delete');
//   Route::get('/adminusers/view/{id}', [AdminusersController::class,'show'])->name('admin.adminusers.view');
//   Route::get('/adminusers/editstatus/{id}', [AdminusersController::class,'editstatus'])->name('admin.adminusers.editstatus');
//   Route::post('/adminusers/updatestatus', [AdminusersController::class,'updatestatus'])->name('admin.adminusers.updatestatus');
//   Route::resource('admin/adminusers', 'AdminusersController');

//admin.roles
Route::get('/roles', [RolesController::class,'index'])->name('admin.roles');
  Route::get('/roles/create', [RolesController::class,'create'])->name('admin.roles.create');
  Route::post('/roles/store', [RolesController::class,'store'])->name('admin.roles.store');
  Route::get('/roles/edit/{id}', [RolesController::class,'edit'])->name('admin.roles.edit');
  Route::post('/roles/update', [RolesController::class,'update'])->name('admin.roles.update');
  Route::get('/roles/delete/{id}', [RolesController::class,'destroy'])->name('admin.roles.delete');
  Route::get('/roles/view/{id}', [RolesController::class,'show'])->name('admin.roles.view');
  Route::resource('admin/roles', 'RolesController');

   //admin.internalusers  //September
  //Route::get('/internalusers', [InternalUsersController::class,'index'])->name('admin.internalusers');
  Route::get('/users', [AdminController::class, 'showusers'])->name('admin.users');
  Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
  Route::post('/user/store', [AdminController::class, 'store'])->name('admin.store');
  Route::get('/user/delete/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');
  Route::get('/user/edit/{id}', [AdminController::class, 'edit'])->name('admin.user.edit');
  Route::post('/user/update', [AdminController::class, 'update'])->name('admin.user.update');
  Route::post('/user/status', [AdminController::class, 'updatestatus'])->name('admin.user.status');




//Years
Route::get('/year', [AcademicYearController::class, 'index'])->name('admin.year');
Route::get('/year/create', [AcademicYearController::class, 'create'])->name('admin.year.create');
Route::post('/year/store', [AcademicYearController::class, 'store'])->name('admin.year.store');
Route::get('/year/edit/{id}', [AcademicYearController::class, 'edit'])->name('admin.year.edit');
Route::post('/year/update', [AcademicYearController::class, 'update'])->name('admin.year.update');
Route::get('/year/delete/{id}', [AcademicYearController::class, 'delete'])->name('admin.year.delete');

//Batches
Route::get('/batches', [BatchesController::class, 'index'])->name('admin.batches');
Route::get('/batches/create', [BatchesController::class, 'create'])->name('admin.batches.create');
Route::post('/batches/store', [BatchesController::class, 'store'])->name('admin.batches.store');
Route::get('/batches/edit/{id}', [BatchesController::class, 'edit'])->name('admin.batches.edit');
Route::post('/batches/update', [BatchesController::class, 'update'])->name('admin.batches.update');
Route::get('/batches/delete/{id}', [BatchesController::class, 'delete'])->name('admin.batches.delete');

//Subjects
Route::get('/subjects/{id}', [SubjectsController::class, 'index'])->name('admin.subjects');
Route::get('/subjects/create/{id}', [SubjectsController::class, 'create'])->name('admin.subjects.create');
Route::post('/subjects/store', [SubjectsController::class, 'store'])->name('admin.subjects.store');
Route::get('/subjects/edit/{id}', [SubjectsController::class, 'edit'])->name('admin.subjects.edit');
Route::post('/subjects/update', [SubjectsController::class, 'update'])->name('admin.subjects.update');
Route::get('/subjects/delete/{id}', [SubjectsController::class, 'delete'])->name('admin.subjects.delete');

//Pending

//TEACHER MASTER
Route::get('/teachers', [TeacherController::class, 'index'])->name('admin.teachers');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
Route::post('/teachers/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
Route::get('/teachers/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teachers.delete');

//Profile URLS
//view profile
Route::get('/teachers/profile/{id}', [TeacherController::class, 'profile'])->name('admin.teachers.profile');
//open edit page
Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
//update profile details
Route::post('/teachers/profile/update', [TeacherController::class, 'update'])->name('admin.techers.profile.update');

//update status
Route::post('/teachers/status/update', [TeacherController::class, 'update_status'])->name('admin.teachers.update.status');

//update education
Route::post('/teachers/update/education', [TeacherController::class, 'update_education'])->name('admin.techers.update.education');

//update resume
 Route::post('/teachers/update/resume', [TeacherController::class, 'update_resume'])->name('admin.techers.update.resume');
 Route::post('/teachers/update/picture', [TeacherController::class, 'update_picture'])->name('admin.techers.update.picture');

//documents
Route::get('/teachers/documents/{id}', [TeacherController::class, 'show_documents'])->name('admin.teachers.documents');
Route::post('/teachers/documents/store', [TeacherController::class, 'store_documents'])->name('admin.teachers.documents.store');
Route::get('/teachers/documents/delete/{id}', [TeacherController::class, 'delete_document'])->name('admin.teachers.documents.delete');


// TASK
// teacher documents
//printteacher data pdf

//teacher attendance
//reports
// payments (accept and pay)
//lectures crud
//student attendance


//STUDENT MASTER
Route::get('/students', [StudentsController::class, 'index'])->name('admin.students');
Route::get('/students/create', [StudentsController::class, 'create'])->name('admin.students.create');
Route::post('/students/store', [StudentsController::class, 'store'])->name('admin.students.store');
Route::get('/students/delete/{id}', [StudentsController::class, 'delete'])->name('admin.students.delete');

Route::get('/students/profile/{id}', [StudentsController::class, 'profile'])->name('admin.students.profile');
//admissions
Route::get('/students/admissions/{id}', [StudentAdmissionsController::class, 'admissions'])->name('admin.students.admissions');
Route::post('/students/admission/store', [StudentAdmissionsController::class, 'admission_store'])->name('admin.students.admissions.store');
Route::get('/students/admissions/edit/{id}', [StudentAdmissionsController::class, 'admissions_edit'])->name('admin.students.admissions.edit');
Route::post('/students/admission/update', [StudentAdmissionsController::class, 'admission_update'])->name('admin.students.admissions.update');
Route::get('/students/admissions/delete/{id}', [StudentAdmissionsController::class, 'delete'])->name('admin.students.admissions.delete');


// Route::get('/students/edit/{id}', [StudentsController::class, 'edit'])->name('admin.students.edit');
// Route::post('/students/update', [StudentsController::class, 'update'])->name('admin.students.update');




//logs
Route::get('/logs',[LogController::class, 'index'])->name('admin.logs');
Route::get('/logs/user/logdetails',[LogController::class, 'userlogs'])->name('admin.user.logs');






});
}); //End if Admin Group]



//ajax calls
Route::get('/fetch/fees/{batch_id}',[BatchesController::class,'fetch_fees'])->name('fetch.batch');

Route::get('/frgtpassword', [FrgtpassController::class,'frgtpassword'])->name('frgtpassword');
Route::post('/sendotp', [FrgtpassController::class,'sendotp'])->name('sendotp.store');
// Route::get('/sendotp{token}',[FrgtpassController::class,'signupsendotp'])->name('sendOTP');
Route::get('/thankyou', [FrgtpassController::class, 'forthankyou'])->name('forthankyou');
Route::get('resettoken/{token}', [FrgtpassController::class, 'showResetPasswordForm'])->name('resettoken');

Route::post('/changeforgotpassword', [FrgtpassController::class,'changeforgotpassword'])->name('changeforgotpassword.store');
