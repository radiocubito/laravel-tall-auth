<?php

namespace Radiocubito\TallAuth\Http\Livewire;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Livewire\Component;

class Logout extends Component
{
    use AuthenticatesUsers;

    public function render()
    {
        return view('tall-auth::livewire.logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        session()->invalidate();

        session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
