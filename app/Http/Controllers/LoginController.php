<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // @desc    Show login form
    // @route   GET /login
    public function login(): View{
        return view('auth.login');
    }

    // @desc   Authenticate user
    // @route   POST /login
    public function authenicate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);

        //dd($credentials);

        // Attempt to authenicate user
        if(Auth::attempt($credentials))
        {
            //Regenerate the sessions to prevent fixation attacks
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'You have been logged in.');
        }

        return back()->withErrors([
            'email'=>'The provided email and password donot match with our records'
            ])->onlyInput('email');
    }

    // @desc    Logout user
    // @route   POST /logout
    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }
}
