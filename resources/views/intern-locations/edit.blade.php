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
                        <a href="{{ route('intern-locations.edit', $internLocation->id) }}"
                            class="{{ request()->routeIs('intern-locations.edit') ? 'active' : '' }}">
                            Edit Intern Location
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Intern Location Edit Form -->
                <form method="POST" action="{{ route('intern-locations.update', $internLocation->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Location Name -->
                    <div class="form-group">
                        <label for="intern_location_name">Location Name:</label>
                        <input type="text" name="intern_location_name" id="intern_location_name"
                            placeholder="e.g., Office Jakarta"
                            class="form-control @error('intern_location_name') is-invalid @enderror"
                            value="{{ old('intern_location_name', $internLocation->intern_location_name) }}">
                        @error('intern_location_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label for="intern_location_country">Country:</label>
                        <select name="intern_location_country" id="intern_location_country"
                            class="form-control @error('intern_location_country') is-invalid @enderror">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->name }}"
                                    {{ old('intern_location_country', $internLocation->intern_location_country) == $country->name ? 'selected' : '' }}>
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
                            class="form-control @error('intern_location_address') is-invalid @enderror" placeholder="Street, Number, etc.">{{ old('intern_location_address', $internLocation->intern_location_address) }}</textarea>
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
                                    {{ old('intern_location_province', $internLocation->intern_location_province) == $prov->name ? 'selected' : '' }}>
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
                            placeholder="e.g., 12345"
                            value="{{ old('intern_location_postal_code', $internLocation->intern_location_postal_code) }}">
                        @error('intern_location_postal_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="intern_location_phone_number">Phone Number:</label>
                        <input type="text" name="intern_location_phone_number" id="intern_location_phone_number"
                            class="form-control @error('intern_location_phone_number') is-invalid @enderror"
                            placeholder="e.g., 021-xxxxxxx"
                            value="{{ old('intern_location_phone_number', $internLocation->intern_location_phone_number) }}">
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
                                {{ old('intern_location_type', $internLocation->intern_location_type) == 'head_office' ? 'selected' : '' }}>
                                Head Office
                            </option>
                            <option value="branch"
                                {{ old('intern_location_type', $internLocation->intern_location_type) == 'branch' ? 'selected' : '' }}>
                                Branch
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
                            <option value="active"
                                {{ old('intern_location_status', $internLocation->intern_location_status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('intern_location_status', $internLocation->intern_location_status) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('intern_location_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('intern-locations.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#intern_location_country').select2({
                placeholder: 'Select a country',
                allowClear: true
            });

            // Load regencies, districts, villages based on existing data (for edit)
            var selectedProvince =
                "{{ old('intern_location_province', $internLocation->intern_location_province) }}";
            var selectedRegency = "{{ old('intern_location_regency', $internLocation->intern_location_regency) }}";
            var selectedDistrict =
                "{{ old('intern_location_district', $internLocation->intern_location_district) }}";
            var selectedVillage = "{{ old('intern_location_village', $internLocation->intern_location_village) }}";

            function loadRegencies(province, selectedRegency = null) {
                if (!province) {
                    $('#intern_location_regency').html('<option value="">Select Regency</option>');
                    $('#intern_location_district').html('<option value="">Select District</option>');
                    $('#intern_location_village').html('<option value="">Select Village</option>');
                    return;
                }
                $('#intern_location_regency').html('<option value="">Loading...</option>');
                $.get(`/get-regencies/${encodeURIComponent(province)}`, function(data) {
                    var options = '<option value="">Select Regency</option>';
                    data.forEach(function(reg) {
                        options +=
                            `<option value="${reg.name}" ${selectedRegency == reg.name ? 'selected' : ''}>${reg.name}</option>`;
                    });
                    $('#intern_location_regency').html(options);
                    loadDistricts(selectedRegency, selectedDistrict);
                });
            }

            function loadDistricts(regency, selectedDistrict = null) {
                if (!regency) {
                    $('#intern_location_district').html('<option value="">Select District</option>');
                    $('#intern_location_village').html('<option value="">Select Village</option>');
                    return;
                }
                $('#intern_location_district').html('<option value="">Loading...</option>');
                $.get(`/get-districts/${encodeURIComponent(regency)}`, function(data) {
                    var options = '<option value="">Select District</option>';
                    data.forEach(function(d) {
                        options +=
                            `<option value="${d.name}" ${selectedDistrict == d.name ? 'selected' : ''}>${d.name}</option>`;
                    });
                    $('#intern_location_district').html(options);
                    loadVillages(selectedDistrict, selectedVillage);
                });
            }

            function loadVillages(district, selectedVillage = null) {
                if (!district) {
                    $('#intern_location_village').html('<option value="">Select Village</option>');
                    return;
                }
                $('#intern_location_village').html('<option value="">Loading...</option>');
                $.get(`/get-villages/${encodeURIComponent(district)}`, function(data) {
                    var options = '<option value="">Select Village</option>';
                    data.forEach(function(v) {
                        options +=
                            `<option value="${v.name}" ${selectedVillage == v.name ? 'selected' : ''}>${v.name}</option>`;
                    });
                    $('#intern_location_village').html(options);
                });
            }

            // Initial load
            loadRegencies(selectedProvince, selectedRegency);

            // On change events
            $('#intern_location_province').on('change', function() {
                var province = $(this).val();
                loadRegencies(province);
                $('#intern_location_district').html('<option value="">Select District</option>');
                $('#intern_location_village').html('<option value="">Select Village</option>');
            });

            $('#intern_location_regency').on('change', function() {
                var regency = $(this).val();
                loadDistricts(regency);
                $('#intern_location_village').html('<option value="">Select Village</option>');
            });

            $('#intern_location_district').on('change', function() {
                var district = $(this).val();
                loadVillages(district);
            });
        });
    </script>
@endpush
