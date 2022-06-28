<?php

namespace App\Http\Controllers;

use App\Jobs\ConfigureTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function createTenant(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'subdomain' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tenants'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        $tenant = Tenant::create([
            'name' => $request->name,
            'subdomain' => $request->subdomain,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        ConfigureTenant::dispatch($tenant);
    }
}
