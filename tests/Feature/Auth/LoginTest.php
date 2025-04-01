<?php

namespace Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_login_with_email_and_password()
    {
        User::factory()->create([
            'email' => 'john@doe.com',
            'password' => Hash::make('password') // Ensure the password is hashed
        ]);


        $response = $this->postJson(route('user.login'),[
            'email' => 'john@doe.com',
            'password' => 'password',
        ])->assertOk();

        $response->assertStatus(200) // Should be successful
                 ->assertJsonStructure(['token']); // Ensure token is returned

    }

    public function test_if_user_email_is_not_available_then_return_error()
    {
        $response = $this->postJson(route('user.login'),[
            'email' => 'john@doe.com',
            'password' => 'password',
        ])->assertUnauthorized();
    }


    public function test_if_user_password_is_not_valid_then_return_error()
    {

        User::factory()->create([
            'email' => 'john@doe.com',
            'password' => Hash::make('password') // Ensure the password is hashed
        ]);

        $response = $this->postJson(route('user.login'),[
            'email' => 'john@doe.com',
            'password' => '1234',
        ])->assertUnauthorized();


    }
}
