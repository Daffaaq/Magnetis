@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Intern Selection Step</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.selection-steps.index', ['id' => $internSelectionStep->internPositionBatch->id]) }}"
                            class="{{ request()->routeIs('internship-offering.selection-steps.index', ['id' => $internSelectionStep->internPositionBatch->id]) ? 'active' : '' }}">
                            Internship Selection Steps Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.selection-steps.edit', $internSelectionStep->id) }}"
                            class="{{ request()->routeIs('internship-offering.selection-steps.edit', $internSelectionStep->id) ? 'active' : '' }}">
                            Internship Edit Selection Steps
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <strong>Perhatian:</strong>
                    Tanggal estimasi mulai dan akhir pada selection step harus berada di antara
                    <strong>{{ \Carbon\Carbon::parse($internSelectionStep->internPositionBatch->start_date_intern_position_batches)->format('d M Y') }}</strong>
                    sampai
                    <strong>{{ \Carbon\Carbon::parse($internSelectionStep->internPositionBatch->end_date_intern_position_batches)->format('d M Y') }}</strong>.
                </div>

                <form method="POST"
                    action="{{ route('internship-offering.selection-steps.update', $internSelectionStep->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Selection Step -->
                    <div class="form-group">
                        <label for="selection_step_id">Selection Step:</label>
                        <select name="selection_step_id" id="selection_step_id"
                            class="form-control @error('selection_step_id') is-invalid @enderror">
                            <option value="">-- Select Selection Step --</option>
                            @foreach ($selectionStep as $step)
                                <option value="{{ $step->id }}"
                                    {{ old('selection_step_id', $internSelectionStep->selection_step_id) == $step->id ? 'selected' : '' }}>
                                    {{ $step->name_selection_steps }}
                                </option>
                            @endforeach
                        </select>
                        @error('selection_step_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Step Order -->
                    <div class="form-group">
                        <label for="step_order_intern_selection_steps">Step Order:</label>
                        <input type="number" name="step_order_intern_selection_steps"
                            id="step_order_intern_selection_steps"
                            value="{{ old('step_order_intern_selection_steps', $internSelectionStep->step_order_intern_selection_steps) }}"
                            class="form-control @error('step_order_intern_selection_steps') is-invalid @enderror"
                            min="1">
                        @error('step_order_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mandatory -->
                    <div class="form-group">
                        <label for="is_mondatory_intern_selection_steps">Is Mandatory:</label>
                        <select name="is_mondatory_intern_selection_steps" id="is_mondatory_intern_selection_steps"
                            class="form-control @error('is_mondatory_intern_selection_steps') is-invalid @enderror">
                            <option value="1"
                                {{ old('is_mondatory_intern_selection_steps', $internSelectionStep->is_mondatory_intern_selection_steps) == '1' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="0"
                                {{ old('is_mondatory_intern_selection_steps', $internSelectionStep->is_mondatory_intern_selection_steps) == '0' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                        @error('is_mondatory_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Invitation Only -->
                    <div class="form-group">
                        <label for="is_invitation_only_intern_selection_steps">Is Invitation Only:</label>
                        <select name="is_invitation_only_intern_selection_steps"
                            id="is_invitation_only_intern_selection_steps"
                            class="form-control @error('is_invitation_only_intern_selection_steps') is-invalid @enderror">
                            <option value="1"
                                {{ old('is_invitation_only_intern_selection_steps', $internSelectionStep->is_invitation_only_intern_selection_steps) == '1' ? 'selected' : '' }}>
                                Yes
                            </option>
                            <option value="0"
                                {{ old('is_invitation_only_intern_selection_steps', $internSelectionStep->is_invitation_only_intern_selection_steps) == '0' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                        @error('is_invitation_only_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description_intern_selection_steps">Description:</label>
                        <textarea name="description_intern_selection_steps" id="description_intern_selection_steps" rows="4"
                            class="form-control summernote @error('description_intern_selection_steps') is-invalid @enderror"
                            placeholder="Enter description...">{{ old('description_intern_selection_steps', $internSelectionStep->description_intern_selection_steps) }}</textarea>
                        @error('description_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> / <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- Estimated Start Date -->
                    <div class="form-group">
                        <label for="estimated_start_date_intern_selection_steps">Estimated Start Date:</label>
                        <input type="date" name="estimated_start_date_intern_selection_steps"
                            id="estimated_start_date_intern_selection_steps"
                            value="{{ old('estimated_start_date_intern_selection_steps', $internSelectionStep->estimated_start_date_intern_selection_steps) }}"
                            class="form-control @error('estimated_start_date_intern_selection_steps') is-invalid @enderror">
                        @error('estimated_start_date_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Estimated End Date -->
                    <div class="form-group">
                        <label for="estimated_end_date_intern_selection_steps">Estimated End Date:</label>
                        <input type="date" name="estimated_end_date_intern_selection_steps"
                            id="estimated_end_date_intern_selection_steps"
                            value="{{ old('estimated_end_date_intern_selection_steps', $internSelectionStep->estimated_end_date_intern_selection_steps) }}"
                            class="form-control @error('estimated_end_date_intern_selection_steps') is-invalid @enderror">
                        @error('estimated_end_date_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_intern_selection_steps">Status:</label>
                        <select name="status_intern_selection_steps" id="status_intern_selection_steps"
                            class="form-control @error('status_intern_selection_steps') is-invalid @enderror">
                            <option value="active"
                                {{ old('status_intern_selection_steps', $internSelectionStep->status_intern_selection_steps) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status_intern_selection_steps', $internSelectionStep->status_intern_selection_steps) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('status_intern_selection_steps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary"
                                href="{{ route('internship-offering.selection-steps.index', ['id' => $internSelectionStep->intern_position_batch_id]) }}">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            const maxChar = 10000;

            $('.summernote').summernote({
                height: 150,
                placeholder: 'Write description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ]
            });

            // Disable/enable is_invitation_only based on is_mandatory
            $('#is_mondatory_intern_selection_steps').on('change', function() {
                let isMandatory = $(this).val();

                if (isMandatory === '1') {
                    $('#is_invitation_only_intern_selection_steps')
                        .val('0')
                        .prop('readonly', true)
                        .css('pointer-events', 'none')
                        .css('background-color', '#e9ecef');
                } else {
                    $('#is_invitation_only_intern_selection_steps')
                        .val('1')
                        .prop('readonly', true)
                        .css('pointer-events', 'none')
                        .css('background-color', '#e9ecef');
                }
            });

            // Trigger once on load
            $('#is_mondatory_intern_selection_steps').trigger('change');

            // Character counter logic
            function updateCharCount() {
                let content = $('.summernote').summernote('code');
                let plainText = $('<div>').html(content).text();
                let charCount = plainText.trim().length;

                $('#descCharCount').text(charCount);
                $('#descRemainingChar').text(maxChar - charCount);

                if (charCount > maxChar) {
                    $('#descCharCount').addClass('text-danger');
                    $('#submitBtn').prop('disabled', true);
                } else {
                    $('#descCharCount').removeClass('text-danger');
                    $('#submitBtn').prop('disabled', false);
                }
            }

            $('.summernote').on('summernote.change', updateCharCount);
            updateCharCount();
            $('#descMaxChar').text(maxChar);
        });
    </script>
@endpush
