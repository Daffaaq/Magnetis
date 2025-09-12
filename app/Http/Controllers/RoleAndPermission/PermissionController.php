<?php

namespace App\Http\Controllers\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use App\Traits\ActivityLogHelper;

class PermissionController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission.index')->only('index', 'list');
        $this->middleware('permission:permission.create')->only('create', 'store');
        $this->middleware('permission:permission.edit')->only('edit', 'update');
        $this->middleware('permission:permission.destroy')->only('destroy');
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $permissions = DB::table('permissions')->select('name', 'guard_name', 'id');
            return DataTables::of($permissions)
                ->addIndexColumn()
                ->make(true);
        }
    }
    private function generatePermissionLogData(Permission $permission): array
    {
        return [
            'ID' => $permission->id,
            'Nama Permission' => $permission->name,
            'Guard' => $permission->guard_name,
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permissions.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionsRequest $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web',
        ]);

        $logData = $this->generatePermissionLogData($permission);

        $this->logUserActivity(
            'Permission Created',
            "Created permission: {$permission->name}",
            auth()->id(),
            null,
            $logData
        );

        return redirect()->route('permission.index')->with('success', 'Permission Created Successfully');
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
    public function edit(Permission $permission)
    {
        //
        return view('permissions.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionsRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        $logData = $this->generatePermissionLogData($permission);

        $this->logUserActivity(
            'Permission Updated',
            "Updated permission: {$permission->name}",
            auth()->id(),
            null,
            $logData
        );
        return redirect()->route('permission.index')->with('success', 'Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $logData = $this->generatePermissionLogData($permission);
            // Delete the role
            $permission->delete();

            $this->logUserActivity(
                'Permission Deleted',
                "Deleted permission: {$permission->name}",
                auth()->id(),
                null,
                $logData
            );

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Permission Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            // If there's an error, return a failure response
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Permission. Please try again later.'
            ]);
        }
    }
}
