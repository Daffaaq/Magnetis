@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Intern Position Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-position.index') }}"
                            class="{{ request()->routeIs('intern-position.index') ? 'active' : '' }}">
                            Intern Position Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-position.create') }}"
                            class="{{ request()->routeIs('intern-position.create') ? 'active' : '' }}">
                            Create Intern Position
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('intern-position.store') }}">
                    @csrf

                    <!-- Department Select -->
                    <div class="form-group">
                        <label for="department_id">Select Department:</label>
                        <select name="department_id" id="department_id"
                            class="form-control @error('department_id') is-invalid @enderror" required>
                            <option value="">-- Select Department --</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name_departments }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Intern Positions Form Wrapper -->
                    <div id="position-form-wrapper">
                        <div class="position-form border p-3 mb-3">
                            <h6 class="font-weight-bold mb-3">Intern Position</h6>

                            <!-- Name -->
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="name_intern_positions[]" placeholder="Position Name"
                                    class="form-control @error('name_intern_positions.0') is-invalid @enderror"
                                    value="{{ old('name_intern_positions.0') }}">
                                @error('name_intern_positions.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea name="description_intern_positions[]" rows="4" class="form-control summernote"
                                    placeholder="Description">{{ old('description_intern_positions.0') }}</textarea>
                                <small class="text-muted d-block mt-1">
                                    Characters: <span class="descCharCount">0</span> / <span
                                        class="descMaxChar">10000</span> Remaining: <span
                                        class="descRemainingChar">10000</span>
                                </small>
                                @error('description_intern_positions.0')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label>Status:</label>
                                <select name="status_intern_positions[]"
                                    class="form-control @error('status_intern_positions.0') is-invalid @enderror">
                                    <option value="">-- Select Status --</option>
                                    <option value="active"
                                        {{ old('status_intern_positions.0') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive"
                                        {{ old('status_intern_positions.0') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status_intern_positions.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-danger remove-position mt-2">Remove</button>
                        </div>
                    </div>

                    <!-- Add More Positions -->
                    <div class="mb-3">
                        <button type="button" id="add-position" class="btn btn-success">+ Add Intern Position</button>
                    </div>

                    <!-- Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('intern-position.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet" />
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
        const maxChar = 10000;

        function updateCharCount(container) {
            const content = container.find('.summernote').summernote('code');
            const plainText = $('<div>').html(content).text().trim();
            const charCount = plainText.length;

            container.find('.descCharCount').text(charCount);
            container.find('.descRemainingChar').text(maxChar - charCount);

            if (charCount > maxChar) {
                container.find('.descCharCount').addClass('text-danger');
                $('#submitBtn').prop('disabled', true);
            } else {
                container.find('.descCharCount').removeClass('text-danger');
                $('#submitBtn').prop('disabled', false);
            }
        }

        function initSummernote(container) {
            container.find('.summernote').summernote({
                height: 150,
                placeholder: 'Write description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ]
            }).on('summernote.change', function() {
                updateCharCount(container);
            });

            updateCharCount(container);
        }

        $(document).ready(function() {
            // Initialize summernote for the first form
            initSummernote($('.position-form').first());

            // Add new position form
            $('#add-position').on('click', function() {
                let original = $('.position-form').first();

                // Destroy summernote to clone clean HTML
                original.find('.summernote').summernote('destroy');

                // Clone the form
                let newPosition = original.clone();

                // Re-initialize original summernote
                initSummernote(original);

                // Clear inputs/selects in the cloned form
                newPosition.find('input').val('');
                newPosition.find('textarea').val('');
                newPosition.find('select').val('');
                newPosition.find('.descCharCount').text('0');
                newPosition.find('.descRemainingChar').text(maxChar);

                // Append new form
                $('#position-form-wrapper').append(newPosition);

                // Initialize summernote on cloned form
                initSummernote(newPosition);
            });

            // Remove position form
            $(document).on('click', '.remove-position', function() {
                if ($('.position-form').length > 1) {
                    $(this).closest('.position-form').remove();
                } else {
                    alert('Minimal harus ada satu form posisi.');
                }
            });
        });
    </script>
@endpush
