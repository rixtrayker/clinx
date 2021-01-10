<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReservationController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Models\Reservation;

use App\Models\Role;

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
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    // 'as'=>'admin.',

    'middleware' => ['admin.auth'],
], function () {

    Route::get('/', [AdminHomeController::class,'index'])->name('admin.home');

    // Route::get('/', function (){
    //     dd(1);
    // });

    Route::get('roles/get-data',[RoleController::class,'index_data'])->name('roles.get-data');
    Route::get('patients/json-index',[PatientController::class,'json_index'])->name('patients.json-index');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('patients', PatientController::class);
    Route::get('delete-reservation/{id}', [ReservationController::class,'deleteReservation']);


    // Route::get('update-password', [AdminController::class, 'getUpdatePassword']);
    // Route::post('update-password', [AdminController::class, 'postUpdatePassword']);
    // AdvancedRoute::controller('roles', 'App\Http\Controllers\Admin\RoleController');

    // AdvancedRoute::controller('admins', 'Admin\AdminController');

    }
);




