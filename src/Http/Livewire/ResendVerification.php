<?php

namespace Radiocubito\TallAuth\Http\Livewire;

use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Radiocubito\TallAuth\ThrottlesRequests;

class ResendVerification extends Component
{
    use VerifiesEmails, ThrottlesRequests;

    protected $limiter;

    protected $maxAttempts = 60;

    protected $decayMinutes = 1;

    public $previous;

    public function mount()
    {
        $this->previous = URL::previous();
    }

    public function render()
    {
        return view('tall-auth::livewire.resend-verification');
    }

    public function resend(Request $request)
    {
        $this->checkThrottling($request);

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        $this->incrementAttempts($request);

        session()->flash('resent', true);

        $this->redirect($this->previous);
    }

    protected function redirectTo()
    {
        return RouteServiceProvider::HOME;
    }
}
