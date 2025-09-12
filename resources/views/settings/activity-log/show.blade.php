@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Activity Log Detail</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('log-activity.index') }}"
                            class="{{ request()->routeIs('log-activity.index') ? 'active' : '' }}">Activity Logs</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-user"></i> User:</label>
                        <div>{{ $activityLog->user->name ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-bolt"></i> Activity:</label>
                        <span class="badge bg-info text-white">{{ $activityLog->activity }}</span>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-layer-group"></i> Subject Type:</label>
                        <div>{{ $activityLog->subject_type }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-align-left"></i> Description:</label>
                        <div>{{ $activityLog->description }}</div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-calendar-alt"></i> Date:</label>
                        <div>{{ $activityLog->date }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-clock"></i> Time:</label>
                        <div>{{ $activityLog->time }}</div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-link"></i> URL:</label>
                        <div><a href="{{ $activityLog->url }}" target="_blank">{{ $activityLog->url }}</a></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-network-wired"></i> IP Address:</label>
                        <span class="badge bg-secondary text-white">{{ $activityLog->ip_address }}</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="fas fa-desktop"></i> User Agent:</label>
                    <div class="text-muted small">{{ $activityLog->user_agent }}</div>
                </div>

                @if ($activityLog->data)
                    <div class="mb-3">
                        <label class="form-label fw-bold"><i class="fas fa-database me-2"></i> Data:</label>
                        <pre class="bg-light p-3 rounded" style="white-space: pre-wrap; word-wrap: break-word;">
{{ $activityLog->data }}
        </pre>
                    </div>
                @endif


                <a href="{{ route('log-activity.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
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

        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 0.85rem;
        }

        .badge {
            font-size: 0.85rem;
        }
    </style>
@endpush
