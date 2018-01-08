<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
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
        event(new Registered(create('App\User')));
        Mail::assertSent(\App\Mail\PleaseConfirmYourMail::class);
    }

    /**
     * @test
     */
    public function user_can_fully_confirm_their_email_addresses()
    {
        $this->post('/register', [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar',
            'password_confirmation' => 'foobar'
        ]);
        $user = \App\User::whereName('John')->first();
        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);
        $response = $this->get('/register/confirm?token=' . $user->confirmation_token);
        $this->assertTrue($user->fresh()->confirmed);
        $response->assertRedirect('/threads');
    }
}
