<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendContactMailRequest;
use App\Mail\ContactMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Send contact form email.
     */
    public function send(SendContactMailRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $name = $validated['firstName'].' '.$validated['lastName'];

        Mail::to(config('mail.from.address'))->send(
            new ContactMail(
                name: $name,
                email: $validated['email'],
                subject: $validated['inquiryType'],
                message: $validated['message'],
            )
        );

        return response()->json([
            'message' => 'Your message has been sent successfully.',
        ]);
    }
}
