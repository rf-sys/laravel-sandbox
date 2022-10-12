<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter): RedirectResponse
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request()->string('email'));
        } catch (Exception) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter!');
    }
}
