<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mengecek relasi untuk menentukan role user
        if ($user->dokter) {
            session(['user_role' => 'dokter']);
        } else {
            $admin = $user->admin;

            if ($admin) {
                // Cek nilai kolom 'role' dari data admin
                if ($admin->role === 'manager') {
                    session(['user_role' => 'manager']);
                } else {
                    session(['user_role' => 'admin']);
                }
            } else {
                // Jika tidak ada record admin, bisa disetting default role
                session(['user_role' => 'user']);
            }
        } 

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
