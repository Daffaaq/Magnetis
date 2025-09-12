@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Department Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('department.index') }}"
                            class="{{ request()->routeIs('department.index') ? 'active' : '' }}">Department Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('department.create') }}"
                            class="{{ request()->routeIs('department.create') ? 'active' : '' }}">Create Department</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Department Create Form -->
                <form method="POST" action="{{ route('department.store') }}">
                    @csrf

                    <!-- Department Name -->
                    <div class="form-group">
                        <label for="name_departments">Department Name:</label>
                        <input type="text" name="name_departments" id="name_departments" placeholder="Department Name"
                            class="form-control @error('name_departments') is-invalid @enderror"
                            value="{{ old('name_departments') }}">
                        @error('name_departments')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Department Description -->
                    <div class="form-group">
                        <label for="description_departments">Description:</label>
                        <textarea name="description_departments" id="description_departments" rows="4"
                            class="form-control summernote @error('description_departments') is-invalid @enderror"
                            placeholder="Department Description">{{ old('description_departments') }}</textarea>
                        @error('description_departments')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> / <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- status_departments -->
                    <div class="form-group">
                        <label for="status_departments">Status:</label>
                        <select name="status_departments" id="status_departments"
                            class="form-control @error('status_departments') is-invalid @enderror">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status_departments')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('department.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
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
                placeholder: 'Write department description here...',
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
            updateCharCount(); // Initial load
            $('#descMaxChar').text(maxChar);
        });
    </script>
@endpush
