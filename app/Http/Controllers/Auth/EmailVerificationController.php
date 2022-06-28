<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function show(){
        return view('auth.verify-email');
    }
    
    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    }

    public function notify(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

}
