<?php

namespace Radiocubito\TallAuth\Tests\Feature\Http\Livewire;

use App\Http\Livewire\Auth\Logout;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Radiocubito\TallAuth\Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_log_out()
    {
        $response = Livewire::actingAs(factory(User::class)->create())
            ->test(Logout::class)
            ->call('logout');

        $response->assertRedirect('/');

        $this->assertGuest();
    }

    /** @test */
    public function test_user_cannot_logout_when_not_authenticated()
    {
        $response = Livewire::test(Logout::class)
            ->call('logout');

        $response->assertRedirect('/');

        $this->assertGuest();
    }
}
