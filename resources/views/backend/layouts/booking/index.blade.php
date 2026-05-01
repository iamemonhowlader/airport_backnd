@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Bookings
@endsection

@section('content')
    <style>
        .btn-primary {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: white !important;
            transition: all 0.3s ease !important;
        }
        .btn-primary:hover {
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3) !important;
        }
        .table-responsive {
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .table-responsive table {
                font-size: 0.875rem;
            }
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
    </style>
    <div class="container-fluid py-5">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-1 fw-extrabold tracking-tight">Bookings</h1>
                <p class="text-muted mb-0">Latest booking requests from the website.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-xl overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light border-0">
                    <tr>
                        <th class="py-3 ps-4 border-0 small text-uppercase fw-bold text-muted">Code</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Name</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Phone</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Email</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Service</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Flight</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Date</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Guests</th>
                        <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Status</th>
                        <th class="py-3 pe-4 border-0 small text-uppercase fw-bold text-muted text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bookings as $b)
                        <tr>
                            <td class="ps-4 py-3 fw-bold">{{ $b->code }}</td>
                            <td class="py-3">{{ $b->full_name }}</td>
                            <td class="py-3">{{ $b->phone_number }}</td>
                            <td class="py-3">{{ $b->email ?: 'N/A' }}</td>
                            <td class="py-3 text-capitalize">{{ $b->service_type }}</td>
                            <td class="py-3">{{ $b->flight_code }}</td>
                            <td class="py-3">{{ optional($b->service_date)->format('Y-m-d') ?: 'N/A' }}</td>
                            <td class="py-3">{{ $b->guest_count ?: '1' }}</td>
                            <td class="py-3">
                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2 small fw-bold text-capitalize">
                                    {{ $b->status }}
                                </span>
                            </td>
                            <td class="py-3 pe-4 text-end">
                                <a class="btn btn-sm btn-primary text-white shadow-sm hover-lift"
                                   href="{{ route('admin.bookings.show', $b) }}">
                                    <i class="fas fa-eye me-1"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-5 text-center text-muted">No booking requests yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
@endsection

