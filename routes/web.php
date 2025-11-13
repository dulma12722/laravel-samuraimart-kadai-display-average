<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // 2025-10-21-商品を追加できるようにしよう
use App\Http\Controllers\ReviewController; // 2025-10-25-レビュー機能を追加しよう
use App\Http\Controllers\FavoriteController; // 2025-10-26-お気に入り機能を追加しよう
use App\Http\Controllers\UserController; // 2025-10-26-ユーザー情報を編集できるようにしよう
use App\Http\Controllers\CartController; // 2025-10-28-ショッピングカート機能を追加しようNo2
use App\Http\Controllers\WebController; // 2025-10-28-トップページを修正しよう
use App\Http\Controllers\CheckoutController; // 2025-11-06-決済機能を追加しよう
use App\Http\Controllers\FaqController; // 2025-11-08-生成AIを利用してよくある質問（FAQ）ページを追加しよう
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

Route::get('/',  [WebController::class, 'index'])->name('top');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class);

    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('favorites/{product_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{product_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
        Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
        Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
        Route::get('users/mypage/cart_history', 'cart_history_index')->name('mypage.cart_history');
        Route::get('users/mypage/cart_history/{num}', 'cart_history_show')->name('mypage.cart_history_show');
    });

    // 注文履歴
    Route::controller(CartController::class)->group(function () {
        Route::get('users/carts', 'index')->name('carts.index');
        Route::post('users/carts', 'store')->name('carts.store');
        Route::delete('users/carts', 'destroy')->name('carts.destroy');
    });

    // 決済機能
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout', 'index')->name('checkout.index');
        Route::post('checkout', 'store')->name('checkout.store');
        Route::get('checkout/success', 'success')->name('checkout.success');
    });

});

// よくある質問（FAQ）
Route::get('faqs',  [FaqController::class, 'index'])->name('faqs.index');