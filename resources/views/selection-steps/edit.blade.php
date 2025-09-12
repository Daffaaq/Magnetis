@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Selection Step</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('recruitment-step.index') }}"
                            class="{{ request()->routeIs('recruitment-step.index') ? 'active' : '' }}">
                            Recruitment Step Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('recruitment-step.edit', $selectionStep->id) }}"
                            class="{{ request()->routeIs('recruitment-step.edit', $selectionStep->id) ? 'active' : '' }}">
                            Edit Selection Step
                        </a>
                        <a href="#" class="active">Edit Selection Step</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Edit Selection Step Form -->
                <form method="POST" action="{{ route('recruitment-step.update', $selectionStep->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Step Name -->
                    <div class="form-group">
                        <label for="name_selection_steps">Step Name:</label>
                        <input type="text" name="name_selection_steps" id="name_selection_steps" placeholder="Step Name"
                            class="form-control @error('name_selection_steps') is-invalid @enderror"
                            value="{{ old('name_selection_steps', $selectionStep->name_selection_steps) }}">
                        @error('name_selection_steps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description_selection_steps">Description:</label>
                        <textarea name="description_selection_steps" id="description_selection_steps" rows="4"
                            class="form-control summernote @error('description_selection_steps') is-invalid @enderror"
                            placeholder="Step Description">{{ old('description_selection_steps', $selectionStep->description_selection_steps) }}</textarea>
                        @error('description_selection_steps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> /
                            <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_selection_steps">Status:</label>
                        <select name="status_selection_steps" id="status_selection_steps"
                            class="form-control @error('status_selection_steps') is-invalid @enderror">
                            <option value="">-- Select Status --</option>
                            <option value="active"
                                {{ old('status_selection_steps', $selectionStep->status_selection_steps) == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ old('status_selection_steps', $selectionStep->status_selection_steps) == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                        @error('status_selection_steps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('recruitment-step.index') }}">Cancel</a>
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
                placeholder: 'Write selection step description here...',
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
