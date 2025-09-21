@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Mentor Empty Schedule Slots</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.index') }}">Mentor Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.batch.assignment.index', $mentor->id) }}">Assigned Batches</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{ route('mentor.batch.assignment.slot-empty.index', [$mentor->id, $assignment->id]) }}"
                            class="{{ request()->routeIs('mentor.batch.assignment.slot-empty.index') ? 'active' : '' }}">
                            Schedule Slots Management
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold text-dark mb-0">Mentor Info</h5>
                        <button class="btn btn-link p-0 text-decoration-none text-primary" id="toggleMentorDetails"
                            title="Show/Hide Mentor Details">
                            <i class="bi bi-eye-slash" id="mentorDetailsIcon"></i>
                        </button>
                    </div>
                    <div id="mentorDetailsContent">
                        <table class="table table-sm table-borderless w-50 mt-2">
                            <tr>
                                <th>Name</th>
                                <td class="mentor-data blurred">{{ $mentor->name_intern_mentors ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td class="mentor-data blurred">{{ $mentor->email_intern_mentors ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td class="mentor-data blurred">{{ $mentor->phone_intern_mentors ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td class="mentor-data blurred">{{ $mentor->department->name_departments ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="font-weight-bold text-dark mb-2">Assigned Batch Info</h5>
                    <table class="table table-sm table-borderless w-50">
                        <tr>
                            <th>Position</th>
                            <td class="mentor-data blurred">
                                {{ $assignment->internPositionBatch->internPosition->name_intern_positions ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td class="mentor-data blurred">
                                {{ $assignment->internPositionBatch->internPosition->department->name_departments ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td class="mentor-data blurred">
                                {{ $assignment->internPositionBatch->internBatch->name_intern_batches ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="mentor-data blurred">
                                @if ($assignment->status_mentor_batch_assignments === 'active')
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span
                                        class="badge badge-secondary">{{ ucfirst($assignment->status_mentor_batch_assignments) }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('mentor.batch.assignment.slot-empty.create', [$mentor->id, $assignment->id]) }}"
                        class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Slot
                    </a>
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered" id="MentorScheduleSlotTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Selection Step</th>
                                <th>Tanggal Kosong</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>status Schedule Slot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('mentor.batch.assignment.index', $mentor->id) }}" class="btn btn-secondary">
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

        .blurred {
            filter: blur(6px);
            transition: filter 0.3s ease;
        }

        .blurred-unlocked {
            filter: none;
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
            // Toggle blur on mentor details
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
            $('#MentorScheduleSlotTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('mentor.batch.assignment.slot-empty.list', [$mentor->id, $assignment->id]) }}",
                    type: 'POST',
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
                        name: 'intern_selection_steps.name_selection_steps'
                    },
                    {
                        data: 'date_mentor_schedule_slots',
                        name: 'mentor_schedule_slots.date_mentor_schedule_slots'
                    },
                    {
                        data: 'start_time_mentor_schedule_slots',
                        name: 'mentor_schedule_slots.start_time_mentor_schedule_slots'
                    },
                    {
                        data: 'end_time_mentor_schedule_slots',
                        name: 'mentor_schedule_slots.end_time_mentor_schedule_slots'
                    },
                    {
                        data: 'is_booked_mentor_schedule_slots',
                        name: 'mentor_schedule_slots.is_booked_mentor_schedule_slots',
                        render: function(data) {
                            if (data === 1) {
                                return `<span class="badge badge-success">Booked</span>`;
                            } else {
                                return `<span class="badge badge-secondary">Available</span>`;
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
                                `/user-management/mentor/{{ $mentor->id }}/assign-batch/{{ $assignment->id }}/add-slot-empty/${data}/edit`;
                            let showUrl = `/user-management/mentor/assign-batch/${data}/show`;
                            let deleteUrl =
                                `/user-management/mentor/{{ $mentor->id }}/assign-batch/{{ $assignment->id }}/add-slot-empty/${data}`;
                            let buttons = '';

                            @can('mentor.batch.assignment.edit')
                                buttons += `<a href="${editUrl}" class="btn icon btn-sm btn-warning" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>`;
                            @endcan

                            buttons += `<a href="${showUrl}" class="btn icon btn-sm btn-info" title="Show">
                        <i class="bi bi-eye"></i>
                    </a>`;

                            @can('mentor.batch.assignment.destroy')
                                buttons += `<button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${deleteUrl}')" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>`;
                            @endcan

                            return buttons;
                        }
                    },
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
                                $('#MentorScheduleSlotTable').DataTable().ajax.reload();
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
