<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeController;



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
Route::get('change-lang', function () {
    Session::put('locale',request()->lang);
    return redirect()->back();
});


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    // 'middleware' => ['auth', 'acl'],
], function () {

    Route::get('/', [AdminHomeController::class,'index']);

    Route::get('/', function (){
        dd(1);
    });

    Route::resource('roles', RoleController::class);
    // Route::get('update-password', [AdminController::class, 'getUpdatePassword']);
    // Route::post('update-password', [AdminController::class, 'postUpdatePassword']);
    // AdvancedRoute::controller('roles', 'App\Http\Controllers\Admin\RoleController');

    // AdvancedRoute::controller('admins', 'Admin\AdminController');

    }
);


