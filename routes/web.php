<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\UserController;


use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReservationController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;



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
Route::get('lang/{locale}', function ($locale) {
    if($locale =='en' || $locale == 'ar')
        Session::put('locale',$locale);
    return redirect()->back();
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('admin-home');
});
Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    // 'as'=>'admin.',

    'middleware' => ['auth'],
], function () {

    Route::get('/', [HomeController::class,'index'])->name('admin.home');

    Route::get('roles/get-data',[RoleController::class,'index_data'])->name('roles.get-data');
    Route::get('patients/json-index',[PatientController::class,'json_index'])->name('patients.json-index');
    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('admins', AdminController::class);

    Route::resource('permissions', PermissionController::class);
    Route::resource('patients', PatientController::class);
    Route::get('delete-/{id}', [Controller::class,'delete']);
    Route::get('/next-patient', [HomeController::class,'nextPatient']);
    Route::post('/reports', [HomeController::class,'getReports'])->name('admin.reports');
    Route::get('/reports', [HomeController::class,'getReports'])->name('admin.reports.get');
    // Route::get('update-password', [AdminController::class, 'getUpdatePassword']);
    // Route::post('update-password', [AdminController::class, 'postUpdatePassword']);
    // AdvancedRoute::controller('roles', 'App\Http\Controllers\Admin\RoleController');
    // AdvancedRoute::controller('admins', 'Admin\AdminController');
    }
);




