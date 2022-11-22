<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController;
use App\Http\Controllers\UserFollowController;

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
//     return view('dashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');                 // フォローボタン押下時呼ばれる
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');         // アンフォローボタン押下時呼ばれる
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');         // フォロー一覧ページ表示処理
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');            // フォロワー一覧ページ表示処理
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');            // お気に入り一覧表示処理
    });        
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
    
    Route::group(['prefix' => 'microposts/{id}'], function () {                                             // 追加
        Route::post('favorites', [FavoritesController::class, 'store'])->name('favorites.favorite');        // 追加
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite'); // 追加
    });                                                                                                     // 追加
});