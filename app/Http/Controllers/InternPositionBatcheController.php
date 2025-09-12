<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternPositionBatcheRequest;
use App\Http\Requests\UpdateInternPositionBatcheRequest;
use App\Models\InternPositionBatche;
use App\Models\InternPosition;
use App\Models\InternBatche;
use App\Models\InternLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ActivityLogHelper;

class InternPositionBatcheController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:internship-offering.index')->only('index', 'list');
        $this->middleware('permission:internship-offering.create')->only('create', 'store');
        $this->middleware('permission:internship-offering.edit')->only('edit', 'update');
        $this->middleware('permission:internship-offering.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $offerings = DB::table('intern_position_batches')
                ->join('intern_positions', 'intern_position_batches.intern_position_id', '=', 'intern_positions.id')
                ->join('intern_batches', 'intern_position_batches.intern_batch_id', '=', 'intern_batches.id')
                ->select(
                    'intern_position_batches.id',
                    'intern_positions.name_intern_positions as position',
                    'intern_batches.name_intern_batches as batch',
                    'intern_position_batches.quota_intern_position_batches as quota',
                    'intern_position_batches.status_intern_position_batches as status',
                    'intern_position_batches.start_date_intern_position_batches as start_date',
                    'intern_position_batches.end_date_intern_position_batches as end_date'
                );

            return DataTables::of($offerings)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('internship-position-batch.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $internPositions = InternPosition::where('status_intern_positions', 'active')->get();
        $internBatches = InternBatche::all();
        $internLocations = InternLocation::select('id', 'intern_location_name')->get();
        return view('internship-position-batch.create', compact('internPositions', 'internBatches', 'internLocations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternPositionBatcheRequest $request)
    {
        // Ambil data batch dari DB
        $batch = InternBatche::findOrFail($request->intern_batch_id);

        // Validasi custom: cek apakah tanggal-tanggal masuk dalam rentang batch
        if ($request->start_date_intern_position_batches > $batch->start_date_intern_batches) {
            return back()->withErrors([
                'start_date_intern_position_batches' => 'Tanggal mulai pendaftaran tidak boleh lebih awal dari tanggal mulai batch.',
            ])->withInput();
        }

        if ($request->end_date_intern_position_batches > $batch->start_date_intern_batches) {
            return back()->withErrors([
                'end_date_intern_position_batches' => 'Tanggal akhir pendaftaran tidak boleh lebih awal dari tanggal mulai batch.',
            ])->withInput();
        }

        // 3. Cek start internship < start batch
        if ($request->start_internship_position_batches < $batch->start_date_intern_batches) {
            return back()->withErrors([
                'start_internship_position_batches' => 'Tanggal mulai magang tidak boleh lebih awal dari tanggal mulai batch.',
            ])->withInput();
        }

        // 4. Cek end internship > end batch
        if ($request->end_internship_position_batches > $batch->end_date_intern_batches) {
            return back()->withErrors([
                'end_internship_position_batches' => 'Tanggal akhir magang tidak boleh melebihi tanggal akhir batch.',
            ])->withInput();
        }

        // Validasi tambahan: start pendaftaran harus sebelum mulai magang
        if ($request->start_date_intern_position_batches > $request->start_internship_position_batches) {
            return back()->withErrors(['start_date_intern_position_batches' => 'Tanggal mulai pendaftaran harus sebelum tanggal mulai magang.'])->withInput();
        }

        $offering = InternPositionBatche::create($request->all());

        $this->logUserActivity(
            'Internship Offering Created',
            "Created internship offering with ID {$offering->id}",
            auth()->id(),
            $offering
        );

        return redirect()->route('internship-offering.index')->with('success', 'Internship offering created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offering = InternPositionBatche::with([
            'internPosition',
            'internBatch',
            'internLocation',
            'selectionSteps' => function ($query) {
                $query->where('status_intern_selection_steps', 'active');
            }
        ])->findOrFail($id);
        return view('internship-position-batch.show', compact('offering'));
    }

    /**
     * Show form to edit offering.
     */
    public function edit($id)
    {
        $offering = InternPositionBatche::findOrFail($id);
        $internPositions = InternPosition::where('status_intern_positions', 'active')->get();
        $internBatches = InternBatche::all();
        $internLocations = InternLocation::select('id', 'intern_location_name')->get();
        return view('internship-position-batch.edit', compact('offering', 'internPositions', 'internBatches', 'internLocations'));
    }

    /**
     * Update offering.
     */
    public function update(UpdateInternPositionBatcheRequest $request, $id)
    {
        $batch = InternBatche::findOrFail($request->intern_batch_id);

        // Validasi custom: cek apakah tanggal-tanggal masuk dalam rentang batch
        if ($request->start_date_intern_position_batches > $batch->start_date_intern_batches) {
            return back()->withErrors([
                'start_date_intern_position_batches' => 'Tanggal mulai pendaftaran tidak boleh lebih awal dari tanggal mulai batch.',
            ])->withInput();
        }

        if ($request->end_date_intern_position_batches > $batch->start_date_intern_batches) {
            return back()->withErrors([
                'end_date_intern_position_batches' => 'Tanggal akhir pendaftaran tidak boleh lebih awal dari tanggal mulai batch.',
            ])->withInput();
        }

        // 3. Cek start internship < start batch
        if ($request->start_internship_position_batches < $batch->start_date_intern_batches) {
            return back()->withErrors([
                'start_internship_position_batches' => 'Tanggal mulai magang tidak boleh lebih awal dari tanggal mulai batch.',
            ])->withInput();
        }

        // 4. Cek end internship > end batch
        if ($request->end_internship_position_batches > $batch->end_date_intern_batches) {
            return back()->withErrors([
                'end_internship_position_batches' => 'Tanggal akhir magang tidak boleh melebihi tanggal akhir batch.',
            ])->withInput();
        }

        // Validasi tambahan: start pendaftaran harus sebelum mulai magang
        if ($request->start_date_intern_position_batches > $request->start_internship_position_batches) {
            return back()->withErrors(['start_date_intern_position_batches' => 'Tanggal mulai pendaftaran harus sebelum tanggal mulai magang.'])->withInput();
        }

        if ($request->compensation_intern_position_batches === 'unpaid') {
            $request->merge([
                'compensation_amount_intern_position_batches' => null,
                'compensation_description_intern_position_batches' => null,
            ]);
        }


        $offering = InternPositionBatche::findOrFail($id);
        $offering->update($request->all());

        $this->logUserActivity(
            'Internship Offering Updated',
            "Updated internship offering with ID {$offering->id}",
            auth()->id(),
            $offering
        );

        return redirect()->route('internship-offering.index')->with('success', 'Internship offering updated successfully.');
    }

    /**
     * Delete offering.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $offering = InternPositionBatche::findOrFail($id);
            $offering->delete();

            $this->logUserActivity(
                'Internship Offering Deleted',
                "Deleted internship offering with ID {$offering->id}",
                auth()->id(),
                $offering
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Internship offering deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete internship offering.']);
        }
    }
}
