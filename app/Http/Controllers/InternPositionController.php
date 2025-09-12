<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\InternPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreInternPositionRequest;
use App\Http\Requests\UpdateInternPositionRequest;
use App\Traits\ActivityLogHelper;

class InternPositionController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:intern-position.index')->only('index', 'list');
        $this->middleware('permission:intern-position.create')->only('create', 'store');
        $this->middleware('permission:intern-position.edit')->only('edit', 'update');
        $this->middleware('permission:intern-position.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $positions = DB::table('intern_positions')
                ->join('departments', 'intern_positions.department_id', '=', 'departments.id')
                ->select(
                    'intern_positions.id',
                    'intern_positions.name_intern_positions',
                    'intern_positions.status_intern_positions',
                    'departments.name_departments as department'
                );

            return DataTables::of($positions)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('intern-positions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('status_departments', 'active')->get();
        return view('intern-positions.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternPositionRequest $request)
    {
        $count = count($request->name_intern_positions);

        for ($i = 0; $i < $count; $i++) {
            $position = InternPosition::create([
                'department_id' => $request->department_id,
                'name_intern_positions' => $request->name_intern_positions[$i],
                'description_intern_positions' => $request->description_intern_positions[$i],
                'status_intern_positions' => $request->status_intern_positions[$i],
            ]);

            $this->logUserActivity(
                'Intern Position Created',
                "Created new intern position with ID {$position->id}",
                auth()->id(),
                $position
            );
        }

        return redirect()->route('intern-position.index')->with('success', 'Intern Positions Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $internPosition = InternPosition::with('department')->findOrFail($id);
        return view('intern-positions.show', compact('internPosition'));
    }

    /**
     * Show form to edit an intern position.
     */
    public function edit($id)
    {
        $internPosition = InternPosition::findOrFail($id);
        $departments = Department::where('status_departments', 'active')->get();
        return view('intern-positions.edit', compact('internPosition', 'departments'));
    }

    /**
     * Update a specific intern position.
     */
    public function update(UpdateInternPositionRequest $request, $id)
    {
        $internPosition = InternPosition::findOrFail($id);
        $internPosition->update([
            'department_id' => $request->department_id,
            'name_intern_positions' => $request->name_intern_positions,
            'description_intern_positions' => $request->description_intern_positions,
            'status_intern_positions' => $request->status_intern_positions,
        ]);

        $this->logUserActivity(
            'Intern Position Updated',
            "Updated intern position with ID {$internPosition->id}",
            auth()->id(),
            $internPosition
        );

        return redirect()->route('intern-position.index')->with('success', 'Intern Position Updated Successfully');
    }

    /**
     * Delete an intern position.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $internPosition = InternPosition::findOrFail($id);
            $internPosition->delete();

            $this->logUserActivity(
                'Intern Position Deleted',
                "Deleted intern position with ID {$internPosition->id}",
                auth()->id(),
                $internPosition
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Intern Position Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the intern position. Please try again later.']);
        }
    }
}
