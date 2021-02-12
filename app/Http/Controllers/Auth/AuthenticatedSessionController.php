<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('org');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // $cred = $request->only('email', 'password');
        // if (Auth::attempt($cred)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('index');
        // }
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
      
        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->flash('status', 'Task was successful!');
        // return redirect()->intended('index');
        return redirect(RouteServiceProvider::HOME);
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
