@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Internship Batch</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('internship-batch.index') }}"
                            class="{{ request()->routeIs('internship-batch.index') ? 'active' : '' }}">
                            Internship Batch Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="active">Edit Internship Batch</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Edit Internship Batch Form -->
                <form method="POST" action="{{ route('internship-batch.update', $internBatch->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Batch Name -->
                    <div class="form-group">
                        <label for="name_intern_batches">Batch Name:</label>
                        <input type="text" name="name_intern_batches" id="name_intern_batches" placeholder="Batch Name"
                            class="form-control @error('name_intern_batches') is-invalid @enderror"
                            value="{{ old('name_intern_batches', $internBatch->name_intern_batches) }}">
                        @error('name_intern_batches')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Batch Description -->
                    <div class="form-group">
                        <label for="description_intern_batches">Description:</label>
                        <textarea name="description_intern_batches" id="description_intern_batches" rows="4"
                            class="form-control summernote @error('description_intern_batches') is-invalid @enderror"
                            placeholder="Batch Description">{{ old('description_intern_batches', $internBatch->description_intern_batches) }}</textarea>
                        @error('description_intern_batches')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> / <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>

                    <!-- Start Date -->
                    <div class="form-group">
                        <label for="start_date_intern_batches">Start Date:</label>
                        <input type="date" name="start_date_intern_batches" id="start_date_intern_batches"
                            class="form-control @error('start_date_intern_batches') is-invalid @enderror"
                            value="{{ old('start_date_intern_batches', $internBatch->start_date_intern_batches) }}">
                        @error('start_date_intern_batches')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="form-group">
                        <label for="end_date_intern_batches">End Date:</label>
                        <input type="date" name="end_date_intern_batches" id="end_date_intern_batches"
                            class="form-control @error('end_date_intern_batches') is-invalid @enderror"
                            value="{{ old('end_date_intern_batches', $internBatch->end_date_intern_batches) }}">
                        @error('end_date_intern_batches')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_intern_batches">Status:</label>
                        <select name="status_intern_batches" id="status_intern_batches"
                            class="form-control @error('status_intern_batches') is-invalid @enderror">
                            <option value="upcoming"
                                {{ old('status_intern_batches', $internBatch->status_intern_batches) == 'upcoming' ? 'selected' : '' }}>
                                Upcoming</option>
                            <option value="ongoing"
                                {{ old('status_intern_batches', $internBatch->status_intern_batches) == 'ongoing' ? 'selected' : '' }}>
                                Ongoing</option>
                            <option value="completed"
                                {{ old('status_intern_batches', $internBatch->status_intern_batches) == 'completed' ? 'selected' : '' }}>
                                Completed</option>
                        </select>
                        @error('status_intern_batches')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('internship-batch.index') }}">Cancel</a>
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
                placeholder: 'Write batch description here...',
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
