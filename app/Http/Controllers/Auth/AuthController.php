<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (!Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            return back()
                ->withErrors(['login' => 'Invalid credentials.'])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath(Auth::user()));
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['role'] = 'user';

        $user = User::create($data);
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath($user));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectPath(?User $user): string
    {
        return route('home');
    }
}
