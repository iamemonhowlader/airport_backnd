@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Booking {{ $booking->code }}
@endsection

@section('content')
    <div class="container-fluid py-5">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-1 fw-extrabold tracking-tight">Booking {{ $booking->code }}</h1>
                <p class="text-muted mb-0">View full booking request details.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a class="btn btn-outline-light border bg-white shadow-sm" href="{{ route('admin.bookings.index') }}">Back</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-xl overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Full Name</div>
                                <div class="fw-bold">{{ $booking->full_name }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Phone</div>
                                <div class="fw-bold">{{ $booking->phone_number }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Email</div>
                                <div class="fw-bold">{{ $booking->email ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Status</div>
                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group input-group-sm" style="max-width: 200px;">
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-check"></i> Update
                                        </button>
                                    </div>
                                </form>
                                @if(session('success'))
                                    <div class="alert alert-success alert-sm mt-2 mb-0">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>

                            <hr class="my-2" />

                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Service Type</div>
                                <div class="fw-bold text-capitalize">{{ $booking->service_type }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Flight Code</div>
                                <div class="fw-bold">{{ $booking->flight_code }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Route</div>
                                <div class="fw-bold">{{ $booking->route ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Service Date</div>
                                <div class="fw-bold">{{ optional($booking->service_date)->format('Y-m-d') ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Flight Time (24-hour format)</div>
                                <div class="fw-bold">{{ $booking->flight_time ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">Guests</div>
                                <div class="fw-bold">{{ $booking->guest_count ?? '-' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted small mb-1">Comment</div>
                                <div class="fw-bold" style="white-space: pre-wrap;">{{ $booking->comment ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-xl overflow-hidden">
                    <div class="card-body p-4">
                        <div class="text-muted small mb-2">Ticket / Image</div>
                        @if($booking->ticket_image_url)
                            <a href="{{ $booking->ticket_image_url }}" target="_blank">
                                <img src="{{ $booking->ticket_image_url }}" class="img-fluid rounded-lg" alt="Ticket image" />
                            </a>
                        @else
                            <div class="text-muted">No file uploaded.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

