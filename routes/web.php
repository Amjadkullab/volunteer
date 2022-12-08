<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\InstitutionController;
use App\Http\Controllers\Dashboard\RolePermissionsController;
use App\Http\Controllers\Dashboard\InstitutionPermissionsController;

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

Route::get('/karam', function () {
    return  encrypt('12345678');
});
// route::prefix('/')->middleware('guest:admin')->group(function(){

//     Route::get('{guard}/login',[authcontroller::class,'showlogin'])->name('login');
//     Route::post('{guard}/login',[authcontroller::class, 'login']);

//     });

Route::prefix('/')->middleware('guest:admin')->group(function(){

    // Route::view('login','store.login')->name('login');
    Route::get('{guard}/login',[AuthController::class , 'ShowLogin'])->name('login');
    Route::post('/login',[AuthController::class , 'login']);
});




Route::group(
    [
        'as' => 'dashboard.',
        'prefix' => 'admin',
       'middleware'=>'auth:admin,institution',

    ],
    function () {

        Route::get('logout',[AuthController::class,'logout'])->name('logout');
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

            // Route::resource('admin',AdminController::class);
            // Route::resource('user',UserController::class);
            Route::get('categories/trash', [CategoryController::class, 'trash'])
            ->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
            ->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
            ->name('categories.force-delete');
        Route::resource('categories', CategoryController::class);
        Route::get('categories/trash', [CategoryController::class, 'trash'])
            ->name('categories.trash');

        Route::get('posts/trash', [PostController::class, 'trash'])
            ->name('posts.trash');
        Route::put('posts/{post}/restore', [PostController::class, 'restore'])
            ->name('posts.restore');
        Route::delete('posts/{post}/force-delete', [PostController::class, 'forceDelete'])
            ->name('posts.force-delete');
        Route::resource('posts', PostController::class);
        Route::get('posts/trash', [PostController::class, 'trash'])
            ->name('posts.trash');



            Route::get('edit-password',[AuthController::class , 'changePassword'])->name('change-password');
            Route::put('update-password',[AuthController::class , 'updatePassword']);
            // Route::resource('roles', RoleController::class);
            // Route::resource('permissions',PermissionController::class);
            // Route::resource('roles.permissions', RolePermissionsController::class);




    }
);
Route::group(
    [
        'as' => 'dashboard.',
        'prefix' => 'admin',
       'middleware'=>'auth:admin',

    ],
    function () {


            Route::resource('admin',AdminController::class);
            Route::resource('user',UserController::class);
            // Route::get('logout',[AuthController::class,'logout'])->name('logout');

            // Route::get('edit-password',[AuthController::class , 'changePassword'])->name('change-password');
            // Route::put('update-password',[AuthController::class , 'updatePassword']);

            Route::resource('roles', RoleController::class);
            Route::resource('permissions',PermissionController::class);
            Route::resource('roles.permissions', RolePermissionsController::class);
            Route::resource('institution',InstitutionController::class);

            Route::resource('institutions.permissions',InstitutionPermissionsController::class);


    }
);

// Route::group(
//     [
//         'as' => 'dashboard.',
//         'prefix' => 'admin',
//        'middleware'=>'auth:admin:institution',
//     ],
//     function () {
//         Route::get('/', [HomeController::class, 'index'])->name('dashboard');
//         Route::get('categories/trash', [CategoryController::class, 'trash'])
//         ->name('categories.trash');
//     Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
//         ->name('categories.restore');
//     Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
//         ->name('categories.force-delete');
//     Route::resource('categories', CategoryController::class);
//     Route::get('categories/trash', [CategoryController::class, 'trash'])
//         ->name('categories.trash');

//     Route::get('posts/trash', [PostController::class, 'trash'])
//         ->name('posts.trash');
//     Route::put('posts/{post}/restore', [PostController::class, 'restore'])
//         ->name('posts.restore');
//     Route::delete('posts/{post}/force-delete', [PostController::class, 'forceDelete'])
//         ->name('posts.force-delete');
//     Route::resource('posts', PostController::class);
//     Route::get('posts/trash', [PostController::class, 'trash'])
//         ->name('posts.trash');
//         Route::resource('institution',InstitutionController::class);


//         Route::resource('institutions.permissions',InstitutionPermissionsController::class);

//     });

//  Route::prefix('admin')->middleware('auth:admin')->group(function(){

// });

// Route::group(
//     [
//         'as' => 'dashboard.',
//         'prefix' => 'admin',
//      //  'middleware'=>'auth:admin',

//     ],
//     function () {

//         Route::get('logout',[AuthController::class,'logout'])->name('logout');
//         Route::get('/', [HomeController::class, 'index'])->name('dashboard');

//             Route::resource('admin',AdminController::class);
//             Route::resource('user',UserController::class);
//             Route::get('categories/trash', [CategoryController::class, 'trash'])
//             ->name('categories.trash');
//         Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])
//             ->name('categories.restore');
//         Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
//             ->name('categories.force-delete');
//         Route::resource('categories', CategoryController::class);
//         Route::get('categories/trash', [CategoryController::class, 'trash'])
//             ->name('categories.trash');

//         Route::get('posts/trash', [PostController::class, 'trash'])
//             ->name('posts.trash');
//         Route::put('posts/{post}/restore', [PostController::class, 'restore'])
//             ->name('posts.restore');
//         Route::delete('posts/{post}/force-delete', [PostController::class, 'forceDelete'])
//             ->name('posts.force-delete');
//         Route::resource('posts', PostController::class);
//         Route::get('posts/trash', [PostController::class, 'trash'])
//             ->name('posts.trash');
//             Route::resource('institution',InstitutionController::class);


//             Route::get('edit-password',[AuthController::class , 'changePassword'])->name('change-password');
//             Route::put('update-password',[AuthController::class , 'updatePassword']);
//             Route::resource('roles', RoleController::class);
//             Route::resource('permissions',PermissionController::class);
//             Route::resource('roles.permissions', RolePermissionsController::class);
//             Route::resource('institutions.permissions',InstitutionPermissionsController::class);
//     Route::get('edit-profile',[AuthController::class,'editProfile'])->name('edit-profile');


//     }
// );



