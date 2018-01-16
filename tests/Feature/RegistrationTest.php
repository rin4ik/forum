<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends TestCase
{
    /**
     *  @test
     *
     */
    public function a_confirmation_sent_upon_registration()
    {
        Mail::fake();
        $this->post(route('register'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar'
        ]);
        Mail::assertQueued(\App\Mail\PleaseConfirmYourEmail::class);
    }

    /**
     * @test
     */
    public function user_can_fully_confirm_their_email_addresses()
    {
        Mail::fake();
        $this->post(route('register'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar'
        ]);
        $user = \App\User::whereName('John')->first();
        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);
        $this->get(route('register.confirm', ['token' => $user->confirmation_token]))
        ->assertRedirect(route('threads'));
        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->confirmed);
            $this->assertNull($user->confirmation_token);
        });
    }

    /**
     * @test
     */
    public function confirming_an_invalid_token()
    {
        $this->get(route('register.confirm', ['token' => 'invalid']))
        ->assertRedirect(route('threads'))
        ->assertSessionHas('flash', 'Unknown token!');
    }
}
