@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Intern Location Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-locations.index') }}"
                            class="{{ request()->routeIs('intern-locations.index') ? 'active' : '' }}">
                            Intern Location Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-locations.show', $internLocation) }}"
                            class="{{ request()->routeIs('intern-locations.show') ? 'active' : '' }}">
                            Show Intern Location
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="icon-circle bg-primary text-white mb-2"
                            style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; font-size: 30px;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <strong class="text-primary">Location Info</strong>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-dark font-weight-bold mb-2">Location Name</h5>
                        <p class="text-muted">{{ $internLocation->intern_location_name }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Address</h5>
                        <p class="text-muted">{{ $internLocation->intern_location_address }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Province, Regency, District, Village</h5>
                        <p class="text-muted">
                            {{ $internLocation->intern_location_province }},
                            {{ $internLocation->intern_location_regency }},
                            {{ $internLocation->intern_location_district }},
                            {{ $internLocation->intern_location_village }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Country</h5>
                        <p class="text-muted">{{ $internLocation->intern_location_country }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Postal Code</h5>
                        <p class="text-muted">{{ $internLocation->intern_location_postal_code }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Phone Number</h5>
                        <p class="text-muted">{{ $internLocation->intern_location_phone_number }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Location Type</h5>
                        <p class="text-muted text-capitalize">
                            {{ str_replace('_', ' ', $internLocation->intern_location_type) }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Status</h5>
                        <p>
                            @if ($internLocation->intern_location_status === 'active')
                                <span
                                    class="badge badge-success text-capitalize">{{ $internLocation->intern_location_status }}</span>
                            @elseif ($internLocation->intern_location_status === 'inactive')
                                <span
                                    class="badge badge-danger text-capitalize">{{ $internLocation->intern_location_status }}</span>
                            @else
                                <span
                                    class="badge badge-light text-capitalize">{{ $internLocation->intern_location_status }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('intern-locations.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item {
            font-size: 0.875rem;
        }

        .breadcrumb-item a {
            color: #464646;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item a.active {
            font-weight: bold;
            color: #007bff;
            pointer-events: none;
        }

        .icon-circle {
            display: inline-block;
            text-align: center;
        }
    </style>
@endpush
