<?php

namespace App\Http\Controllers\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Traits\ActivityLogHelper;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role.index')->only('index', 'list');
        $this->middleware('permission:role.create')->only('create', 'store');
        $this->middleware('permission:role.edit')->only('edit', 'update');
        $this->middleware('permission:role.destroy')->only('destroy');
    }

    private function generateRoleLogData(Role $role): array
    {
        return [
            'ID' => $role->id,
            'Nama Role' => $role->name,
            'Guard' => $role->guard_name,
        ];
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $roles = DB::table('roles')->select('name', 'guard_name', 'id');
            return DataTables::of($roles)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permissions.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web',
        ]);

        // Pakai fungsi private untuk nyiapin datanya
        $logData = $this->generateRoleLogData($role);

        // Lempar ke logUserActivity
        $this->logUserActivity(
            'Role Created',
            "Created new role: {$role->name}",
            auth()->id(),
            null,         // Subject bisa null karena kamu pakai custom data
            $logData      // Kirim array custom data dari fungsi
        );
        return redirect()->route('role.index')->with('success', 'Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('permissions.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        // Pakai fungsi private untuk nyiapin datanya
        $logData = $this->generateRoleLogData($role);

        // Lempar ke logUserActivity
        $this->logUserActivity(
            'Role Updated',
            "Updated role: {$role->name}",
            auth()->id(),
            null,         // Subject bisa null karena kamu pakai custom data
            $logData      // Kirim array custom data dari fungsi
        );
        return redirect()->route('role.index')->with('success', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            // Delete the role
            $role->delete();

            // Pakai fungsi private untuk nyiapin datanya
            $logData = $this->generateRoleLogData($role);

            // Lempar ke logUserActivity
            $this->logUserActivity(
                'Role Deleted',
                "Deleted role: {$role->name}",
                auth()->id(),
                null,         // Subject bisa null karena kamu pakai custom data
                $logData      // Kirim array custom data dari fungsi
            );

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Role Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            // If there's an error, return a failure response
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the role. Please try again later.'
            ]);
        }
    }
}
