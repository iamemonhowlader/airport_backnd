<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Helpers\Helper;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Booking\StoreBookingRequest;
use App\Models\Booking;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        $ticketImagePath = null;
        if ($request->hasFile('ticket_image')) {
            $ticketImagePath = Helper::uploadFile($request->file('ticket_image'), 'bookings/tickets');
        }

        $booking = Booking::create([
            'code' => Helper::generateUniqueId('bookings', 'code', 10),
            'full_name' => $data['full_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'] ?? null,
            'service_type' => $data['service_type'],
            'flight_code' => Str::upper(trim($data['flight_code'])),
            'route' => $data['route'] ?? null,
            'service_date' => $data['service_date'] ?? null,
            'guest_count' => $data['guest_count'] ?? null,
            'ticket_image_path' => $ticketImagePath,
            'comment' => $data['comment'] ?? null,
            'status' => 'pending',
        ]);

        return Helper::success(201, 'Booking created successfully.', [
            'booking' => [
                'id' => $booking->id,
                'code' => $booking->code,
                'status' => $booking->status,
                'ticket_image_url' => $booking->ticket_image_url,
                'created_at' => $booking->created_at,
            ],
        ]);
    }
}
