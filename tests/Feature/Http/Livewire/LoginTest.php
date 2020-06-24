<?php

namespace Radiocubito\TallAuth\Tests\Feature\Http\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Livewire\Livewire;
use Radiocubito\TallAuth\Http\Livewire\Login;
use Radiocubito\TallAuth\Tests\Fixtures\User;
use Radiocubito\TallAuth\Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_login_page()
    {
        $this->withoutExceptionHandling();

        $this->get(route('tall-auth.login'))
            ->assertSuccessful()
            ->assertSeeLivewire('tall-auth.login');
    }

    /** @test */
    public function is_redirected_if_already_logged_in()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $this->get(route('tall-auth.login'))
            ->assertRedirect('/home');
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = factory(User::class)->create(['password' => Hash::make('password')]);

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login');

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function is_redirected_to_the_home_page_after_login()
    {
        $user = factory(User::class)->create(['password' => Hash::make('password')]);

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('home'));
    }

    /** @test */
    public function email_is_required()
    {
        $user = factory(User::class)->create(['password' => Hash::make('password')]);

        Livewire::test(Login::class)
            ->set('password', 'password')
            ->call('login')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function password_is_required()
    {
        $user = factory(User::class)->create(['password' => Hash::make('password')]);

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->call('login')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    public function incorrect_password_login_attempt_shows_message()
    {
        $user = factory(User::class)->create();

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'bad-password')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function incorrect_email_login_attempt_shows_message()
    {
        Livewire::test(Login::class)
            ->set('email', 'nobody@example.com')
            ->set('password', 'bad-password')
            ->call('login')
            ->assertHasErrors('email');

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function cannot_make_more_than_five_attempts_in_one_minute()
    {
        $user = factory(User::class)->create(['password' => Hash::make('password')]);

        foreach (range(0, 5) as $_) {
            $response = Livewire::test(Login::class)
                ->set('email', $user->email)
                ->set('password', 'bad-password')
                ->call('login');
        }

        $response->assertHasErrors('email');

        $this->assertRegExp(
            $this->getTooManyLoginAttemptsMessage(),
            collect((new MessageBag($response->payload['errorBag'] ?: []))->get('email'))->first()
        );

        $this->assertFalse(Auth::check());
    }

    protected function getTooManyLoginAttemptsMessage()
    {
        return sprintf('/^%s$/', str_replace('\:seconds', '\d+', preg_quote(__('auth.throttle'), '/')));
    }
}
