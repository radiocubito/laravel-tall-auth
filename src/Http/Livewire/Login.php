<?php

namespace Radiocubito\TallAuth\Http\Livewire;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    use AuthenticatesUsers;

    public $email;

    public $password;

    public $remember;

    public function render()
    {
        return view('tall-auth::livewire.login');
    }

    protected function sendLoginResponse(Request $request)
    {
        session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    protected function validateLogin()
    {
        $this->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin()
    {
        return $this->guard()->attempt(
            $this->credentials(), $this->remember
        );
    }

    protected function credentials()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($this->email).'|'.$request->ip();
    }

    protected function redirectTo()
    {
        return route('home');
    }
}
