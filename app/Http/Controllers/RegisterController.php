<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // @desc    Show register form
    // @route   GET /register
    public function register(): View{
        return view('auth.register');
    }

     // @desc    Store user in database
    // @route   POST /register
    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);


        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        if($request->hasFile('avatar')){
            $path = $request->file('avatar')->store('avatars', 'public');

            // Add path to validatedData
            $validatedData['avatar'] = $path;
        }

        $user = User::create($validatedData);

        return redirect()->route('login')->with('success', 'You have been registered, please login.');
    }
}
