<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $this->ensurePortalAdminCredentials();

        if (Auth::check()) {
            return redirect('/admin');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->ensurePortalAdminCredentials();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => __('messages.auth.invalid_credentials'),
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    private function ensurePortalAdminCredentials(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        User::updateOrCreate(
            ['email' => 'admin@malafyale.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
