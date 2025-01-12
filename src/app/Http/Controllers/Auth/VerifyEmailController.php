<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));

                \Log::info('User verified: ' . $request->user()->id);
            } else {
                \Log::error('Verification failed for user: ' . $request->user()->id);
            }
        }

        Auth::login($request->user());

        \Log::info('User logged in: ' . $request->user()->id);

        return redirect()->route('thanks');
    }
}
