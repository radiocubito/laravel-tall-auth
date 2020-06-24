<?php

namespace Radiocubito\TallAuth\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('tall-auth::passwords.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
