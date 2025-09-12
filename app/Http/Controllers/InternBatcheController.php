<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternBatchRequest;
use App\Http\Requests\UpdateInternBatchRequest;
use App\Models\InternBatche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Yajra\DataTables\Facades\DataTables;

class InternBatcheController extends Controller
{
    use ActivityLogHelper;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:internship-batch.index')->only('index', 'list');
        $this->middleware('permission:internship-batch.create')->only('create', 'store');
        $this->middleware('permission:internship-batch.edit')->only('edit', 'update');
        $this->middleware('permission:internship-batch.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $internBatches = DB::table('intern_batches')
                ->select('id', 'name_intern_batches', 'start_date_intern_batches', 'end_date_intern_batches', 'status_intern_batches');

            return DataTables::of($internBatches)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('internship-batches.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('internship-batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternBatchRequest $request)
    {
        $internBatch = InternBatche::create([
            'name_intern_batches' => $request->name_intern_batches,
            'description_intern_batches' => $request->description_intern_batches,
            'start_date_intern_batches' => $request->start_date_intern_batches,
            'end_date_intern_batches' => $request->end_date_intern_batches,
            'status_intern_batches' => $request->status_intern_batches,
        ]);

        $this->logUserActivity(
            'Intern Batch Created',
            "Created new intern batch with ID {$internBatch->id}",
            auth()->id(),
            $internBatch
        );

        return redirect()->route('internship-batch.index')->with('success', 'Intern Batch Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $internBatch = InternBatche::findOrFail($id);
        return view('internship-batches.show', compact('internBatch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $internBatch = InternBatche::findOrFail($id);
        return view('internship-batches.edit', compact('internBatch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternBatchRequest $request, $id)
    {
        $internBatch = InternBatche::findOrFail($id);
        $internBatch->name_intern_batches = $request->name_intern_batches;
        $internBatch->description_intern_batches = $request->description_intern_batches;
        $internBatch->start_date_intern_batches = $request->start_date_intern_batches;
        $internBatch->end_date_intern_batches = $request->end_date_intern_batches;
        $internBatch->status_intern_batches = $request->status_intern_batches;
        $internBatch->save();

        $this->logUserActivity(
            'Intern Batch Updated',
            "Updated intern batch with ID {$internBatch->id}",
            auth()->id(),
            $internBatch
        );

        return redirect()->route('internship-batch.index')->with('success', 'Intern Batch Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $internBatch = InternBatche::findOrFail($id);
            $internBatch->delete();

            $this->logUserActivity(
                'Intern Batch Deleted',
                "Deleted intern batch with ID {$internBatch->id}",
                auth()->id(),
                $internBatch
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Intern Batch Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the intern batch. Please try again later.']);
        }
    }
}
