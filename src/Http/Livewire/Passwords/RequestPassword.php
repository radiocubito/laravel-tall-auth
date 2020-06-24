<?php

namespace Radiocubito\TallAuth\Http\Livewire\Passwords;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class RequestPassword extends Component
{
    use SendsPasswordResetEmails;

    public $email;

    public $previous;

    public function mount(Request $request)
    {
        $this->email = $request->email;
    }

    public function render()
    {
        return view('tall-auth::livewire.passwords.request-password');
    }

    protected function redirectTo()
    {
        return RouteServiceProvider::HOME;
    }

    protected function validateEmail()
    {
        $this->validate(['email' => 'required|email']);
    }

    protected function credentials()
    {
        return ['email' => $this->email];
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        session()->flash('status', trans($response));

        $this->redirect(route('password.request'));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        throw ValidationException::withMessages(
            ['email' => trans($response)],
        );
    }
}
