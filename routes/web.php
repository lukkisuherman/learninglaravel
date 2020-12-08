<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Models\BookCategory;
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

// Route::group([
//     'middleware'    => ['web'],
//     'as'            => 'laravelroles::',
//     'namespace'     => 'jeremykenedy\LaravelRoles\App\Http\Controllers',
// ], function () {

//     // Dashboards and CRUD Routes
//     Route::resource('roles', 'LaravelRolesController');
//     Route::resource('permissions', 'LaravelPermissionsController');

//     // Deleted Roles Dashboard and CRUD Routes
//     Route::get('roles-deleted', 'LaravelRolesDeletedController@index')->name('roles-deleted');
//     Route::get('role-deleted/{id}', 'LaravelRolesDeletedController@show')->name('role-show-deleted');
//     Route::put('role-restore/{id}', 'LaravelRolesDeletedController@restoreRole')->name('role-restore');
//     Route::post('roles-deleted-restore-all', 'LaravelRolesDeletedController@restoreAllDeletedRoles')->name('roles-deleted-restore-all');
//     Route::delete('roles-deleted-destroy-all', 'LaravelRolesDeletedController@destroyAllDeletedRoles')->name('destroy-all-deleted-roles');
//     Route::delete('role-destroy/{id}', 'LaravelRolesDeletedController@destroy')->name('role-item-destroy');

//     // Deleted Permissions Dashboard and CRUD Routes
//     Route::get('permissions-deleted', 'LaravelpermissionsDeletedController@index')->name('permissions-deleted');
//     Route::get('permission-deleted/{id}', 'LaravelpermissionsDeletedController@show')->name('permission-show-deleted');
//     Route::put('permission-restore/{id}', 'LaravelpermissionsDeletedController@restorePermission')->name('permission-restore');
//     Route::post('permissions-deleted-restore-all', 'LaravelpermissionsDeletedController@restoreAllDeletedPermissions')->name('permissions-deleted-restore-all');
//     Route::delete('permissions-deleted-destroy-all', 'LaravelpermissionsDeletedController@destroyAllDeletedPermissions')->name('destroy-all-deleted-permissions');
//     Route::delete('permission-destroy/{id}', 'LaravelpermissionsDeletedController@destroy')->name('permission-item-destroy');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/book', BookController::class);
    Route::get('/book/export/excel', [BookController::class, 'export'])->name('book.export');
    Route::post('/book/import', [BookController::class, 'import'])->name('book.import');
    Route::resource('/category', BookCategoryController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('/book', BookController::class);

// Route::get('/book/export/excel', [BookController::class, 'export'])->name('book.export');

// Route::post('/book/import', [BookController::class, 'import'])->name('book.import');

// Route::resource('/category', BookCategoryController::class);
