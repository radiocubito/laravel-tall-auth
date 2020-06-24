<?php

namespace Radiocubito\TallAuth\Http\Livewire\Passwords;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Livewire\Component;

class ConfirmPassword extends Component
{
    use ConfirmsPasswords;

    public $password;

    public function render()
    {
        return view('livewire.auth.passwords.confirm-password');
    }

    public function confirm(Request $request)
    {
        $this->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        return redirect()->intended($this->redirectPath());
    }

    protected function redirectTo()
    {
        return RouteServiceProvider::HOME;
    }

    protected function resetPasswordConfirmationTimeout()
    {
        session()->put('auth.password_confirmed_at', time());
    }
}
