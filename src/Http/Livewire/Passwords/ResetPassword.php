<?php

namespace Radiocubito\TallAuth\Http\Livewire\Passwords;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;

    public $email;

    public $password;

    public $password_confirmation;

    public function mount($email, $token = null)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function render()
    {
        return view('tall-auth::livewire.passwords.reset-password')->with(
            ['token' => $this->token, 'email' => $this->email]
        );
    }

    public function submit(Request $request)
    {
        $this->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials(),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($response);
    }

    protected function credentials()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token,
        ];
    }

    protected function sendResetResponse(Request $request, $response)
    {
        session()->flash('status', trans($response));

        $this->redirect($this->redirectTo());
    }

    protected function sendResetFailedResponse($response)
    {
        throw ValidationException::withMessages(
            ['email' => trans($response)],
        );
    }

    protected function redirectTo()
    {
        return route('home');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation|min:8',
        ];
    }

    protected function validationErrorMessages()
    {
        return [];
    }

    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
