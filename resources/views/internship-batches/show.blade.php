@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Internship Batch Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-batch.index') }}"
                            class="{{ request()->routeIs('internship-batch.index') ? 'active' : '' }}">Internship Batch
                            Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-batch.show', $internBatch) }}"
                            class="{{ request()->routeIs('internship-batch.show', $internBatch) ? 'active' : '' }}">
                            Show Internship Batch
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="icon-circle bg-primary text-white mb-2"
                            style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; font-size: 30px;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <strong class="text-primary">Batch Info</strong>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-dark font-weight-bold mb-2">Batch Name</h5>
                        <p class="text-muted">{{ $internBatch->name_intern_batches }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Start Date</h5>
                        <p class="text-muted">
                            {{ \Carbon\Carbon::parse($internBatch->start_date_intern_batches)->translatedFormat('d F Y') }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">End Date</h5>
                        <p class="text-muted">
                            {{ \Carbon\Carbon::parse($internBatch->end_date_intern_batches)->translatedFormat('d F Y') }}
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Status</h5>
                        <p class="text-muted text-capitalize">{{ $internBatch->status_intern_batches }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Description</h5>
                        <div class="p-3 rounded border bg-light shadow-sm">
                            {!! $internBatch->description_intern_batches !!}
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('internship-batch.index') }}" class="btn btn-outline-secondary">
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
