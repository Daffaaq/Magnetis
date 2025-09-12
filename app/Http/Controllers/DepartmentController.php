<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:department.index')->only('index', 'list');
        $this->middleware('permission:department.create')->only('create', 'store');
        $this->middleware('permission:department.edit')->only('edit', 'update');
        $this->middleware('permission:department.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $departments = DB::table('departments')->select('name_departments', 'id', 'status_departments');
            return DataTables::of($departments)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('departments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request) 
    {
        $department = Department::create([
            'name_departments' => $request['name_departments'],
            'description_departments' => $request['description_departments'],
            'status_departments' => $request['status_departments'],
        ]);
        // Emit event setelah berhasil create departemen
        $this->logUserActivity(
            'Department Created',
            "Created new department with ID {$department->id}",
            auth()->id(),
            $department
        );
        return redirect()->route('department.index')->with('success', 'Department Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        //
        $department = Department::find($id);
        $department->name_departments = $request['name_departments'];
        $department->description_departments = $request['description_departments'];
        $department->status_departments = $request['status_departments'];
        $department->save();
        // Emit event setelah berhasil update departemen
        $this->logUserActivity(
            'Department Updated',
            "Updated department with ID {$department->id}",
            auth()->id(),
            $department
        );
        return redirect()->route('department.index')->with('success', 'Department Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // mulai transaksi
        DB::beginTransaction();
        try {
            $department = Department::find($id);
            $department->delete();
            // Emit event setelah berhasil delete departemen
            $this->logUserActivity(
                'Department Deleted',
                "Deleted department with ID {$department->id}",
                auth()->id(),
                $department
            );
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Department Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the department. Please try again later.']);
        }
    }
}
