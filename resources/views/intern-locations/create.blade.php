@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Intern Location Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-locations.index') }}"
                            class="{{ request()->routeIs('intern-locations.index') ? 'active' : '' }}">
                            Intern Location Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('intern-locations.create') }}"
                            class="{{ request()->routeIs('intern-locations.create') ? 'active' : '' }}">
                            Create Intern Location
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Intern Location Create Form -->
                <form method="POST" action="{{ route('intern-locations.store') }}">
                    @csrf

                    <!-- Location Name -->
                    <div class="form-group">
                        <label for="intern_location_name">Location Name:</label>
                        <input type="text" name="intern_location_name" id="intern_location_name"
                            placeholder="e.g., Office Jakarta"
                            class="form-control @error('intern_location_name') is-invalid @enderror"
                            value="{{ old('intern_location_name') }}">
                        @error('intern_location_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- intern_location_country -->
                    <div class="form-group">
                        <label for="intern_location_country">Country:</label>
                        <select name="intern_location_country" id="intern_location_country"
                            class="form-control @error('intern_location_country') is-invalid @enderror">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->name }}"
                                    {{ old('intern_location_country') == $country->name ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_location_country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Address -->
                    <div class="form-group">
                        <label for="intern_location_address">Address:</label>
                        <textarea name="intern_location_address" id="intern_location_address" rows="3"
                            class="form-control @error('intern_location_address') is-invalid @enderror" placeholder="Street, Number, etc.">{{ old('intern_location_address') }}</textarea>
                        @error('intern_location_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Province -->
                    <div class="form-group">
                        <label for="intern_location_province">Province:</label>
                        <select name="intern_location_province" id="intern_location_province"
                            class="form-control @error('intern_location_province') is-invalid @enderror">
                            <option value="">Select Province</option>
                            @foreach ($province as $prov)
                                <option value="{{ $prov->name }}"
                                    {{ old('intern_location_province') == $prov->name ? 'selected' : '' }}>
                                    {{ $prov->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('intern_location_province')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Regency -->
                    <div class="form-group">
                        <label for="intern_location_regency">Regency/City:</label>
                        <select name="intern_location_regency" id="intern_location_regency"
                            class="form-control @error('intern_location_regency') is-invalid @enderror">
                            <option value="">Select Regency</option>
                        </select>
                        @error('intern_location_regency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- District -->
                    <div class="form-group">
                        <label for="intern_location_district">District:</label>
                        <select name="intern_location_district" id="intern_location_district"
                            class="form-control @error('intern_location_district') is-invalid @enderror">
                            <option value="">Select District</option>
                        </select>
                        @error('intern_location_district')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Village -->
                    <div class="form-group">
                        <label for="intern_location_village">Village:</label>
                        <select name="intern_location_village" id="intern_location_village"
                            class="form-control @error('intern_location_village') is-invalid @enderror">
                            <option value="">Select Village</option>
                        </select>
                        @error('intern_location_village')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div class="form-group">
                        <label for="intern_location_postal_code">Postal Code:</label>
                        <input type="text" name="intern_location_postal_code" id="intern_location_postal_code"
                            class="form-control @error('intern_location_postal_code') is-invalid @enderror"
                            placeholder="e.g., 12345" value="{{ old('intern_location_postal_code') }}">
                        @error('intern_location_postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="intern_location_phone_number">Phone Number:</label>
                        <input type="text" name="intern_location_phone_number" id="intern_location_phone_number"
                            class="form-control @error('intern_location_phone_number') is-invalid @enderror"
                            placeholder="e.g., 021-xxxxxxx" value="{{ old('intern_location_phone_number') }}">
                        @error('intern_location_phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Location Type -->
                    <div class="form-group">
                        <label for="intern_location_type">Location Type:</label>
                        <select name="intern_location_type" id="intern_location_type"
                            class="form-control @error('intern_location_type') is-invalid @enderror">
                            <option value="head_office"
                                {{ old('intern_location_type') == 'head_office' ? 'selected' : '' }}>Head Office</option>
                            <option value="branch" {{ old('intern_location_type') == 'branch' ? 'selected' : '' }}>Branch
                            </option>
                        </select>
                        @error('intern_location_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="intern_location_status">Status:</label>
                        <select name="intern_location_status" id="intern_location_status"
                            class="form-control @error('intern_location_status') is-invalid @enderror">
                            <option value="active" {{ old('intern_location_status') == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('intern_location_status') == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                        @error('intern_location_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('intern-locations.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
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
    <script>
        $(document).ready(function() {
            $('#intern_location_country').select2({
                placeholder: 'Select a country',
                allowClear: true
            });
        });
    </script>
    <script>
        // Load regencies on province change
        $('#intern_location_province').on('change', function() {
            var provinceName = encodeURIComponent($(this).val());
            $('#intern_location_regency').html('<option value="">Loading...</option>');
            $.get(`/get-regencies/${provinceName}`, function(data) {
                var options = '<option value="">Select Regency</option>';
                data.forEach(function(reg) {
                    options += `<option value="${reg.name}">${reg.name}</option>`;
                });
                $('#intern_location_regency').html(options);
                $('#intern_location_district, #intern_location_village').html(
                    '<option value="">Select...</option>');
            });
        });

        // Load districts on regency change
        $('#intern_location_regency').on('change', function() {
            var regencyName = encodeURIComponent($(this).val());
            $('#intern_location_district').html('<option value="">Loading...</option>');
            $.get(`/get-districts/${regencyName}`, function(data) {
                var options = '<option value="">Select District</option>';
                data.forEach(function(d) {
                    options += `<option value="${d.name}">${d.name}</option>`;
                });
                $('#intern_location_district').html(options);
                $('#intern_location_village').html('<option value="">Select Village</option>');
            });
        });

        // Load villages on district change
        $('#intern_location_district').on('change', function() {
            var districtName = encodeURIComponent($(this).val());
            $('#intern_location_village').html('<option value="">Loading...</option>');
            $.get(`/get-villages/${districtName}`, function(data) {
                var options = '<option value="">Select Village</option>';
                data.forEach(function(v) {
                    options += `<option value="${v.name}">${v.name}</option>`;
                });
                $('#intern_location_village').html(options);
            });
        });
    </script>
@endpush
