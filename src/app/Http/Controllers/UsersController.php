<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UsersController extends Controller
{
    public function mypage()
    {
        $user = User::with('reservations', 'likes.area', 'likes.genre', 'likes.likes')->findOrFail(Auth::id());;

        return view('/mypage', compact("user"));
    }

    public function createPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => 'Reservation Payment',
                    ],
                    'unit_amount' => $request->amount * 100, // 金額 (100円 = 1単位)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($checkoutSession->url);
    }

    public function paymentSuccess()
    {
        session()->flash('fs_msg', '決済が完了しました。');
        return redirect()->route('mypage');
    }

    public function paymentCancel()
    {
        session()->flash('fs_msg', '決済がキャンセルされました。');
        return redirect()->route('mypage');
    }

    public function generateQrCode()
    {
        $qrCode = QrCode::format('png')->size(250)->generate('https://example.com');
        return response($qrCode, 200)->header('Content-Type', 'image/png');
    }
}
