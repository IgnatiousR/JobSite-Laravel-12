<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    // @desc    Update profile info
    // @route   PUT /profile
    public function update(Request $request): RedirectResponse{
        $user =Auth::user();

        //Valid data
        $validatedData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email',
            //'password'=>'required|string|min:8'
            'avatar'=>'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->hasFile('avatar')){

            // Delete old avatar if exists
            if($user->avatar){
                Storage::delete('public/' . basename($user->avatar));
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }
}
