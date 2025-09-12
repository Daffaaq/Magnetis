@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Internship Batch Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-batch.index') }}"
                            class="{{ request()->routeIs('internship-batch.index') ? 'active' : '' }}">
                            Internship Batch Management
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                @can('internship-batch.create')
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('internship-batch.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Create New Batch
                        </a>
                    </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered" id="InternshipBatchTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Batch Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status Batch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will load this -->
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
            var dataTable = $('#InternshipBatchTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('internship-batch.list') }}',
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
                        data: 'name_intern_batches',
                        name: 'name_intern_batches'
                    },
                    {
                        data: 'start_date_intern_batches',
                        name: 'start_date_intern_batches'
                    },
                    {
                        data: 'end_date_intern_batches',
                        name: 'end_date_intern_batches'
                    },
                    {
                        data: 'status_intern_batches',
                        name: 'status_intern_batches',
                        render: function(data) {
                            //badge
                            if (data == 'upcoming') {
                                return `<span class="badge badge-warning">${data}</span>`;
                            } else if (data == 'ongoing') {
                                return `<span class="badge badge-info">${data}</span>`;
                            } else if (data == 'completed') {
                                return `<span class="badge badge-success">${data}</span>`;
                            } else {
                                return `<span class="badge badge-danger">${data}</span>`;
                            }
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let showUrl = `/master-management/internship-batch/${data}`;
                            let editUrl = `/master-management/internship-batch/${data}/edit`;

                            let buttons = '';

                            @can('internship-batch.show')
                                buttons += `
                                    <a href="${showUrl}" class="btn icon btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>`;
                            @endcan

                            @can('internship-batch.edit')
                                buttons += `
                                    <a href="${editUrl}" class="btn icon btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>`;
                            @endcan

                            @can('internship-batch.destroy')
                                buttons += `
                                    <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')">
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
                    const url = `/master-management/internship-batch/${id}`;
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
                                $('#InternshipBatchTable').DataTable().ajax.reload();
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
