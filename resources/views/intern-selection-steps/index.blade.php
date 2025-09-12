@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Intern Selection Steps</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-position.index') }}">Intern Position Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.selection-steps.index', $internPositionBatch->id) }}"
                            class="{{ request()->routeIs('internship-offering.selection-steps.index', $internPositionBatch->id) ? 'active' : '' }}">
                            Selection Steps
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <h5 class="font-weight-bold text-dark">Intern Position Details</h5>
                    <table class="table table-borderless table-sm w-50">
                        <tr>
                            <th class="text-muted" style="width: 150px;">Position</th>
                            <td>{{ $internPositionBatch->internPosition->name_intern_positions ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Batch</th>
                            <td>{{ $internPositionBatch->internBatch->name_intern_batches ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Location</th>
                            <td>{{ $internPositionBatch->internLocation->intern_location_name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>


                @can('internship-offering.selection-steps.create')
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('internship-offering.selection-steps.create', $internPositionBatch->id) }}"
                            class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Selection Step
                        </a>
                    </div>
                @endcan

                <div class="table-responsive">
                    <table class="table table-bordered" id="SelectionStepsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Selection Step</th>
                                <th>Selection Status</th>
                                <th>Selection Mondatory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate this -->
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('internship-offering.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
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
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#SelectionStepsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('internship-offering.selection-steps.list', $internPositionBatch->id) }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name_selection_steps',
                        name: 'name_selection_steps'
                    },
                    {
                        data: 'status_intern_selection_steps',
                        name: 'status_intern_selection_steps',
                        render: function(data) {
                            if (data === 'active') {
                                return `<span class="badge badge-success">${data}</span>`;
                            } else if (data === 'inactive') {
                                return `<span class="badge badge-danger">${data}</span>`;
                            } else {
                                return `<span class="badge badge-secondary">${data}</span>`;
                            }
                        }
                    },
                    {
                        data: 'is_mondatory_intern_selection_steps',
                        name: 'is_mondatory_intern_selection_steps',
                        render: function(data) {
                            if (data === 1) {
                                return `<span class="badge badge-success">Yes</span>`;
                            } else {
                                return `<span class="badge badge-danger">No</span>`;
                            }
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            // Ubah URL sesuai dengan routing kamu
                            let editUrl =
                                `/master-management/internship-offering/intern-selection-steps/${data}/edit`;
                            let showUrl =
                                `/master-management/internship-offering/intern-selection-steps/${data}/show`;
                            let deleteUrl =
                                `/master-management/internship-offering/intern-selection-steps/${data}`;

                            let buttons = '';

                            @can('internship-offering.selection-steps.edit')
                                buttons += `
                                <a href="${editUrl}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>`;
                            @endcan

                            @can('internship-offering.selection-steps.show')
                                buttons += `
                                <a href="${showUrl}" class="btn btn-sm btn-info" title="Show">
                                    <i class="bi bi-eye"></i>
                                </a>`;
                            @endcan

                            @can('internship-offering.selection-steps.destroy')
                                buttons += `
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete('${deleteUrl}')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>`;
                            @endcan

                            return buttons;
                        }
                    }
                ]
            });
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif
        });

        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success');
                            $('#SelectionStepsTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to delete data.', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush
