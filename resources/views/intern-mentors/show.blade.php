@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Intern Mentor Details</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.index') }}"
                            class="{{ request()->routeIs('mentor.index') ? 'active' : '' }}">
                            Intern Mentor Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.show', $internMentor->id) }}"
                            class="{{ request()->routeIs('mentor.show', $internMentor->id) ? 'active' : '' }}">
                            Show Mentor
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Side: Avatar & Basic Info -->
                    <div class="col-lg-4 col-md-5 text-center border-right mb-4 mb-md-0">
                        @if ($internMentor->profile_picture_intern_mentors)
                            <img src="{{ asset('storage/' . $internMentor->profile_picture_intern_mentors) }}"
                                alt="Profile Picture" class="rounded-circle shadow"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                style="width: 150px; height: 150px; font-size: 60px; margin: 0 auto;">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif

                        <h5 class="font-weight-bold text-dark mt-3">{{ $internMentor->name_intern_mentors }}</h5>
                        <p class="text-primary font-weight-semibold mb-1">
                            <i class="fas fa-briefcase mr-1"></i> {{ $internMentor->position_title_intern_mentors ?: '-' }}
                        </p>

                        <span
                            class="badge {{ $internMentor->status_intern_mentors === 'active' ? 'badge-success' : ($internMentor->status_intern_mentors === 'inactive' ? 'badge-danger' : 'badge-secondary') }}">
                            {{ ucfirst($internMentor->status_intern_mentors) }}
                        </span>
                    </div>

                    <!-- Right Side: Detail Info -->
                    <div class="col-lg-8 col-md-7 detail-card p-4 shadow-sm rounded">
                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-4 font-weight-bold text-muted d-flex align-items-center">
                                <i class="fas fa-envelope mr-2 text-primary"></i> Email
                            </div>
                            <div class="col-sm-8" style="color: #000000;">{{ $internMentor->email_intern_mentors }}</div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-4 font-weight-bold text-muted d-flex align-items-center">
                                <i class="fas fa-phone mr-2 text-success"></i> Phone
                            </div>
                            <div class="col-sm-8" style="color: #000000;">{{ $internMentor->phone_intern_mentors }}</div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-4 font-weight-bold text-muted d-flex align-items-center">
                                <i class="fas fa-building mr-2 text-info"></i> Department
                            </div>
                            <div class="col-sm-8" style="color: #000000;">
                                {{ $internMentor->department->name_departments ?? '-' }}</div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-4 font-weight-bold text-muted d-flex align-items-center">
                                <i class="fas fa-user mr-2 text-warning"></i> User Account
                            </div>
                            <div class="col-sm-8" style="color: #000000;">
                                {{ $internMentor->user->name ?? '-' }}
                                @if ($internMentor->user)
                                    ({{ $internMentor->user->email }})
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-sm-4 font-weight-bold text-muted d-flex align-items-center">
                                <i class="fas fa-address-card mr-2 text-secondary"></i> Bio
                            </div>
                            <div class="col-sm-8" style="font-style: italic; color: #000000;">
                                {!! $internMentor->bio_intern_mentors ?: '-' !!}
                            </div>
                        </div>

                    </div>

                </div>

                <div class="text-right mt-4">
                    <a href="{{ route('mentor.index') }}" class="btn btn-outline-secondary">
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

        .border-right {
            border-right: 3px solid #ffd700 !important;
            /* garis tebal 4px dan warna biru */
        }

        .detail-card {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 16px;
            padding: 2rem;
            transition: box-shadow 0.3s ease;
            border: 1px solid #d0d7ff;
            /* Hapus opacity dan transform supaya langsung muncul tanpa animasi */
            opacity: 1;
            transform: none;
        }

        .detail-card:hover {
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        }

        .detail-card .font-weight-bold {
            font-weight: 600;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        .detail-card .text-muted {
            color: #6c757d !important;
        }

        /* Hapus keyframes karena gak dipakai */
    </style>
@endpush
