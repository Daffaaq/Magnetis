<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSelectionStepRequest;
use App\Http\Requests\UpdateSelectionStepRequest;
use App\Models\SelectionStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Yajra\DataTables\Facades\DataTables;


class SelectionStepController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:recruitment-step.index')->only('index', 'list');
        $this->middleware('permission:recruitment-step.create')->only('create', 'store');
        $this->middleware('permission:recruitment-step.edit')->only('edit', 'update');
        $this->middleware('permission:recruitment-step.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $selectionSteps = DB::table('selection_steps')
                ->select('id', 'name_selection_steps','status_selection_steps');

            return DataTables::of($selectionSteps)
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('selection-steps.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('selection-steps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSelectionStepRequest $request)
    {
        $count = count($request->name_selection_steps);

        for ($i = 0; $i < $count; $i++) {
            $selectionStep = SelectionStep::create([
                'name_selection_steps' => $request->name_selection_steps[$i],
                'description_selection_steps' => $request->description_selection_steps[$i],
                'status_selection_steps' => $request->status_selection_steps[$i],
            ]);

            $this->logUserActivity(
                'Selection Step Created',
                "Created new selection step with ID {$selectionStep->id}",
                auth()->id(),
                $selectionStep
            );
        }

        return redirect()->route('recruitment-step.index')->with('success', 'Selection Steps Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $selectionStep = SelectionStep::findOrFail($id);
        return view('selection-steps.show', compact('selectionStep'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $selectionStep = SelectionStep::findOrFail($id);
        return view('selection-steps.edit', compact('selectionStep'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSelectionStepRequest $request, $id)
    {
        $selectionStep = SelectionStep::findOrFail($id);
        $selectionStep->name_selection_steps = $request->name_selection_steps;
        $selectionStep->description_selection_steps = $request->description_selection_steps;
        $selectionStep->status_selection_steps = $request->status_selection_steps;
        $selectionStep->save();

        $this->logUserActivity(
            'Selection Step Updated',
            "Updated selection step with ID {$selectionStep->id}",
            auth()->id(),
            $selectionStep
        );

        return redirect()->route('recruitment-step.index')->with('success', 'Selection Step Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $selectionStep = SelectionStep::findOrFail($id);
            $selectionStep->delete();

            $this->logUserActivity(
                'Selection Step Deleted',
                "Deleted selection step with ID {$selectionStep->id}",
                auth()->id(),
                $selectionStep
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Selection Step Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the selection step. Please try again later.']);
        }
    }
}
