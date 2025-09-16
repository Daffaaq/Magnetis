@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Mentor Batch Assignments</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.index') }}">Mentor Management</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Assigned Batches
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold text-dark mb-0">Mentor Details</h5>
                        <button class="btn btn-link p-0 text-decoration-none text-primary" id="toggleMentorDetails"
                            title="Show/Hide Mentor Details">
                            <i class="bi bi-eye-slash" id="mentorDetailsIcon"></i>
                        </button>
                    </div>
                    <div id="mentorDetailsContent">
                        <table class="table table-borderless table-sm w-50 mt-2">
                            <tr>
                                <th class="text-muted" style="width: 150px;">Name</th>
                                <td class="mentor-data blurred">{{ $mentors->name_intern_mentors ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Email</th>
                                <td class="mentor-data blurred">{{ $mentors->email_intern_mentors ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Phone</th>
                                <td class="mentor-data blurred">{{ $mentors->phone_intern_mentors ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="d-flex justify-content-end mb-3">
                    @can('mentor.batch.assignment.create')
                        <a href="{{ route('mentor.batch.assignment.create', $mentors->id) }}"
                            class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Assign New Batch
                        </a>
                    @endcan
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="MentorBatchAssignmentTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi Intern </th>
                                <th>Assigned Batch</th>
                                <th>Assignment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate this -->
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('mentor.index') }}" class="btn btn-secondary">
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

        .breadcrumb-item.active {
            font-weight: bold;
            color: #007bff;
        }

        .blurred {
            filter: blur(6px);
            transition: filter 0.3s ease;
        }

        .blurred-unlocked {
            filter: none;
            pointer-events: auto;
            user-select: auto;
        }

        .btn.icon {
            margin-right: 0.25rem;
        }

        .btn.icon:last-child {
            margin-right: 0;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#toggleMentorDetails').on('click', function() {
                const dataFields = $('.mentor-data');
                const icon = $('#mentorDetailsIcon');

                dataFields.toggleClass('blurred');

                if (dataFields.first().hasClass('blurred')) {
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#MentorBatchAssignmentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('mentor.batch.assignment.list', $mentors->id) }}",
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
                        data: 'intern_location_name',
                        name: 'intern_location_name'
                    },
                    {
                        data: 'intern_position_batch',
                        name: 'intern_position_batch'
                    },
                    {
                        data: 'status_mentor_batch_assignments',
                        name: 'status_mentor_batch_assignments',
                        render: function(data) {
                            if (data === 'active') {
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
                            let editUrl =
                                `/user-management/mentor/{{ $mentors->id }}/assign-batch/${data}/edit`;
                            let showUrl = `/user-management/mentor/assign-batch/${data}/show`;
                            let deleteUrl = `/user-management/mentor/{{ $mentors->id }}/assign-batch/${data}`;
                            let buttons = '';

                            @can('mentor.batch.assignment.edit')
                                buttons += `<a href="${editUrl}" class="btn icon btn-sm btn-warning" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>`;
                            @endcan

                            @can('mentor.batch.assignment.show')
                                buttons += `<a href="${showUrl}" class="btn icon btn-sm btn-info" title="Show">
                        <i class="bi bi-eye"></i>
                    </a>`;
                            @endcan

                            @can('mentor.batch.assignment.destroy')
                                buttons += `<button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${deleteUrl}')" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>`;
                            @endcan

                            return buttons;
                        }

                    }
                ],
                autoWidth: false,
                drawCallback: function(settings) {
                    $('a').tooltip();
                }
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
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
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
                                $('#MentorBatchAssignmentTable').DataTable().ajax.reload();
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
