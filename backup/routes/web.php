<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\MasterAdmin\DashboardController as MasterAdminDashboardController;
use App\Http\Controllers\MasterAdmin\GroupsController;
use App\Http\Controllers\MasterAdmin\WifisController;
use App\Http\Controllers\MasterAdmin\AdminMessagesController;

use App\Http\Controllers\GroupAdmin\DashboardController as GroupAdminDashboardController;
use App\Http\Controllers\GroupAdmin\UsersController as GroupAdminUsersController;
use App\Http\Controllers\GroupAdmin\OperatorsController;
use App\Http\Controllers\GroupAdmin\DiscountsController;

use App\Http\Controllers\Operator\MainController;
use App\Http\Controllers\Operator\LogsController;

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

// Redirects for groupadmin
Route::get('/', function () {
    return redirect()->route('groupadmin.login');
});

Route::get('/login', function () {
    return redirect()->route('groupadmin.login');
});

Route::get('/group', function () {
    return redirect()->route('groupadmin.login');
});

// Redirect for masteradmin
Route::get('/admin', function () {
    return redirect()->route('masteradmin.login');
});

// Redirect for operator
Route::get('/operator', function () {
    return redirect()->route('operator.login');
});


// Auth routes
Route::match(['get', 'post'], 'admin/login', [LoginController::class, 'masterAdminLogin'])->name('masteradmin.login');
Route::get('admin/logout', [LoginController::class, 'masterAdminLogout'])->name('masteradmin.logout');

Route::match(['get', 'post'], 'group/login', [LoginController::class, 'groupAdminLogin'])->name('groupadmin.login');
Route::get('group/logout', [LoginController::class, 'groupAdminLogout'])->name('groupadmin.logout');

Route::match(['get', 'post'], 'operator/login', [LoginController::class, 'operatorLogin'])->name('operator.login');
Route::get('operator/logout', [LoginController::class, 'operatorLogout'])->name('operator.logout');

// Master Admin Routes
Route::group(['prefix' => 'admin','middleware' => 'masteradmin'], function () {
    Route::get('dashboard', [MasterAdminDashboardController::class, 'index'])->name('masteradmin.dashboard');

    Route::resource('groups', GroupsController::class);

    Route::resource('wifi-routers', WifisController::class);

    Route::resource('admin-messages', AdminMessagesController::class, ['except' => ['show', 'store', 'destroy', 'edit']]);
});

// Group Admin Routes
Route::group(['prefix' => 'group','middleware' => 'groupadmin'], function () {
    Route::get('dashboard', [GroupAdminDashboardController::class, 'index'])->name('groupadmin.dashboard');

    Route::resource('operators', OperatorsController::class);

    Route::resource('users', GroupAdminUsersController::class);
    Route::post('users/bulk-add', [GroupAdminUsersController::class, 'bulkAdd']);

    Route::resource('discounts', DiscountsController::class);
});

// Operator Routes
Route::group(['prefix' => 'operator','middleware' => 'operator'], function () {
    Route::get('main', [MainController::class, 'index'])->name('operator.main');
    Route::post('main', [MainController::class, 'store'])->name('operator.main.store');
    Route::post('main/update', [MainController::class, 'update'])->name('operator.main.update');

    Route::resource('logs', LogsController::class);
});