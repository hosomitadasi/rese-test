<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;
use App\Models\User;

// 飲食店ホームページ表示ルート
Route::get('/', [ShopsController::class, 'index'])->name('root');

// 各飲食店ごとの詳細ページ表示ルート
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');

// 飲食店検索ルート
Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');

// ログイン処理後表示可能ルート
Route::middleware('auth')->group(function () {

    // 会員登録ありがとうページ表示ルート
    Route::get('/thanks', function () {
        return view('thanks');
    });

    // それぞれのユーザーごとのページ表示ルート
    Route::get('/mypage', [UsersController::class, 'mypage'])->name('mypage');

    // お気に入り登録用ルート
    Route::post('/like/{shop_id}', [FavoriteController::class, 'create'])->name('like');

    // お気に入り登録削除用ルート
    Route::post('/unlike/{shop_id}', [FavoriteController::class, 'delete'])->name('unlike');

    // 予約登録ルート
    Route::post('/reservation', [ReservationsController::class, 'create'])->name('reserve.create');

    Route::post('/reserve/change/{reservation_id}', [ReservationsController::class, 'change'])->name('reserve.change');

    // 予約削除ルート
    Route::post('/reserve/delete/{reservation_id}', [ReservationsController::class, 'delete'])->name('reserve.delete');

    Route::post('/payment', [UsersController::class, 'createPayment'])->name('payment.create');

    Route::get('/payment/success', [UsersController::class, 'paymentSuccess'])->name('payment.success');

    Route::get('/payment/cancel', [UsersController::class, 'paymentCancel'])->name('payment.cancel');

    Route::get('/generate-qr', [UsersController::class, 'generateQrCode'])->name('generate.qr');

});

// authの機能を利用した登録、ログイン処理ルート
require __DIR__.'/auth.php';
