@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Internship Offering Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.index') }}"
                            class="{{ request()->routeIs('internship-offering.index') ? 'active' : '' }}">
                            Internship Offering Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.show', $offering) }}"
                            class="{{ request()->routeIs('internship-offering.show', $offering) ? 'active' : '' }}">
                            Show Internship Offering
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="icon-circle bg-primary text-white mb-2"
                            style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; font-size: 30px;">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <strong class="text-primary">Offering Info</strong>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-dark font-weight-bold mb-2">Intern Position</h5>
                        <p class="text-muted">{{ $offering->internPosition->name_intern_positions }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Internship Batch</h5>
                        <p class="text-muted">{{ $offering->internBatch->name_intern_batches }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Quota</h5>
                        <p>{{ $offering->quota_intern_position_batches }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Status</h5>
                        <p>
                            @if ($offering->status_intern_position_batches === 'active')
                                <span
                                    class="badge badge-success text-capitalize">{{ $offering->status_intern_position_batches }}</span>
                            @elseif ($offering->status_intern_position_batches === 'inactive')
                                <span
                                    class="badge badge-danger text-capitalize">{{ $offering->status_intern_position_batches }}</span>
                            @else
                                <span
                                    class="badge badge-light text-capitalize">{{ $offering->status_intern_position_batches }}</span>
                            @endif
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Registration Period</h5>
                        <p>
                            {{ \Carbon\Carbon::parse($offering->start_date_intern_position_batches)->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($offering->end_date_intern_position_batches)->format('d M Y') }}
                            ({{ \Carbon\Carbon::parse($offering->start_date_intern_position_batches)->diffInDays(\Carbon\Carbon::parse($offering->end_date_intern_position_batches)) + 1 }}
                            days /
                            {{ \Carbon\Carbon::parse($offering->start_date_intern_position_batches)->diffInMonths(\Carbon\Carbon::parse($offering->end_date_intern_position_batches)) }}
                            months)
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Internship Period</h5>
                        <p>
                            {{ \Carbon\Carbon::parse($offering->start_internship_position_batches)->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($offering->end_internship_position_batches)->format('d M Y') }}
                            ({{ \Carbon\Carbon::parse($offering->start_internship_position_batches)->diffInDays(\Carbon\Carbon::parse($offering->end_internship_position_batches)) + 1 }}
                            days /
                            {{ \Carbon\Carbon::parse($offering->start_internship_position_batches)->diffInMonths(\Carbon\Carbon::parse($offering->end_internship_position_batches)) }}
                            months)
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-3">Location</h5>
                        @if ($offering->internLocation)
                            <div class="card border-0 shadow-sm p-3 bg-white rounded location-card">
                                <div class="d-flex align-items-start">
                                    <div class="mr-3">
                                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 font-weight-bold">
                                            {{ $offering->internLocation->intern_location_name }}
                                        </h6>
                                        <p class="mb-2 text-muted" style="line-height: 1.4;">
                                            {{ $offering->internLocation->intern_location_address }}<br>
                                            {{ $offering->internLocation->intern_location_district }},
                                            {{ $offering->internLocation->intern_location_regency }},
                                            {{ $offering->internLocation->intern_location_province }}<br>
                                            {{ $offering->internLocation->intern_location_postal_code }}<br>
                                            {{ $offering->internLocation->intern_location_country }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>
                                                <i class="fas fa-phone-alt mr-1 text-secondary"></i>Phone:
                                            </strong>
                                            {{ $offering->internLocation->intern_location_phone_number }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">-</p>
                        @endif


                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle {{ $offering->compensation_intern_position_batches === 'paid' ? 'bg-success' : 'bg-warning' }} text-white mr-3"
                                    style="width: 50px; height: 50px; line-height: 50px; border-radius: 50%; font-size: 24px;">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <h5 class="text-dark font-weight-bold mb-0">Compensation</h5>
                            </div>

                            <div class="p-3 rounded border bg-light shadow-sm">
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <strong>Type:</strong><br>
                                        @if ($offering->compensation_intern_position_batches === 'paid')
                                            <span class="badge badge-success text-capitalize">
                                                {{ $offering->compensation_intern_position_batches }}
                                            </span>
                                        @else
                                            <span class="badge badge-warning text-capitalize">
                                                {{ $offering->compensation_intern_position_batches }}
                                            </span>
                                        @endif
                                    </div>

                                    @if (
                                        $offering->compensation_intern_position_batches === 'paid' &&
                                            $offering->compensation_amount_intern_position_batches)
                                        <div class="col-md-4 mb-2">
                                            <strong>Amount:</strong><br>
                                            Rp{{ number_format($offering->compensation_amount_intern_position_batches, 0, ',', '.') }}
                                            / bulan
                                        </div>
                                    @endif
                                </div>

                                @if ($offering->compensation_intern_position_batches === 'unpaid')
                                    <div class="mt-3">
                                        <strong>Note:</strong>
                                        <p class="mt-1 text-muted mb-0" style="font-style: italic; text-align: justify">
                                            Walaupun posisi magang ini tidak berbayar, peserta magang akan mendapatkan
                                            pengalaman langsung yang berharga, pengembangan keterampilan, dan wawasan
                                            industri.
                                            Peserta dengan performa terbaik berkesempatan untuk diangkat menjadi karyawan
                                            tetap setelah masa magang.
                                        </p>
                                    </div>
                                @endif

                                {{-- Hanya tampilkan deskripsi jika compensation paid --}}
                                @if (
                                    $offering->compensation_intern_position_batches === 'paid' &&
                                        $offering->compensation_description_intern_position_batches)
                                    <div class="mt-3">
                                        <strong>Description:</strong>
                                        <div class="mt-1 text-muted">
                                            {!! $offering->compensation_description_intern_position_batches !!}
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>

                        {{-- Description --}}
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle bg-info text-white mr-3"
                                    style="width: 50px; height: 50px; line-height: 50px; border-radius: 50%; font-size: 24px;">
                                    <i class="fas fa-align-left"></i>
                                </div>
                                <h5 class="text-dark font-weight-bold mb-0">Description</h5>
                            </div>
                            <div class="p-3 rounded border bg-light shadow-sm">
                                {!! $offering->description_intern_position_batches !!}
                            </div>
                        </div>

                        {{-- Apply Requirements --}}
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle bg-danger text-white mr-3"
                                    style="width: 50px; height: 50px; line-height: 50px; border-radius: 50%; font-size: 24px;">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <h5 class="text-dark font-weight-bold mb-0">Apply Requirements</h5>
                            </div>
                            <div class="p-3 rounded border bg-light shadow-sm">
                                {!! $offering->apply_requirements_intern_position_batches !!}
                            </div>
                        </div>

                        {{-- Benefits --}}
                        @if (!empty($offering->benefits_intern_position_batches))
                            <div class="mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-success text-white mr-3"
                                        style="width: 50px; height: 50px; line-height: 50px; border-radius: 50%; font-size: 24px;">
                                        <i class="fas fa-gift"></i>
                                    </div>
                                    <h5 class="text-dark font-weight-bold mb-0">Benefits</h5>
                                </div>
                                <div class="p-3 rounded border bg-light shadow-sm">
                                    {!! $offering->benefits_intern_position_batches !!}
                                </div>
                            </div>
                        @endif
                        {{-- Selection Steps --}}
                        @if ($offering->selectionSteps->count())
                            <div class="mt-5">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary text-white mr-3"
                                        style="width: 50px; height: 50px; line-height: 50px; border-radius: 50%; font-size: 24px;">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <h5 class="text-dark font-weight-bold mb-0">Selection Steps Timeline</h5>
                                </div>

                                <div class="timeline-container position-relative ml-4 pl-3 border-left">
                                    @foreach ($offering->selectionSteps->sortBy('step_order_intern_selection_steps') as $step)
                                        <div class="timeline-item mb-5 position-relative">
                                            <div class="timeline-dot bg-primary position-absolute"
                                                style="left: -13px; top: 0; width: 14px; height: 14px; border-radius: 50%;">
                                            </div>

                                            <div class="ml-4">
                                                <h6 class="font-weight-bold">
                                                    Step {{ $step->step_order_intern_selection_steps }}:
                                                </h6>

                                                @if ($step->is_mondatory_intern_selection_steps)
                                                    <span class="badge badge-warning">Mandatory</span>
                                                @endif

                                                @if ($step->is_invitation_only_intern_selection_steps)
                                                    <span class="badge badge-info">Invitation Only</span>
                                                @endif

                                                <p class="mt-2 text-muted" style="text-align: justify;">
                                                    {!! $step->description_intern_selection_steps !!}
                                                </p>

                                                <small class="text-muted">
                                                    Estimated:
                                                    {{ \Carbon\Carbon::parse($step->estimated_start_date_intern_selection_steps)->translatedFormat('l, d F Y') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($step->estimated_end_date_intern_selection_steps)->translatedFormat('l, d F Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="mt-5 text-center text-muted p-4 bg-white rounded shadow-sm border">
                                <i class="fas fa-folder-open fa-3x text-primary mb-3"></i>
                                <h6>No Selection Steps Found</h6>
                                <p class="mb-0">It looks like this internship offering doesn't have any selection steps
                                    configured. Please check back later or contact the admin.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('internship-offering.index') }}" class="btn btn-outline-secondary">
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

        .location-card {
            background-color: #f9fafb;
            border-radius: 0.5rem;
            transition: box-shadow 0.3s ease;
        }

        .location-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .location-card i.fa-phone-alt {
            font-size: 0.9rem;
        }

        .timeline-container {
            border-left: 2px solid #007bff;
            padding-left: 15px;
            position: relative;
        }

        .timeline-dot {
            width: 14px;
            height: 14px;
            background-color: #007bff;
            border-radius: 50%;
            position: absolute;
            left: -7px;
            top: 0;
        }

        .timeline-item {
            position: relative;
            padding-left: 20px;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -1px;
            top: 14px;
            height: 100%;
            width: 2px;
            background-color: #007bff;
        }

        .timeline-item:last-child::before {
            height: 0;
        }
    </style>
@endpush
