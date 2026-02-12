<?php

namespace App\Services;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

/**
 * Service for contact form handling.
 */
class ContactService
{
    /**
     * Send contact form email.
     *
     * @param  array{firstName: string, lastName: string, email: string, inquiryType: string, message: string}  $data
     */
    public function sendContactEmail(array $data): void
    {
        $name = $data['firstName'].' '.$data['lastName'];

        Mail::to(config('mail.from.address'))->send(
            new ContactMail(
                name: $name,
                email: $data['email'],
                inquiryType: $data['inquiryType'],
                body: $data['message'],
            )
        );
    }
}
