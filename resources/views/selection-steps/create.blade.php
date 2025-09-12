@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Recruitment Step Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('recruitment-step.index') }}"
                            class="{{ request()->routeIs('recruitment-step.index') ? 'active' : '' }}">
                            Recruitment Step Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('recruitment-step.create') }}"
                            class="{{ request()->routeIs('recruitment-step.create') ? 'active' : '' }}">
                            Create Step
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('recruitment-step.store') }}">
                    @csrf

                    <div id="step-form-wrapper">
                        <div class="step-form border p-3 mb-3">
                            <h6 class="font-weight-bold mb-3">Selection Step</h6>

                            <!-- Step Name -->
                            <div class="form-group">
                                <label>Step Name:</label>
                                <input type="text" name="name_selection_steps[]" placeholder="Step Name"
                                    class="form-control">
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea name="description_selection_steps[]" rows="4" class="form-control summernote"
                                    placeholder="Selection Step Description"></textarea>
                                <small class="text-muted d-block mt-1">
                                    Characters: <span class="descCharCount">0</span> /
                                    <span class="descMaxChar">10000</span>
                                    Remaining: <span class="descRemainingChar">10000</span>
                                </small>
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label>Status:</label>
                                <select name="status_selection_steps[]" class="form-control">
                                    <option value="">-- Select Status --</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-danger remove-step mt-2">Remove</button>
                        </div>
                    </div>

                    <!-- Add More -->
                    <div class="mb-3">
                        <button type="button" id="add-step" class="btn btn-success">+ Add Selection Step</button>
                    </div>

                    <!-- Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('recruitment-step.index') }}">Cancel</a>
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
                placeholder: 'Write selection step description here...',
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
            // Initialize the first summernote
            initSummernote($('.step-form').first());

            // Add new step
            $('#add-step').on('click', function() {
                let original = $('.step-form').first();

                // Destroy summernote to prevent cloning with the editor HTML
                original.find('.summernote').summernote('destroy');

                // Clone the form
                let newStep = original.clone();

                // Re-initialize the original one
                initSummernote(original);

                // Reset fields in the clone
                newStep.find('input, textarea').val('');
                newStep.find('select').val('');
                newStep.find('.descCharCount').text('0');
                newStep.find('.descRemainingChar').text(maxChar);

                // Append clone and init Summernote
                $('#step-form-wrapper').append(newStep);
                initSummernote(newStep);
            });


            // Remove step
            $(document).on('click', '.remove-step', function() {
                if ($('.step-form').length > 1) {
                    $(this).closest('.step-form').remove();
                } else {
                    alert('Minimal satu form harus ada.');
                }
            });
        });
    </script>
@endpush
