@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Assign Mentor to Intern Position Batch</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.batch.assignment.index', $mentor->id) }}"
                            class="{{ request()->routeIs('mentor.batch.assignment.index') ? 'active' : '' }}">
                            Mentor Batch Assignments
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('mentor.batch.assignment.create', $mentor->id) }}"
                            class="{{ request()->routeIs('mentor.batch.assignment.create') ? 'active' : '' }}">
                            Assign Mentor
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                @if ($isEmptyBatch)
                    <div class="alert alert-warning">
                        <strong>Informasi:</strong> Belum terdapat data <em>Intern Position Batch</em> yang aktif saat ini.
                        Silakan tambahkan terlebih dahulu untuk dapat melanjutkan proses penugasan mentor.
                    </div>
                @else
                    <div class="alert alert-success">
                        <strong>Informasi:</strong> Tersedia <em>Intern Position Batch</em> yang aktif. Anda dapat
                        melanjutkan proses penugasan mentor.
                    </div>
                @endif



                <form method="POST" action="{{ route('mentor.batch.assignment.store', $mentor->id) }}">
                    @csrf

                    <!-- Mentor info (readonly) -->
                    <div class="form-group">
                        <label>Mentor:</label>
                        <input type="text" class="form-control" value="{{ $mentor->name_intern_mentors ?? 'No Name' }}"
                            readonly>
                        <small class="text-muted">Department: {{ $mentor->department->name_departments ?? 'N/A' }}</small>
                    </div>

                    <!-- Intern Position Batch Select -->
                    <div class="form-group">
                        <label for="intern_position_batch_id">Intern Position Batch:</label>
                        <select name="intern_position_batch_id" id="intern_position_batch_id"
                            class="form-control @error('intern_position_batch_id') is-invalid @enderror" required>
                            <option value="">-- Select Position Batch --</option>
                            @foreach ($positionBatches as $batch)
                                <option value="{{ $batch->id }}"
                                    data-dept-id="{{ $batch->internPosition->department_id ?? '' }}"
                                    {{ old('intern_position_batch_id') == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->internPosition->name_intern_positions ?? 'N/A' }} -
                                    Dept: {{ $batch->internPosition->department->name_departments ?? 'N/A' }} -
                                    Batch: {{ $batch->internBatch->name_intern_batches ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_position_batch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_mentor_batch_assignments">Status:</label>
                        <select name="status_mentor_batch_assignments" id="status_mentor_batch_assignments"
                            class="form-control @error('status_mentor_batch_assignments') is-invalid @enderror" required>
                            <option value="">-- Select Status --</option>
                            <option value="active"
                                {{ old('status_mentor_batch_assignments') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive"
                                {{ old('status_mentor_batch_assignments') == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                            <option value="resigned"
                                {{ old('status_mentor_batch_assignments') == 'resigned' ? 'selected' : '' }}>Resigned
                            </option>
                            <option value="on_leave"
                                {{ old('status_mentor_batch_assignments') == 'on_leave' ? 'selected' : '' }}>On Leave
                            </option>
                        </select>
                        @error('status_mentor_batch_assignments')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Note (kondisional wajib kalau lintas divisi) -->
                    <!-- Note (kondisional wajib kalau lintas divisi) -->
                    <div class="form-group">
                        <label for="note_mentor_batch_assignments">Catatan (wajib jika lintas divisi):</label>
                        <textarea name="note_mentor_batch_assignments" id="note_mentor_batch_assignments" rows="4"
                            class="form-control @error('note_mentor_batch_assignments') is-invalid @enderror"
                            placeholder="Masukkan catatan jika mentor lintas divisi">{{ old('note_mentor_batch_assignments') }}</textarea>
                        @error('note_mentor_batch_assignments')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small>
                            Jumlah karakter: <span id="noteCharCount">0</span> / <span id="noteMaxChar">10000</span> | Sisa:
                            <span id="noteRemainingChar">10000</span>
                        </small>
                    </div>


                    <!-- Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="{{ route('mentor.batch.assignment.index', $mentor->id) }}"
                                class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary" id="submitBtn"
                                {{ $isEmptyBatch ? 'disabled' : '' }}>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- Tambahkan SweetAlert2 CDN kalau belum ada -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maxNoteChar = 10000;
            const noteTextarea = $('#note_mentor_batch_assignments');
            const submitBtn = $('#submitBtn');

            // Initialize Summernote
            noteTextarea.summernote({
                height: 150,
                placeholder: 'Masukkan catatan jika mentor lintas divisi',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        updateNoteCharCount();
                    }
                }
            });

            function updateNoteCharCount() {
                const content = noteTextarea.summernote('code');
                const plainText = $('<div>').html(content).text();
                const charCount = plainText.trim().length;
                const remaining = maxNoteChar - charCount;

                $('#noteCharCount').text(charCount);
                $('#noteRemainingChar').text(remaining);
                $('#noteMaxChar').text(maxNoteChar);

                if (charCount > maxNoteChar) {
                    $('#noteCharCount').addClass('text-danger');
                    submitBtn.prop('disabled', true);
                } else {
                    $('#noteCharCount').removeClass('text-danger');
                    submitBtn.prop('disabled', false);
                }
            }

            // Inisialisasi counter awal
            updateNoteCharCount();

            // Integrasi dengan lintas divisi
            const mentorDeptId = "{{ $mentor->department_id }}";
            const selectBatch = document.getElementById('intern_position_batch_id');

            function setNoteRequired(isRequired) {
                if (isRequired) {
                    noteTextarea.attr('data-required', 'true'); // pakai data attr
                } else {
                    noteTextarea.removeAttr('data-required');
                }
            }

            selectBatch.addEventListener('change', function() {
                const selectedOption = selectBatch.options[selectBatch.selectedIndex];
                const batchDeptId = selectedOption.getAttribute('data-dept-id');

                if (!batchDeptId) {
                    setNoteRequired(false);
                    return;
                }

                if (batchDeptId !== mentorDeptId) {
                    Swal.fire({
                        title: 'Konfirmasi Lintas Divisi',
                        text: 'Anda memilih posisi batch di divisi berbeda. Kolom catatan menjadi wajib diisi.',
                        icon: 'warning',
                        confirmButtonText: 'Oke',
                    });
                    setNoteRequired(true);
                } else {
                    setNoteRequired(false);
                }
            });

            // Validasi sebelum submit
            $('form').on('submit', function(e) {
                const isNoteRequired = noteTextarea.attr('data-required') === 'true';
                const content = noteTextarea.summernote('code');
                const plainText = $('<div>').html(content).text().trim();

                if (isNoteRequired && plainText === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Catatan wajib diisi',
                        text: 'Karena lintas divisi, kolom catatan tidak boleh kosong.',
                    });
                    noteTextarea.summernote('focus');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mentorDeptId = "{{ $mentor->department_id }}";
            const selectBatch = document.getElementById('intern_position_batch_id');
            const noteTextarea = document.getElementById('note_mentor_batch_assignments');
            const submitBtn = document.getElementById('submitBtn');

            function setNoteRequired(isRequired) {
                if (isRequired) {
                    noteTextarea.setAttribute('required', 'required');
                    noteTextarea.classList.add('is-invalid'); // awalnya merah, akan dikoreksi saat input
                } else {
                    noteTextarea.removeAttribute('required');
                    noteTextarea.classList.remove('is-invalid');
                }
            }

            // Cek lintas divisi dan tampilkan alert
            selectBatch.addEventListener('change', function() {
                const selectedOption = selectBatch.options[selectBatch.selectedIndex];
                const batchDeptId = selectedOption.getAttribute('data-dept-id');

                if (!batchDeptId) {
                    // Jika gak ada data dept, reset note required
                    setNoteRequired(false);
                    return;
                }

                if (batchDeptId !== mentorDeptId) {
                    // Ini lintas divisi
                    Swal.fire({
                        title: 'Konfirmasi Lintas Divisi',
                        text: 'Anda memilih posisi batch di divisi berbeda. Kolom catatan menjadi wajib diisi.',
                        icon: 'warning',
                        confirmButtonText: 'Oke',
                    });

                    setNoteRequired(true);
                } else {
                    // Sama divisi, note tidak wajib
                    setNoteRequired(false);
                }
            });

            // Validasi saat submit supaya note tidak kosong kalau wajib
            document.querySelector('form').addEventListener('submit', function(e) {
                const isNoteRequired = noteTextarea.hasAttribute('required');

                if (isNoteRequired && noteTextarea.value.trim() === '') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Catatan wajib diisi',
                        text: 'Karena lintas divisi, kolom catatan tidak boleh kosong.',
                    });
                    noteTextarea.focus();
                }
            });

            // Optional: validasi live untuk hilangkan class is-invalid saat user mulai ketik di note
            noteTextarea.addEventListener('input', function() {
                if (noteTextarea.value.trim().length > 0) {
                    noteTextarea.classList.remove('is-invalid');
                }
            });
        });
    </script>
@endpush
