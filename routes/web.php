<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleHasPermissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AdminLoginController::class, 'loginForm'])->name('login.from');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login');


    // Route::get('register', [UserController::class, 'showRegistrationForm'])->name('admin.register');
    // Route::post('register', [UserController::class, 'register']);

});
Route::middleware(['auth:admin'])->group(function () {


    Route::get('/logout/{id}', [AdminLoginController::class, 'logout'])->name('logout');

    Route::any('/common/get_delete_modal', [CommonController::class, 'getDeleteModal']);
    Route::post('/common/get_mul_delete_modal', [CommonController::class, 'getMulDeleteModal']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['can:Role access,App\Models\Role'])->resource('role', RoleController::class);
    Route::post('role/list', [RoleController::class, 'list']);
    Route::post('role/multidestroy', [RoleController::class, 'multidestroy'])->name('role.multidestroy');
    Route::post('role/check-name-unique', [RoleController::class, 'rolevalidation'])->name('role.check-name-unique');

    Route::middleware(['can:Permission access,Spatie\Permission\Models\Permission'])->resource('permission', PermissionController::class);
    Route::post('permission/list', [PermissionController::class, 'list']);
    Route::post('permission/multidestroy', [PermissionController::class, 'multidestroy'])->name('permission.multidestroy');

    Route::middleware(['can:Rolehaspermission access,App\Models\Role_has_permission'])->resource('role-has-permission', RoleHasPermissionController::class);
    Route::post('role-has-permission/list', [RoleHasPermissionController::class, 'list']);

    Route::middleware(['can:User access,App\Models\User'])->resource('user', UserController::class);
    Route::post('user/list', [UserController::class, 'list']);

});
