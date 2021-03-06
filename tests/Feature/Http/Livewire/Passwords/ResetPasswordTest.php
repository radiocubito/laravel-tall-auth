<?php

namespace Radiocubito\TallAuth\Tests\Feature\Http\Livewire\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Radiocubito\TallAuth\Tests\Fixtures\User;
use Radiocubito\TallAuth\Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_password_reset_page()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $token = Str::random(16);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        $this->get(route('password.reset', [
            'email' => $user->email,
            'token' => $token,
        ]))
            ->assertSuccessful()
            ->assertSeeLivewire('tall-auth.passwords.reset-password');
    }

    /** @test */
    public function can_reset_password()
    {
        $user = factory(User::class)->create();

        $token = Str::random(16);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => $user->email,
            'token' => $token,
        ])
            ->set('email', $user->email)
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('submit');

        $this->assertTrue(Auth::attempt([
            'email' => $user->email,
            'password' => 'new-password',
        ]));
    }

    /** @test */
    public function token_is_required()
    {
        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => 'john@example.com',
            'token' => null,
        ])
            ->call('submit')
            ->assertHasErrors(['token' => 'required']);
    }

    /** @test */
    public function email_is_required()
    {
        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => 'john@example.com',
            'token' => Str::random(16),
        ])
            ->set('email', null)
            ->call('submit')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function email_is_valid_email()
    {
        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => 'john@example.com',
            'token' => Str::random(16),
        ])
            ->set('email', 'email')
            ->call('submit')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    public function password_is_required()
    {
        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => 'john@example.com',
            'token' => Str::random(16),
        ])
            ->set('password', '')
            ->call('submit')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    public function password_is_minimum_of_eight_characters()
    {
        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => 'john@example.com',
            'token' => Str::random(16),
        ])
            ->set('password', 'secret')
            ->call('submit')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    public function password_matches_password_confirmation()
    {
        Livewire::test('tall-auth.passwords.reset-password', [
            'email' => 'john@example.com',
            'token' => Str::random(16),
        ])
            ->set('password', 'new-password')
            ->set('password_confirmation', 'not-new-password')
            ->call('submit')
            ->assertHasErrors(['password' => 'same']);
    }
}
