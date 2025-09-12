@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Intern Selection Step Details</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.selection-steps.index', $internSelectionStep->internPositionBatch->id) }}"
                            class="{{ request()->routeIs('internship-offering.selection-steps.index', $internSelectionStep->internPositionBatch->id) ? 'active' : '' }}">
                            Selection Steps
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Show Selection Step</li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="icon-circle bg-primary text-white mb-2"
                            style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; font-size: 30px;">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <strong class="text-primary">Selection Step Info</strong>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-dark font-weight-bold mb-2">Step Name</h5>
                        <p class="text-muted">{{ $internSelectionStep->selectionStep->name_selection_steps ?? '-' }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Batch Position</h5>
                        <p class="text-muted">
                            {{ $internSelectionStep->internPositionBatch->internPosition->name_intern_positions ?? '-' }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Status</h5>
                        <p>
                            @php
                                $status = $internSelectionStep->status_intern_selection_steps;
                            @endphp
                            @if ($status === 'active')
                                <span class="badge badge-success text-capitalize">{{ $status }}</span>
                            @elseif($status === 'inactive')
                                <span class="badge badge-danger text-capitalize">{{ $status }}</span>
                            @else
                                <span class="badge badge-light text-capitalize">{{ $status }}</span>
                            @endif
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Is Mandatory</h5>
                        <p>{{ $internSelectionStep->is_mondatory_intern_selection_steps ? 'Yes' : 'No' }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Is Invitation Only</h5>
                        <p>{{ $internSelectionStep->is_invitation_only_intern_selection_steps ? 'Yes' : 'No' }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Step Order</h5>
                        <p>{{ $internSelectionStep->step_order_intern_selection_steps }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Estimated Start Date</h5>
                        <p>{{ \Carbon\Carbon::parse($internSelectionStep->estimated_start_date_intern_selection_steps)->format('d M Y') }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Estimated End Date</h5>
                        <p>{{ \Carbon\Carbon::parse($internSelectionStep->estimated_end_date_intern_selection_steps)->format('d M Y') }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Description</h5>
                        <div class="p-3 rounded border bg-light shadow-sm">
                            {!! $internSelectionStep->description_intern_selection_steps !!}
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('internship-offering.selection-steps.index', ['id' => $internSelectionStep->intern_position_batch_id]) }}"
                        class="btn btn-outline-secondary">
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
