<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'code',
        'full_name',
        'phone_number',
        'email',
        'service_type',
        'flight_code',
        'route',
        'service_date',
        'flight_time',
        'guest_count',
        'ticket_image_path',
        'comment',
        'status',
    ];

    protected $casts = [
        'service_date' => 'date',
    ];

    public function getTicketImageUrlAttribute(): ?string
    {
        if (!$this->ticket_image_path) return null;

        // Get the base URL from the current request
        $baseUrl = request()->getSchemeAndHttpHost();

        // Create the URL manually to avoid using Storage::url() which uses APP_URL
        $path = '/storage/' . $this->ticket_image_path;

        return $baseUrl . $path;
    }
}
