@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Role and Permission Management</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('assign.index') }}"
                            class="{{ request()->routeIs('assign.index') ? 'active' : '' }}">Role and Permission
                            Management</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('assign.create') }}"
                            class="{{ request()->routeIs('assign.create') ? 'active' : '' }}">Assign Role</a></li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('assign.store') }}">
                    @csrf
                    <!-- Role Select -->
                    <div class="form-group mb-4">
                        <label for="role">Role:</label>
                        <select id="role-select" name="role" class="form-control select2" required>
                            <option value="">Choose Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($menuGroups as $group)
                        <div class="mb-4 border rounded shadow-sm p-3 bg-white">
                            <div class="mb-3 d-flex align-items-center border-bottom pb-2">
                                <i class="{{ $group->icon }} mr-2 text-primary fs-5"></i>
                                <h5 class="mb-0">{{ $group->name }}</h5>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control permission-search-input"
                                    placeholder="🔍 Search permissions in {{ $group->name }}..."
                                    data-group="{{ $group->id }}">
                            </div>
                            <div class="row permission-group" data-group="{{ $group->id }}">

                                {{-- Group permission --}}
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            id="group_perm_{{ $group->id }}" value="{{ $group->permission_name }}">
                                        <label class="form-check-label fw-semibold" for="group_perm_{{ $group->id }}">
                                            {{ $group->name }} Permission
                                            <small class="text-muted d-block">({{ $group->permission_name }})</small>
                                        </label>
                                    </div>
                                </div>

                                {{-- Item permissions --}}
                                @foreach ($group->menuItems as $item)
                                    <div class="col-md-4 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                id="perm_{{ $item->id }}" value="{{ $item->permission_name }}">
                                            <label class="form-check-label" for="perm_{{ $item->id }}">
                                                {{ $item->name }}
                                                <small class="text-muted d-block">({{ $item->permission_name }})</small>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('assign.index') }}">Cancel</a>
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

        .form-check-label {
            font-weight: 500;
        }

        .form-check small {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .card .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border {
            border-color: #e3e6f0 !important;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .bg-white {
            background-color: #fff !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .fs-5 {
            font-size: 1.25rem;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .permission-search-input {
            border-radius: 0.375rem;
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ced4da;
            transition: border-color 0.2s;
        }

        .permission-search-input:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.1rem rgba(78, 115, 223, 0.25);
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Permission search input (reuse from edit)
            document.querySelectorAll('.permission-search-input').forEach(input => {
                input.addEventListener('input', function() {
                    const keyword = this.value.toLowerCase();
                    const groupId = this.dataset.group;
                    const container = document.querySelector(
                        `.permission-group[data-group="${groupId}"]`);

                    if (!container) return;

                    container.querySelectorAll('.form-check').forEach(box => {
                        const text = box.textContent.toLowerCase();
                        box.style.display = text.includes(keyword) ? '' : 'none';
                    });
                });
            });

            // Ketika role dipilih, fetch permission role dan centang sesuai
            const roleSelect = document.getElementById('role-select');

            roleSelect.addEventListener('change', function() {
                // Reset semua checkbox
                document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                const roleId = this.value;
                if (!roleId) return;

                fetch(`{{ url('/role-and-permission/roles') }}/${roleId}/permissions`)
                    .then(response => response.json())
                    .then(data => {
                        // data adalah array permission names
                        data.forEach(permissionName => {
                            // Cari checkbox dengan value permissionName
                            const checkbox = document.querySelector(
                                `input[name="permissions[]"][value="${permissionName}"]`);
                            if (checkbox) {
                                checkbox.checked = true;
                            }
                        });
                    })
                    .catch(err => console.error('Failed to fetch permissions:', err));
            });
        });
    </script>
@endpush
