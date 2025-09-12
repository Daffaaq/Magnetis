<?php

namespace App\Http\Controllers\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignRequest;
use App\Http\Requests\UpdateAssignRequest;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ActivityLogHelper;

class AssignPermissionController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:assign.index')->only('index');
        $this->middleware('permission:assign.create')->only('create', 'store');
        $this->middleware('permission:assign.edit')->only('edit', 'update');
    }

    private function generateAssignPermissionLogData(Role $role): array
    {
        return [
            'Role ID' => $role->id,
            'Nama Role' => $role->name,
            'Permissions' => $role->getPermissionNames()->implode(', ')
        ];
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            // Ambil semua role beserta permissions-nya
            $roles = Role::all(); // Ambil semua role, bisa juga menggunakan 'with' jika perlu relasi lain

            // Proses data untuk dikirim ke DataTable
            $data = $roles->map(function ($role) {
                return [
                    'DT_RowIndex' => $role->getKey(),
                    'name' => $role->name,
                    'permissions' => $role->getPermissionNames()->implode(', '), // Gunakan getPermissionNames() untuk nama permissions
                    'id' => $role->id,
                ];
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permissions.assign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $menuGroups = MenuGroup::with('menuItems')->get();
        return view('permissions.assign.create', compact('roles', 'permissions', 'menuGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignRequest $request)
    {
        $role = Role::findOrFail($request->role);  // Gunakan findOrFail untuk memastikan role ditemukan

        // Ambil permission berdasarkan ID yang dikirim dalam request
        $permissions = Permission::whereIn('name', $request->permissions)->get();

        // Berikan permission ke role
        $role->givePermissionTo($permissions);

        $logData = $this->generateAssignPermissionLogData($role);
        $this->logUserActivity(
            'Permission Assigned to Role',
            "Assigned permissions to role: {$role->name}",
            auth()->id(),
            null,
            $logData
        );

        // Redirect setelah berhasil memberikan permission
        return redirect()->route('assign.index')->with('success', 'Permission Assigned Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $menuGroups = MenuGroup::with('menuItems')->get();
        return view('permissions.assign.edit', compact('role', 'permissions', 'menuGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignRequest $request, Role $role)
    {
        $permissions = Permission::whereIn('name', $request->permissions)->get();
        $role->syncPermissions($permissions);

        $logData = $this->generateAssignPermissionLogData($role);
        $this->logUserActivity(
            'Permission Updated on Role',
            "Updated permissions for role: {$role->name}",
            auth()->id(),
            null,
            $logData
        );
        return redirect()->route('assign.index')->with('success', 'Permission Assigned Successfully');
    }

}
