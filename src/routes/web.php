<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [ShopsController::class, 'index'])->name('root');
Route::get('/detail/{shop_id}', [ShopsController::class, 'detail'])->name('shop.detail');

Route::get('/search', [ShopsController::class, 'search'])->name('shop.search');

Route::middleware(['auth'])->group(function () {

    Route::get('/thanks', function () {
        return view('thanks');
    })->name('thanks');

    Route::get('/mypage', function () {
        if (!auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }
        return app(UsersController::class)->mypage();
    })->name('mypage');

    Route::post('/like/{shop_id}', [FavoriteController::class, 'create'])->name('like');
    Route::post('/unlike/{shop_id}', [FavoriteController::class, 'delete'])->name('unlike');

    Route::post('/reservation', [ReservationsController::class, 'create'])->name('reserve.create');
    Route::post('/reserve/change/{reservation_id}', [ReservationsController::class, 'change'])->name('reserve.change');
    Route::post('/reserve/delete/{reservation_id}', [ReservationsController::class, 'delete'])->name('reserve.delete');

    Route::post('/payment', [UsersController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/success', [UsersController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [UsersController::class, 'paymentCancel'])->name('payment.cancel');

    Route::get('/generate-qr', [UsersController::class, 'generateQrCode'])->name('generate.qr');

});

require __DIR__.'/auth.php';
