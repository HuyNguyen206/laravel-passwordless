<?php

namespace Tests\Feature;

use App\Mail\EmailMagicLink;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterEmailTest extends TestCase
{
    public function test_email_is_valid(): void
    {
        $this->post('register-email', [
            'email' => 'non',
        ])->assertSessionHasErrors(['email']);
    }

    public function test_email_must_be_unique()
    {
        User::factory()->create([  'email' => 'huy@gmail.com']);

        $this->post('register-email', [
            'email' => 'huy@gmail.com'
        ])->assertSessionHasErrors(['email']);
    }

    public function test_send_magic_link_email()
    {
        Mail::fake();
        /**
         * @var TestCase $this
         */
        $data = \App\Models\User::factory()->make()->only(['email', 'name']);
        $this->post('register-email', $data + ['type' => 'register'])->assertSessionHas('success');

        Mail::assertSent(EmailMagicLink::class, fn (Mailable $mailable) => $mailable->hasTo($data['email']));
    }
}
