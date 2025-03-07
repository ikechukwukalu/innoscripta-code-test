<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

use App\Models\User;

class ResetPasswordTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testValidUrlForForgotPassword()
    {
        $response = $this->get(route('password.reset'));

        $response->assertStatus(200);
    }

    public function testErrorValidationForResetPassword()
    {
        $postData = [
            'email' => 'testuser2gmail.com', //Wrong email format
            'password' => 'password',
            'password_confirmation' => '1234567', //None matching passwords
        ];

        $response = $this->postJson(route('password.update'), $postData);
        $responseArray = $response->json();

        $this->assertFalse($responseArray['success']);

        //This test would also run correctly if an existing email is passed
    }

    public function testResetPassword()
    {
        $user = User::factory()->create();

        $postData = [
            'email' => $user->email,
            'password' => '$Ty12345678',
            'password_confirmation' => '$Ty12345678'
        ];

        $response = $this->postJson(route('resetPassword'), $postData);
        $responseArray = $response->json();

        $response->assertOk();
        $this->assertTrue($responseArray['success']);
    }
}
