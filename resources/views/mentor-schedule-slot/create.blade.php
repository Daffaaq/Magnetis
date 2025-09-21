@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Create Mentor Schedule Slot</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.batch.assignment.slot-empty.index', [$mentor->id, $assignment->id]) }}"
                            class="active">Schedule Slots</a>
                    </li>
                    <li class="breadcrumb-item active">Create Slot</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ route('mentor.batch.assignment.slot-empty.store', [$mentor->id, $assignment->id]) }}">
                    @csrf

                    <!-- Selection Step -->
                    <div class="form-group">
                        <label for="intern_selection_step_id">Selection Step:</label>
                        <select name="intern_selection_step_id" id="intern_selection_step_id"
                            class="form-control @error('intern_selection_step_id') is-invalid @enderror">
                            <option value="">-- Select Step --</option>
                            {{-- Option akan diisi lewat JavaScript --}}
                        </select>
                        @error('intern_selection_step_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="form-group">
                        <label for="date_mentor_schedule_slots">Date:</label>
                        <input type="date" name="date_mentor_schedule_slots" id="date_mentor_schedule_slots"
                            class="form-control @error('date_mentor_schedule_slots') is-invalid @enderror"
                            value="{{ old('date_mentor_schedule_slots') }}">
                        @error('date_mentor_schedule_slots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Start Time -->
                    <div class="form-group">
                        <label for="start_time_mentor_schedule_slots">Start Time:</label>
                        <input type="time" name="start_time_mentor_schedule_slots" id="start_time_mentor_schedule_slots"
                            class="form-control @error('start_time_mentor_schedule_slots') is-invalid @enderror"
                            value="{{ old('start_time_mentor_schedule_slots') }}">
                        @error('start_time_mentor_schedule_slots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="form-group">
                        <label for="end_time_mentor_schedule_slots">End Time:</label>
                        <input type="time" name="end_time_mentor_schedule_slots" id="end_time_mentor_schedule_slots"
                            class="form-control @error('end_time_mentor_schedule_slots') is-invalid @enderror"
                            value="{{ old('end_time_mentor_schedule_slots') }}">
                        @error('end_time_mentor_schedule_slots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Location (optional) -->
                    <div class="form-group">
                        <label for="location_mentor_schedule_slots">Location (optional):</label>
                        <input type="text" name="location_mentor_schedule_slots" id="location_mentor_schedule_slots"
                            class="form-control @error('location_mentor_schedule_slots') is-invalid @enderror"
                            value="{{ old('location_mentor_schedule_slots') }}">
                        @error('location_mentor_schedule_slots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Meeting Link (optional) -->
                    <div class="form-group">
                        <label for="meeting_link_mentor_schedule_slots">Meeting Link (optional):</label>
                        <input type="url" name="meeting_link_mentor_schedule_slots"
                            id="meeting_link_mentor_schedule_slots"
                            class="form-control @error('meeting_link_mentor_schedule_slots') is-invalid @enderror"
                            value="{{ old('meeting_link_mentor_schedule_slots') }}">
                        @error('meeting_link_mentor_schedule_slots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Is Booked (checkbox) -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="is_booked_mentor_schedule_slots"
                            name="is_booked_mentor_schedule_slots" value="1"
                            {{ old('is_booked_mentor_schedule_slots') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_booked_mentor_schedule_slots">Mark as Booked</label>
                    </div>

                    <!-- Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary"
                                href="{{ route('mentor.batch.assignment.slot-empty.index', [$mentor->id, $assignment->id]) }}">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const assignmentId = @json($assignment->id);
            const dropdown = document.getElementById('intern_selection_step_id');

            fetch(`/user-management/mentor/assignment/${assignmentId}/steps`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(step => {
                        const option = document.createElement('option');
                        option.value = step.id;
                        option.text = step.selection_step?.name_selection_steps || `Step ${step.id}`;
                        dropdown.appendChild(option);
                    });
                })
                .catch(err => {
                    console.error('Error fetching selection steps:', err);
                });
        });
    </script>
@endpush
