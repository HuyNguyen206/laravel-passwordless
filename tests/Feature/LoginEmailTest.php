<?php

namespace Tests\Feature;

use App\Mail\EmailMagicLink;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LoginEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_email_is_valid(): void
    {
        $this->post('login-email', [
            'email' => 'non'
        ])->assertSessionHasErrors(['email']);
    }

    public function test_email_must_be_exist()
    {
        $this->post('login-email', [
            'email' => 'huy@gmail.com'
        ])->assertSessionHasErrors(['email']);
    }

    public function test_send_magic_link_email()
    {
        Mail::fake();
        /**
         * @var TestCase $this
         */
        $user = \App\Models\User::factory()->create();
        $this->withoutExceptionHandling();
        $this->post('login-email', [
            'email' => $user->email
        ])->assertSessionHas('success');

        Mail::assertSent(EmailMagicLink::class, fn (Mailable $mailable) => $mailable->hasTo($user->email));
    }
}
