@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Internship Offering</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-offering.index') }}"
                            class="{{ request()->routeIs('internship-offering.index') ? 'active' : '' }}">
                            Internship Offering Management
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Internship Offering
                    </li>
                </ol>
            </div>
            <div class="card-body">
                @if ($errors->has('date'))
                    <div class="alert alert-danger">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('internship-offering.update', $offering->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Intern Position -->
                    <div class="form-group">
                        <label for="intern_position_id">Intern Position:</label>
                        <select name="intern_position_id" id="intern_position_id"
                            class="form-control @error('intern_position_id') is-invalid @enderror">
                            <option value="">-- Select Intern Position --</option>
                            @foreach ($internPositions as $position)
                                <option value="{{ $position->id }}"
                                    {{ (old('intern_position_id') ?? $offering->intern_position_id) == $position->id ? 'selected' : '' }}>
                                    {{ $position->name_intern_positions }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_position_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Intern Batch -->
                    <div class="form-group">
                        <label for="intern_batch_id">Internship Batch:</label>
                        <select name="intern_batch_id" id="intern_batch_id"
                            class="form-control @error('intern_batch_id') is-invalid @enderror">
                            <option value="">-- Select Internship Batch --</option>
                            @foreach ($internBatches as $batch)
                                <option value="{{ $batch->id }}"
                                    {{ (old('intern_batch_id') ?? $offering->intern_batch_id) == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->name_intern_batches }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_batch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Quota -->
                    <div class="form-group">
                        <label for="quota_intern_position_batches">Quota:</label>
                        <input type="number" name="quota_intern_position_batches" id="quota_intern_position_batches"
                            min="1" class="form-control @error('quota_intern_position_batches') is-invalid @enderror"
                            value="{{ old('quota_intern_position_batches') ?? $offering->quota_intern_position_batches }}"
                            placeholder="Enter Quota">
                        @error('quota_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_intern_position_batches">Status:</label>
                        <select name="status_intern_position_batches" id="status_intern_position_batches"
                            class="form-control @error('status_intern_position_batches') is-invalid @enderror">
                            <option value="active"
                                {{ (old('status_intern_position_batches') ?? $offering->status_intern_position_batches) == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ (old('status_intern_position_batches') ?? $offering->status_intern_position_batches) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('status_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Start Date (Registration Start) -->
                    <div class="form-group">
                        <label for="start_date_intern_position_batches">Registration Start Date:</label>
                        <input type="date" name="start_date_intern_position_batches"
                            id="start_date_intern_position_batches"
                            class="form-control @error('start_date_intern_position_batches') is-invalid @enderror"
                            value="{{ old('start_date_intern_position_batches') ?? $offering->start_date_intern_position_batches }}">
                        @error('start_date_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Date (Registration End) -->
                    <div class="form-group">
                        <label for="end_date_intern_position_batches">Registration End Date:</label>
                        <input type="date" name="end_date_intern_position_batches" id="end_date_intern_position_batches"
                            class="form-control @error('end_date_intern_position_batches') is-invalid @enderror"
                            value="{{ old('end_date_intern_position_batches') ?? $offering->end_date_intern_position_batches }}">
                        @error('end_date_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Start Internship Date -->
                    <div class="form-group">
                        <label for="start_internship_position_batches">Internship Start Date:</label>
                        <input type="date" name="start_internship_position_batches"
                            id="start_internship_position_batches"
                            class="form-control @error('start_internship_position_batches') is-invalid @enderror"
                            value="{{ old('start_internship_position_batches') ?? $offering->start_internship_position_batches }}">
                        @error('start_internship_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Internship Date -->
                    <div class="form-group">
                        <label for="end_internship_position_batches">Internship End Date:</label>
                        <input type="date" name="end_internship_position_batches" id="end_internship_position_batches"
                            class="form-control @error('end_internship_position_batches') is-invalid @enderror"
                            value="{{ old('end_internship_position_batches') ?? $offering->end_internship_position_batches }}">
                        @error('end_internship_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- intern_location_id -->
                    <div class="form-group">
                        <label for="intern_location_id">Internship Location:</label>
                        <select name="intern_location_id" id="intern_location_id"
                            class="form-control @error('intern_location_id') is-invalid @enderror">
                            <option value="">-- Select Internship Location --</option>
                            @foreach ($internLocations as $location)
                                <option value="{{ $location->id }}"
                                    {{ old('intern_location_id') ?? $offering->intern_location_id == $location->id ? 'selected' : '' }}>
                                    {{ $location->intern_location_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_location_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Compensation Type -->
                    <div class="form-group">
                        <label for="compensation_intern_position_batches">Compensation Type:</label>
                        <select name="compensation_intern_position_batches" id="compensation_intern_position_batches"
                            class="form-control @error('compensation_intern_position_batches') is-invalid @enderror"
                            required>
                            <option value="">-- Select Compensation Type --</option>
                            <option value="paid"
                                {{ old('compensation_intern_position_batches') ?? $offering->compensation_intern_position_batches == 'paid' ? 'selected' : '' }}>
                                Paid</option>
                            <option value="unpaid"
                                {{ old('compensation_intern_position_batches') ?? $offering->compensation_intern_position_batches == 'unpaid' ? 'selected' : '' }}>
                                Unpaid
                            </option>
                        </select>
                        @error('compensation_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Compensation Amount -->
                    <div class="form-group">
                        <label for="compensation_amount_intern_position_batches">Compensation Amount (if Paid):</label>
                        <input type="number" name="compensation_amount_intern_position_batches"
                            id="compensation_amount_intern_position_batches" step="0.01"
                            class="form-control @error('compensation_amount_intern_position_batches') is-invalid @enderror"
                            value="{{ old('compensation_amount_intern_position_batches') ?? $offering->compensation_amount_intern_position_batches }}"
                            placeholder="e.g. 1500000">
                        @error('compensation_amount_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Compensation Description -->
                    <div class="form-group">
                        <label for="compensation_description_intern_position_batches">Compensation Description:</label>
                        <textarea name="compensation_description_intern_position_batches"
                            id="compensation_description_intern_position_batches" rows="3"
                            class="form-control @error('compensation_description_intern_position_batches') is-invalid @enderror"
                            placeholder="Example: Monthly allowance of Rp1.500.000, transport covered, etc.">{{ old('compensation_description_intern_position_batches') ?? $offering->compensation_description_intern_position_batches }}</textarea>
                        @error('compensation_description_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="compensationCharCount">0</span> / <span
                                id="compensationMaxChar">10000</span>
                            Remaining: <span id="compensationRemainingChar">10000</span>
                        </small>
                    </div>


                    <!-- Description -->
                    <div class="form-group">
                        <label for="description_intern_position_batches">Description:</label>
                        <textarea name="description_intern_position_batches" id="description_intern_position_batches" rows="4"
                            class="form-control summernote @error('description_intern_position_batches') is-invalid @enderror"
                            placeholder="Enter description">{{ old('description_intern_position_batches') ?? $offering->description_intern_position_batches }}</textarea>
                        @error('description_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> / <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- Apply Requirements -->
                    <div class="form-group">
                        <label for="apply_requirements_intern_position_batches">Apply Requirements:</label>
                        <textarea name="apply_requirements_intern_position_batches" id="apply_requirements_intern_position_batches"
                            rows="4"
                            class="form-control summernote @error('apply_requirements_intern_position_batches') is-invalid @enderror"
                            placeholder="Enter apply requirements">{{ old('apply_requirements_intern_position_batches') ?? $offering->apply_requirements_intern_position_batches }}</textarea>
                        @error('apply_requirements_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="reqCharCount">0</span> / <span id="reqMaxChar">10000</span>
                            Remaining: <span id="reqRemainingChar">10000</span>
                        </small>
                    </div>

                    {{-- benefits_intern_position_batches --}}
                    <div class="form-group">
                        <label for="benefits_intern_position_batches">Benefits:</label>
                        <textarea name="benefits_intern_position_batches" id="benefits_intern_position_batches" rows="4"
                            class="form-control summernote @error('benefits_intern_position_batches') is-invalid @enderror"
                            placeholder="Enter benefits">{{ old('benefits_intern_position_batches') ?? $offering->benefits_intern_position_batches }}</textarea>
                        @error('benefits_intern_position_batches')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="benefitCharCount">0</span> / <span id="benefitMaxChar">10000</span>
                            Remaining: <span id="benefitRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('internship-offering.index') }}">Cancel</a>
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

        .breadcrumb-item a.active,
        .breadcrumb-item.active {
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

            // Initialize Summernote editors
            $('#description_intern_position_batches, #apply_requirements_intern_position_batches',
                    '#compensation_description_intern_position_batches', '#benefits_intern_position_batches')
                .summernote({
                    height: 150,
                    placeholder: 'Write here...',
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                        ['view', ['codeview']]
                    ]
                });

            function toggleCompensationFields() {
                const type = $('#compensation_intern_position_batches').val();
                if (type === 'paid') {
                    $('#compensation_amount_intern_position_batches').closest('.form-group').show();
                    $('#compensation_description_intern_position_batches').closest('.form-group').show();
                } else {
                    $('#compensation_amount_intern_position_batches').val('');
                    $('#compensation_description_intern_position_batches').val('');
                    $('#compensation_amount_intern_position_batches').closest('.form-group').hide();
                    $('#compensation_description_intern_position_batches').closest('.form-group').hide();
                }

            }

            // Run on page load and on change
            toggleCompensationFields();
            $('#compensation_intern_position_batches').on('change', toggleCompensationFields);

            // Function to update char count for description
            function updateCharCount(selector, charCountId, remainingCharId, submitBtnId) {
                let content = $(selector).summernote('code');
                let plainText = $('<div>').html(content).text();
                let charCount = plainText.trim().length;

                $(charCountId).text(charCount);
                $(remainingCharId).text(maxChar - charCount);

                if (charCount > maxChar) {
                    $(charCountId).addClass('text-danger');
                    $(submitBtnId).prop('disabled', true);
                } else {
                    $(charCountId).removeClass('text-danger');
                    $(submitBtnId).prop('disabled', false);
                }
            }

            // Update char count on summernote content change
            $('#description_intern_position_batches').on('summernote.change', function() {
                updateCharCount('#description_intern_position_batches', '#descCharCount',
                    '#descRemainingChar', '#submitBtn');
            });

            $('#apply_requirements_intern_position_batches').on('summernote.change', function() {
                updateCharCount('#apply_requirements_intern_position_batches', '#reqCharCount',
                    '#reqRemainingChar', '#submitBtn');
            });

            $('#compensation_description_intern_position_batches').on('summernote.change', function() {
                updateCharCount('#compensation_description_intern_position_batches',
                    '#compensationCharCount',
                    '#compensationRemainingChar', '#submitBtn');
            });

            $('#benefits_intern_position_batches').on('summernote.change', function() {
                updateCharCount('#benefits_intern_position_batches', '#benefitCharCount',
                    '#benefitRemainingChar', '#submitBtn');
            });

            // Initial char count update
            updateCharCount('#description_intern_position_batches', '#descCharCount', '#descRemainingChar',
                '#submitBtn');
            updateCharCount('#apply_requirements_intern_position_batches', '#reqCharCount', '#reqRemainingChar',
                '#submitBtn');

            updateCharCount('#compensation_description_intern_position_batches', '#compensationCharCount',
                '#compensationRemainingChar', '#submitBtn');
            updateCharCount('#benefits_intern_position_batches', '#benefitCharCount', '#benefitRemainingChar',
                '#submitBtn');

            $('#descMaxChar').text(maxChar);
            $('#reqMaxChar').text(maxChar);
            $('#compensationMaxChar').text(maxChar);
            $('#benefitMaxChar').text(maxChar);
        });
    </script>
@endpush
