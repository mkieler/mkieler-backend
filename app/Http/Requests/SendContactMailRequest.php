<?php

namespace App\Http\Requests;

use App\Rules\TurnstileToken;
use Illuminate\Foundation\Http\FormRequest;

class SendContactMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'inquiryType' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'turnstileToken' => ['required', 'string', new TurnstileToken],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'firstName.required' => 'Please provide your first name.',
            'lastName.required' => 'Please provide your last name.',
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
            'inquiryType.required' => 'Please select an inquiry type.',
            'message.required' => 'Please provide a message.',
            'message.max' => 'The message may not be greater than 5000 characters.',
            'turnstileToken.required' => 'Please complete the verification.',
        ];
    }
}
