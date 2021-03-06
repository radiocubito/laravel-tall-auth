<?php

namespace Radiocubito\TallAuth\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Radiocubito\TallAuth\Tests\Fixtures\User;
use Radiocubito\TallAuth\Tests\TestCase;

class VerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_verification_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        auth()->login($user);

        $this->get(route('verification.notice'))
            ->assertSuccessful();
    }

    /** @test */
    public function can_verify()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        auth()->login($user);

        $url = url()->temporarySignedRoute('verification.verify', now()->addMinutes(config('auth.verification.expire', 60)), [
            'id' => $user->getKey(),
            'hash' => sha1($user->getEmailForVerification()),
        ]);

        $this->get($url)
            ->assertRedirect('/home');

        $this->assertTrue($user->hasVerifiedEmail());
    }
}
