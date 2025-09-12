@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Department Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('department.index') }}"
                            class="{{ request()->routeIs('department.index') ? 'active' : '' }}">Department Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('department.show', $department) }}"
                            class="{{ request()->routeIs('department.show', $department) ? 'active' : '' }}">Show
                            Department</a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="icon-circle bg-primary text-white mb-2"
                            style="width: 70px; height: 70px; line-height: 70px; border-radius: 50%; font-size: 30px;">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <strong class="text-primary">Department Info</strong>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-dark font-weight-bold mb-2">Department Name</h5>
                        <p class="text-muted">{{ $department->name_departments }}</p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Status Department</h5>
                        <p>
                            @if ($department->status_departments === 'active')
                                <span
                                    class="badge badge-success text-capitalize">{{ $department->status_departments }}</span>
                            @elseif($department->status_departments === 'inactive')
                                <span
                                    class="badge badge-danger text-capitalize">{{ $department->status_departments }}</span>
                            @else
                                <span class="badge badge-light text-capitalize">{{ $department->status_departments }}</span>
                            @endif
                        </p>

                        <h5 class="text-dark font-weight-bold mt-4 mb-2">Description</h5>
                        <div class="p-3 rounded border bg-light shadow-sm">
                            {!! $department->description_departments !!}
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="{{ route('department.index') }}" class="btn btn-outline-secondary">
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
