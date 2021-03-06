<?php

namespace Radiocubito\TallAuth\Tests\Feature\Http\Livewire\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Radiocubito\TallAuth\Tests\Fixtures\User;
use Radiocubito\TallAuth\Tests\TestCase;

class RequestPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_password_request_page()
    {
        $this->withoutExceptionHandling();
        $this->get(route('password.request'))
            ->assertSuccessful()
            ->assertSeeLivewire('tall-auth.passwords.request-password');
    }

    /** @test */
    public function a_user_must_enter_an_email_address()
    {
        Livewire::test('tall-auth.passwords.request-password')
            ->call('sendResetLinkEmail')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function a_user_must_enter_a_valid_email_address()
    {
        Livewire::test('tall-auth.passwords.request-password')
            ->set('email', 'email')
            ->call('sendResetLinkEmail')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    public function a_user_who_enters_a_valid_email_address_will_get_sent_an_email()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        Livewire::test('tall-auth.passwords.request-password')
            ->set('email', $user->email)
            ->call('sendResetLinkEmail');

        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
    }
}
