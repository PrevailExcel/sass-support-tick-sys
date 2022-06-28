<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function tenantLoginPost(Request $request)
    {
        if (!Auth::guard('tenant')->attempt($request->only('email', 'password'))) {
            return redirect()->back()->with('failed', 'Login details do not match');
        }

        $user = Tenant::where('email', $request['email'])->firstOrFail();
        $user->createToken('auth_token', ['role:tenant'])->plainTextToken;
        // return redirect('/tenant');
    }

    public function agentLoginPost(Request $request)
    {
        if (!Auth::guard('agents')->attempt($request->only('email', 'password'))) {
            return redirect()->back()->with('failed', 'Login details do not match');
        }

        $user = Tenant::where('email', $request['email'])->firstOrFail();
        $user->createToken('auth_token', ['role:tenant'])->plainTextToken;
        // return redirect('/tenant');
    }
}
