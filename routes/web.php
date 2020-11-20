<?php

use App\Http\Controllers\Ajax\RoleAjaxController;
use App\Http\Controllers\Ajax\UserAjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RoleController;
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
Route::get("/users",[UserController::class,"index"])->name("user.index.datatable"); //datatable User Main
Route::get("/create",[UserController::class,"create"])->name("user.create");
Route::get("/show/{id}",[UserController::class,"show"])->name("user.show");
Route::post("/user/store",[UserController::class,"store"])->name("user.store");
Route::patch("/user/update/{id}",[UserController::class,"update"])->name("user.update");
//--Ajax
Route::get("/user-main/datatable",[UserAjaxController::class,"initDatatableUser"])->name("init.user.datatable"); //datatable User Main Init

/**
 * Role Controller
 */
//--dashboard
Route::get("/roles",[RoleController::class,"index"])->name("role.index.datatable");
Route::post("/role/store",[RoleController::class,"store"])->name("role.store");

//--Ajax
Route::get("/role-main/datatable",[RoleAjaxController::class,"initDatatableRole"])->name("init.role.datatable"); //datatable User Main Init

/**
 * HasMedia Controller
 */
Route::post("/upload",[MediaController::class,"upload"])->name("upload");
Route::post("/upload/model",[MediaController::class,"uploadModel"])->name("uploadModel");
Route::post("/search/media" ,[MediaController::class,"searchMedia"])->name("searchMedia");




