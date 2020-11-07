<?php

use App\Http\Controllers\Ajax\UserAjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/**
 * Main Controller
 */
Route::post("/change-switch",[MainController::class,"switch"])->name("switch");
Route::delete("/delete/{id}",[MainController::class,"delete"])->name("delete");

/**
 * User Controller
 */
//--dashboard
Route::get("/users",[UserController::class,"index"])->name("user.user.datatable"); //datatable User Main
Route::get("/create",[UserController::class,"create"])->name("user.create");
Route::get("/show/{id}",[UserController::class,"show"])->name("user.show");
Route::post("/user/store",[UserController::class,"store"])->name("user.store");
//--Ajax
Route::get("/user-main/datatable",[UserAjaxController::class,"initDatatableUser"])->name("test.user.datatable"); //datatable User Main Init


