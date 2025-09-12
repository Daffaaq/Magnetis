@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Recruitment Step Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('recruitment-step.index') }}"
                            class="{{ request()->routeIs('recruitment-step.index') ? 'active' : '' }}">
                            Recruitment Step Management
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                @can('recruitment-step.create')
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('recruitment-step.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Create New Step
                        </a>
                    </div>
                @endcan
                <div class="table-responsive">
                    <table class="table table-bordered" id="RecruitmentStepTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Step Name</th>
                                <th>Status</th>
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
            var dataTable = $('#RecruitmentStepTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('recruitment-step.list') }}',
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
                        data: 'name_selection_steps',
                        name: 'name_selection_steps'
                    },
                    {
                        data: 'status_selection_steps',
                        name: 'status_selection_steps',
                        render: function(data) {
                            if (data == 'active') {
                                return `<span class="badge badge-success">${data}</span>`;
                            } else {
                                return `<span class="badge badge-secondary">${data}</span>`;
                            }
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let showUrl = `/master-management/recruitment-step/${data}`;
                            let editUrl = `/master-management/recruitment-step/${data}/edit`;

                            let buttons = '';

                            @can('recruitment-step.show')
                                buttons += `
                                    <a href="${showUrl}" class="btn icon btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>`;
                            @endcan

                            @can('recruitment-step.edit')
                                buttons += `
                                    <a href="${editUrl}" class="btn icon btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>`;
                            @endcan

                            @can('recruitment-step.destroy')
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
                    const url = `/master-management/recruitment-step/${id}`;
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
                                $('#RecruitmentStepTable').DataTable().ajax.reload();
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
