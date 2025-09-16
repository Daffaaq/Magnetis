@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Mentor Batch Assignment Details</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.batch.assignment.index', $mentorBatchAssignment->intern_mentor_id) }}"
                            class="{{ request()->routeIs('mentor.batch.assignment.index') ? 'active' : '' }}">
                            Mentor Batch Assignments
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Show Assignment</li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="icon-circle bg-primary text-white mb-2"
                            style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; font-size: 30px;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <strong class="text-primary">Mentor Info</strong>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-dark font-weight-bold mb-2">Mentor Name</h5>
                        <p class="text-muted">{{ $mentorBatchAssignment->internMentor->name_intern_mentors ?? '-' }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Mentor Department</h5>
                        <p class="text-muted">
                            {{ $mentorBatchAssignment->internMentor->department->name_departments ?? '-' }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Batch Position</h5>
                        <p class="text-muted">
                            {{ $mentorBatchAssignment->internPositionBatch->internPosition->name_intern_positions ?? '-' }}
                            -
                            {{ $mentorBatchAssignment->internPositionBatch->internPosition->department->name_departments ?? '-' }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Batch</h5>
                        <p class="text-muted">
                            {{ $mentorBatchAssignment->internPositionBatch->internBatch->name_intern_batches ?? '-' }} -
                            {{ $mentorBatchAssignment->internPositionBatch->internLocation->intern_location_name ?? '-' }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Status</h5>
                        @php
                            $status = $mentorBatchAssignment->status_mentor_batch_assignments;
                        @endphp
                        <p>
                            @if ($status === 'active')
                                <span class="badge badge-success text-capitalize">{{ $status }}</span>
                            @elseif($status === 'inactive')
                                <span class="badge badge-danger text-capitalize">{{ $status }}</span>
                            @elseif($status === 'resigned')
                                <span class="badge badge-warning text-capitalize">{{ $status }}</span>
                            @elseif($status === 'on_leave')
                                <span class="badge badge-info text-capitalize">{{ str_replace('_', ' ', $status) }}</span>
                            @else
                                <span class="badge badge-light text-capitalize">{{ $status }}</span>
                            @endif
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Note</h5>
                        <p>{!! $mentorBatchAssignment->note_mentor_batch_assignments ?? '-' !!}</p>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('mentor.batch.assignment.index', $mentorBatchAssignment->intern_mentor_id) }}"
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
