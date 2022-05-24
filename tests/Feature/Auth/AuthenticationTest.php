<?php

namespace Tests\Feature\Auth;

use Domain\Users\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_response_405_without_credentials()
    {
        $response = $this->get('api/login');

        $response->assertStatus(405);
    }

    public function test_user_can_register()
    {
        $user = User::factory()->create();

        $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);
    }
}
