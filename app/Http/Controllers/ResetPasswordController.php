<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    //

    public function showResetForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }
    public function reset(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Attempt to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        // Return success or error response
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('showLogin')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
