<?php

namespace App\Http\Requests\Api\V1\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],

            'service_type' => ['required', 'string', 'max:30', 'in:SILVER,GOLD,PLATINUM'],
            'flight_code' => ['required', 'string', 'max:20'],
            'route' => ['nullable', 'string', 'max:40'],
            'service_date' => ['nullable', 'date'],
            'flight_time' => ['nullable', 'string', 'max:10', 'regex:/^([01][0-9]|2[0-3]):[0-5][0-9]$/'],
            'guest_count' => ['nullable', 'string', 'max:20'],

            'ticket_image' => ['nullable', 'file', 'image', 'max:5120'], // 5MB
            'comment' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
