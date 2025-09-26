<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TenantRegistrationController extends Controller
{
    /**
     * Show owner self-registration form.
     */
    public function create()
    {
        return view('auth.register-tenant');
    }

    /**
     * Handle owner registration submission.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'owner',
        ]);

        return redirect()->route('login')->with('status', 'Registration successful. Please login.');
    }
}


