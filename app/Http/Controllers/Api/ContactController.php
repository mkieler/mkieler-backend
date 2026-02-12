<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendContactMailRequest;
use App\Services\ContactService;

/**
 * Controller for contact form endpoints.
 */
class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private ContactService $contactService
    ) {}

    /**
     * Send contact form email.
     *
     * @return array{message: string}
     */
    public function send(SendContactMailRequest $request): array
    {
        $this->contactService->sendContactEmail($request->validated());

        return [
            'message' => 'Your message has been sent successfully.',
        ];
    }
}
