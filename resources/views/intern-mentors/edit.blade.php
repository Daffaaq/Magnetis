@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Mentor Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.index') }}"
                            class="{{ request()->routeIs('mentor.index') ? 'active' : '' }}">Mentor Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.edit', $internMentor->id) }}"
                            class="{{ request()->routeIs('mentor.edit') ? 'active' : '' }}">Edit Mentor</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Mentor Edit Form -->
                <form method="POST" action="{{ route('mentor.update', $internMentor->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nickname -->
                    <div class="form-group">
                        <label for="nickname_intern_mentors">Nickname:</label>
                        <input type="text" name="nickname_intern_mentors" id="nickname_intern_mentors"
                            placeholder="Nickname"
                            class="form-control @error('nickname_intern_mentors') is-invalid @enderror"
                            value="{{ old('nickname_intern_mentors', $internMentor->user->name) }}">
                        @error('nickname_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email_intern_mentors">Email:</label>
                        <input type="email" name="email_intern_mentors" id="email_intern_mentors" placeholder="Email"
                            class="form-control @error('email_intern_mentors') is-invalid @enderror"
                            value="{{ old('email_intern_mentors', $internMentor->email_intern_mentors) }}">
                        @error('email_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name_intern_mentors">Full Name:</label>
                        <input type="text" name="name_intern_mentors" id="name_intern_mentors" placeholder="Full Name"
                            class="form-control @error('name_intern_mentors') is-invalid @enderror"
                            value="{{ old('name_intern_mentors', $internMentor->name_intern_mentors) }}">
                        @error('name_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone_intern_mentors">Phone:</label>
                        <input type="text" name="phone_intern_mentors" id="phone_intern_mentors" placeholder="Phone"
                            class="form-control @error('phone_intern_mentors') is-invalid @enderror"
                            value="{{ old('phone_intern_mentors', $internMentor->phone_intern_mentors) }}">
                        @error('phone_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department_id">Department:</label>
                        <select name="department_id" id="department_id"
                            class="form-control @error('department_id') is-invalid @enderror">
                            <option value="">-- Select Department --</option>
                            @foreach ($departments->get() as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $internMentor->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name_departments }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_intern_mentors">Status:</label>
                        <select name="status_intern_mentors" id="status_intern_mentors"
                            class="form-control @error('status_intern_mentors') is-invalid @enderror">
                            <option value="">-- Select Status --</option>
                            <option value="active"
                                {{ old('status_intern_mentors', $internMentor->status_intern_mentors) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status_intern_mentors', $internMentor->status_intern_mentors) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('status_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Position Title -->
                    <div class="form-group">
                        <label for="position_title_intern_mentors">Position Title:</label>
                        <input type="text" name="position_title_intern_mentors" id="position_title_intern_mentors"
                            placeholder="Position Title"
                            class="form-control @error('position_title_intern_mentors') is-invalid @enderror"
                            value="{{ old('position_title_intern_mentors', $internMentor->position_title_intern_mentors) }}">
                        @error('position_title_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <!-- Bio -->
                    <div class="form-group">
                        <label for="bio_intern_mentors">Bio:</label>
                        <textarea name="bio_intern_mentors" id="bio_intern_mentors" rows="3"
                            class="form-control summernote @error('bio_intern_mentors') is-invalid @enderror"
                            placeholder="Tulis bio singkat mentor di sini...">{{ old('bio_intern_mentors', $internMentor->bio_intern_mentors) }}</textarea>

                        @error('bio_intern_mentors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="text-muted d-block mt-1">
                            Characters: <span id="descCharCount">0</span> /
                            <span id="descMaxChar">10000</span>
                            Remaining: <span id="descRemainingChar">10000</span>
                        </small>
                    </div>


                    <!-- Profile Picture -->
                    <div class="custom-file-dropzone" id="dropzone-area">
                        <p>Drag & drop your image here or click to select</p>
                    </div>

                    <input type="file" accept="image/*" name="profile_picture_intern_mentors"
                        id="profile_picture_intern_mentors"
                        class="@error('profile_picture_intern_mentors') is-invalid @enderror" style="display: none;">

                    <div id="image-preview-container" class="text-center mt-3"
                        style="{{ $internMentor->profile_picture_intern_mentors ? 'display: block;' : 'display: none;' }}">
                        @if ($internMentor->profile_picture_intern_mentors)
                            <img id="preview-image"
                                src="{{ asset('storage/' . $internMentor->profile_picture_intern_mentors) }}"
                                alt="Image Preview" />
                        @else
                            <img id="preview-image" src="#" alt="Image Preview" />
                        @endif
                        <br>
                        <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-image-btn">Remove
                            Image</button>
                    </div>

                    @error('profile_picture_intern_mentors')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('mentor.index') }}">Cancel</a>
                            <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
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

        .custom-file-dropzone {
            border: 2px dashed #007bff;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: border 0.3s ease;
        }

        .custom-file-dropzone.dragover {
            border-color: #28a745;
            background-color: #f0fff4;
        }

        #preview-image {
            max-width: 200px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        #remove-image-btn {
            display: block;
            margin: 10px auto 0;
            z-index: 2;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            const maxChar = 10000;

            $('#bio_intern_mentors').summernote({
                height: 150,
                placeholder: 'Tulis bio singkat mentor di sini...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ],
                callbacks: {
                    onChange: function(contents) {
                        updateCharCount(contents);
                    }
                }
            });

            function updateCharCount(content) {
                const plainText = $('<div>').html(content).text().trim();
                const charCount = plainText.length;

                $('#descCharCount').text(charCount);
                $('#descRemainingChar').text(maxChar - charCount);

                if (charCount > maxChar) {
                    $('#descCharCount').addClass('text-danger');
                    $('#descRemainingChar').addClass('text-danger');
                    $('#submitBtn').prop('disabled', true);
                } else {
                    $('#descCharCount').removeClass('text-danger');
                    $('#descRemainingChar').removeClass('text-danger');
                    $('#submitBtn').prop('disabled', false);
                }
            }

            // Trigger awal saat halaman load
            const initialContent = $('#bio_intern_mentors').summernote('code');
            updateCharCount(initialContent);
            $('#descMaxChar').text(maxChar);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropzoneArea = document.getElementById('dropzone-area');
            const fileInput = document.getElementById('profile_picture_intern_mentors');
            const previewImage = document.getElementById('preview-image');
            const previewContainer = document.getElementById('image-preview-container');
            const removeBtn = document.getElementById('remove-image-btn');

            function handleFileChange(e) {
                const file = e.target.files[0];

                if (file) {
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!allowedTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Only JPG, JPEG, and PNG files are allowed.'
                        });
                        fileInput.value = '';
                        previewImage.src = '#';
                        previewContainer.style.display = 'none';
                        return;
                    }

                    if (file.size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Image size must be less than 2MB.'
                        });
                        fileInput.value = '';
                        previewImage.src = '#';
                        previewContainer.style.display = 'none';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewContainer.style.display = 'none';
                    previewImage.src = '#';
                }
            }

            dropzoneArea.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', handleFileChange);

            dropzoneArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzoneArea.classList.add('dragover');
            });

            dropzoneArea.addEventListener('dragleave', function(e) {
                dropzoneArea.classList.remove('dragover');
            });

            dropzoneArea.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzoneArea.classList.remove('dragover');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            });

            removeBtn.addEventListener('click', function() {
                fileInput.value = '';
                previewImage.src = '#';
                previewContainer.style.display = 'none';
            });
        });
    </script>
@endpush
