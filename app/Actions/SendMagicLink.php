<?php

namespace App\Actions;

use App\Mail\EmailMagicLink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SendMagicLink
{
    use AsAction;

    public function rules()
    {
        if (request()->get('type', 'login') === 'register') {
            return [
                'email' => ['required', 'email', Rule::unique('users')],
                'name' => ['required'],
            ];
        }

        return [
            'email' => ['required', 'email', Rule::exists('users')]
        ];
    }

    public function handle($data)
    {
        Mail::to($data['email'])->send(new EmailMagicLink($data));
    }

    public function asController(ActionRequest $request)
    {
        $this->handle($request->all());

        return back()->with('success', request()->get('type', 'login') ? 'Send login magic link success!' : 'Send register magic link success!');
    }
}
