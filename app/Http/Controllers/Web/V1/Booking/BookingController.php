<?php

namespace App\Http\Controllers\Web\V1\Booking;

use App\Http\Requests\Web\V1\Booking\UpdateBookingStatusRequest;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController
{
    public function index(): View
    {
        $bookings = Booking::query()->latest()->paginate(20);
        return view('backend.layouts.booking.index', compact('bookings'));
    }

    public function show(Booking $booking): View
    {
        return view('backend.layouts.booking.show', compact('booking'));
    }

    public function updateStatus(UpdateBookingStatusRequest $request, Booking $booking): RedirectResponse
    {
        $booking->update([
            'status' => $request->validated()['status']
        ]);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
