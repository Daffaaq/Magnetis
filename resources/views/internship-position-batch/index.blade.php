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
                </ol>
            </div>
            <div class="card-body">
                @can('internship-offering.create')
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('internship-offering.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Create New Offering
                        </a>
                    </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered" id="InternshipOfferingTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Position</th>
                                <th>Batch</th>
                                <th>Quota</th>
                                <th>Status</th>
                                <th>Open Date</th>
                                <th>Close Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables akan load data di sini -->
                        </tbody>
                    </table>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            var dataTable = $('#InternshipOfferingTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('internship-offering.list') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'position',
                        name: 'intern_positions.name_intern_positions'
                    },
                    {
                        data: 'batch',
                        name: 'intern_batches.name_intern_batches'
                    },
                    {
                        data: 'quota',
                        name: 'intern_position_batches.quota_intern_position_batches'
                    },
                    {
                        data: 'status',
                        name: 'intern_position_batches.status_intern_position_batches',
                        render: function(data) {
                            if (data === 'active') {
                                return `<span class="badge badge-success">${data}</span>`;
                            } else if (data === 'inactive') {
                                return `<span class="badge badge-danger">${data}</span>`;
                            } else {
                                return `<span class="badge badge-light">${data}</span>`;
                            }
                        }
                    },
                    {
                        data: 'start_date',
                        name: 'intern_position_batches.start_date_intern_position_batches'
                    },
                    {
                        data: 'end_date',
                        name: 'intern_position_batches.end_date_intern_position_batches'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let showUrl = `/master-management/internship-offering/${data}`;
                            let editUrl = `/master-management/internship-offering/${data}/edit`;
                            let stepUrl =
                                `/master-management/internship-offering/intern-selection-steps/${data}`;

                            let buttons = '';

                            @can('internship-offering.show')
                                buttons += `
                                    <a href="${showUrl}" class="btn icon btn-sm btn-info" title="Show">
                                        <i class="bi bi-eye"></i>
                                    </a>`;
                            @endcan

                            @can('internship-offering.edit')
                                buttons += `
                                    <a href="${editUrl}" class="btn icon btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>`;
                            @endcan

                            @can('internship-offering.selection-steps.index') // Pastikan permission ini sesuai
                                buttons += `
                                    <a href="${stepUrl}" class="btn icon btn-sm btn-primary" title="Step Seleksi">
                                        <i class="bi bi-list-check"></i>
                                    </a>`;
                            @endcan

                            @can('internship-offering.destroy')
                                buttons += `
                                    <button class="btn icon btn-sm btn-danger" title="Delete" onclick="confirmDelete('${data}')">
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

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = `/master-management/internship-offering/${id}`;
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                                $('#InternshipOfferingTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message || 'Terjadi kesalahan.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat menghubungi server.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
