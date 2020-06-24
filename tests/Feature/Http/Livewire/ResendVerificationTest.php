<?php

namespace Radiocubito\TallAuth\Tests\Feature\Http\Livewire;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Radiocubito\TallAuth\Tests\Fixtures\User;
use Radiocubito\TallAuth\Tests\TestCase;

class ResendVerificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_resend_verification_email()
    {
        Notification::fake();

        $user = factory(User::class)->create([
            'email_verified_at' => null,
        ]);

        Livewire::actingAs($user);

        Livewire::test('tall-auth.resend-verification')
            ->call('resend');

        Notification::assertSentTo($user, VerifyEmail::class);

        $this->assertTrue(session('resent'));
    }
}
