@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Intern Position</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-position.index') }}"
                            class="{{ request()->routeIs('intern-position.index') ? 'active' : '' }}">
                            Intern Positions Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-position.edit', $internPosition->id) }}"
                            class="{{ request()->routeIs('intern-position.edit', $internPosition->id) ? 'active' : '' }}">
                            Edit Intern Position
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Edit Intern Position Form -->
                <form method="POST" action="{{ route('intern-position.update', $internPosition->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department_id">Department:</label>
                        <select name="department_id" id="department_id"
                            class="form-control @error('department_id') is-invalid @enderror">
                            <option value="">-- Select Department --</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $internPosition->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name_departments }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name_intern_positions">Position Name:</label>
                        <input type="text" name="name_intern_positions" id="name_intern_positions"
                            placeholder="Position Name"
                            class="form-control @error('name_intern_positions') is-invalid @enderror"
                            value="{{ old('name_intern_positions', $internPosition->name_intern_positions) }}">
                        @error('name_intern_positions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description_intern_positions">Description:</label>
                        <textarea name="description_intern_positions" id="description_intern_positions" rows="4"
                            class="form-control summernote @error('description_intern_positions') is-invalid @enderror"
                            placeholder="Position Description">{{ old('description_intern_positions', $internPosition->description_intern_positions) }}</textarea>
                        @error('description_intern_positions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> /
                            <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_intern_positions">Status:</label>
                        <select name="status_intern_positions" id="status_intern_positions"
                            class="form-control @error('status_intern_positions') is-invalid @enderror">
                            <option value="">-- Select Status --</option>
                            <option value="active"
                                {{ old('status_intern_positions', $internPosition->status_intern_positions) == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ old('status_intern_positions', $internPosition->status_intern_positions) == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                        @error('status_intern_positions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('intern-position.index') }}">Cancel</a>
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
                placeholder: 'Write position description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ]
            });

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
            updateCharCount(); // Initial count
            $('#descMaxChar').text(maxChar);
        });
    </script>
@endpush
