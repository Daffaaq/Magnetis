<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternSelectionStepRequest;
use App\Http\Requests\UpdateInternSelectionStepRequest;
use App\Models\InternPositionBatche;
use App\Models\InternSelectionStep;
use App\Models\SelectionStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ActivityLogHelper;

class InternSelectionStepController extends Controller
{
    use ActivityLogHelper;
    public function index($id)
    {
        $internPositionBatch = InternPositionBatche::with('internPosition', 'internBatch', 'internLocation')->findOrFail($id);
        return view('intern-selection-steps.index', compact('internPositionBatch'));
    }

    public function list(Request $request, $id)
    {
        if ($request->ajax()) {
            $internSelectionSteps = DB::table('intern_selection_steps')
                ->leftJoin('selection_steps', 'intern_selection_steps.selection_step_id', '=', 'selection_steps.id')
                ->where('intern_position_batch_id', '=', $id)
                ->select('intern_selection_steps.id', 'selection_steps.name_selection_steps', 'intern_selection_steps.status_intern_selection_steps', 'intern_selection_steps.step_order_intern_selection_steps', 'intern_selection_steps.is_mondatory_intern_selection_steps')
                ->orderBy('intern_selection_steps.step_order_intern_selection_steps', 'asc')
                ->get(); // <-- penting!

            return DataTables::of($internSelectionSteps)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create($id)
    {
        $internPositionBatch = InternPositionBatche::with('internPosition', 'internBatch', 'internLocation')->findOrFail($id);
        $selectionStep = SelectionStep::select('id', 'name_selection_steps')->where('status_selection_steps', 'active')->get();
        return view('intern-selection-steps.create', compact('internPositionBatch', 'selectionStep'));
    }

    public function store(StoreInternSelectionStepRequest $request, $id)
    {
        // Ambil batch berdasarkan id (intern_position_batch_id)
        $batch = InternPositionBatche::findOrFail($id);

        // Validasi estimated_start_date_intern_selection_steps ada di antara start_date dan end_date batch
        if (
            $request->estimated_start_date_intern_selection_steps < $batch->start_date_intern_position_batches ||
            $request->estimated_start_date_intern_selection_steps > $batch->end_date_intern_position_batches
        ) {
            return back()->withErrors([
                'estimated_start_date_intern_selection_steps' => 'Tanggal mulai estimasi harus berada di antara tanggal mulai dan akhir batch.',
            ])->withInput();
        }

        // Validasi estimated_end_date_intern_selection_steps juga di dalam rentang batch
        if (
            $request->estimated_end_date_intern_selection_steps < $batch->start_date_intern_position_batches ||
            $request->estimated_end_date_intern_selection_steps > $batch->end_date_intern_position_batches
        ) {
            return back()->withErrors([
                'estimated_end_date_intern_selection_steps' => 'Tanggal akhir estimasi harus berada di antara tanggal mulai dan akhir batch.',
            ])->withInput();
        }

        // Validasi end_date tidak boleh sebelum start_date (meskipun sudah ada di rules, double check di controller juga gak apa-apa)
        if ($request->estimated_end_date_intern_selection_steps < $request->estimated_start_date_intern_selection_steps) {
            return back()->withErrors([
                'estimated_end_date_intern_selection_steps' => 'Tanggal akhir estimasi harus sama atau setelah tanggal mulai estimasi.',
            ])->withInput();
        }

        // Cek apakah sudah ada step_order yang sama di batch ini
        $exists = InternSelectionStep::where('intern_position_batch_id', $id)
            ->where('step_order_intern_selection_steps', $request->step_order_intern_selection_steps)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'step_order_intern_selection_steps' => 'Step order sudah digunakan pada batch ini. Harap gunakan nomor urut yang lain.',
            ])->withInput();
        }


        // Jika lolos semua validasi manual, lanjut simpan data
        $internSelectionStep = InternSelectionStep::create([
            'intern_position_batch_id' => $id,
            'selection_step_id' => $request->selection_step_id,
            'status_intern_selection_steps' => $request->status_intern_selection_steps,
            'is_mondatory_intern_selection_steps' => $request->is_mondatory_intern_selection_steps,
            'step_order_intern_selection_steps' => $request->step_order_intern_selection_steps,
            'is_invitation_only_intern_selection_steps' => $request->is_invitation_only_intern_selection_steps,
            'description_intern_selection_steps' => $request->description_intern_selection_steps,
            'estimated_start_date_intern_selection_steps' => $request->estimated_start_date_intern_selection_steps,
            'estimated_end_date_intern_selection_steps' => $request->estimated_end_date_intern_selection_steps,
        ]);

        $this->logUserActivity(
            'Innternship Selection Step Created',
            "Created Intern Selection Step with ID {$internSelectionStep->id}",
            auth()->id(),
            $internSelectionStep
        );

        return redirect()->route('internship-offering.selection-steps.index', ['id' => $internSelectionStep->intern_position_batch_id])
            ->with('success', 'Selection step created successfully.');
    }

    public function show($id)
    {
        $internSelectionStep = InternSelectionStep::with('internPositionBatch', 'selectionStep')->findOrFail($id);
        return view('intern-selection-steps.show', compact('internSelectionStep'));
    }


    public function edit($id)
    {
        $internSelectionStep = InternSelectionStep::with('internPositionBatch', 'selectionStep')->findOrFail($id);
        $selectionStep = SelectionStep::select('id', 'name_selection_steps')->where('status_selection_steps', 'active')->get();
        return view('intern-selection-steps.edit', compact('internSelectionStep', 'selectionStep'));
    }

    public function update(UpdateInternSelectionStepRequest $request, $id)
    {
        $internSelectionStep = InternSelectionStep::findOrFail($id);
        $batch = $internSelectionStep->internPositionBatch;

        // Validasi tanggal mulai estimasi di rentang batch
        if (
            $request->estimated_start_date_intern_selection_steps < $batch->start_date_intern_position_batches ||
            $request->estimated_start_date_intern_selection_steps > $batch->end_date_intern_position_batches
        ) {
            return back()->withErrors([
                'estimated_start_date_intern_selection_steps' => 'Tanggal mulai estimasi harus berada di antara tanggal mulai dan akhir batch.',
            ])->withInput();
        }

        // Validasi tanggal akhir estimasi di rentang batch
        if (
            $request->estimated_end_date_intern_selection_steps < $batch->start_date_intern_position_batches ||
            $request->estimated_end_date_intern_selection_steps > $batch->end_date_intern_position_batches
        ) {
            return back()->withErrors([
                'estimated_end_date_intern_selection_steps' => 'Tanggal akhir estimasi harus berada di antara tanggal mulai dan akhir batch.',
            ])->withInput();
        }

        // Validasi tanggal akhir tidak lebih kecil dari tanggal mulai
        if ($request->estimated_end_date_intern_selection_steps < $request->estimated_start_date_intern_selection_steps) {
            return back()->withErrors([
                'estimated_end_date_intern_selection_steps' => 'Tanggal akhir estimasi harus sama atau setelah tanggal mulai estimasi.',
            ])->withInput();
        }

        // Validasi unik step_order per batch (kecuali data ini)
        $exists = InternSelectionStep::where('intern_position_batch_id', $batch->id)
            ->where('step_order_intern_selection_steps', $request->step_order_intern_selection_steps)
            ->where('id', '!=', $internSelectionStep->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'step_order_intern_selection_steps' => 'Step order sudah digunakan pada batch ini. Harap gunakan nomor urut yang lain.',
            ])->withInput();
        }


        // Data yang akan diupdate
        $dataToUpdate = [
            'selection_step_id' => $request->selection_step_id,
            'status_intern_selection_steps' => $request->status_intern_selection_steps,
            'is_mondatory_intern_selection_steps' => $request->is_mondatory_intern_selection_steps,
            'is_invitation_only_intern_selection_steps' => $request->is_invitation_only_intern_selection_steps,
            'step_order_intern_selection_steps' => $request->step_order_intern_selection_steps,
            'description_intern_selection_steps' => $request->description_intern_selection_steps,
            'estimated_start_date_intern_selection_steps' => $request->estimated_start_date_intern_selection_steps,
            'estimated_end_date_intern_selection_steps' => $request->estimated_end_date_intern_selection_steps,
        ];

        // Update model
        $internSelectionStep->update($dataToUpdate);

        // Log aktivitas dengan data yang sama
        $this->logUserActivity(
            'Internship Selection Step Updated',
            "Updated Intern Selection Step with ID {$internSelectionStep->id}",
            auth()->id(),
            $internSelectionStep,  // kirim objek model sebagai subject
            $dataToUpdate
        );

        return redirect()->route('internship-offering.selection-steps.index', ['id' => $internSelectionStep->intern_position_batch_id])
            ->with('success', 'Selection step updated successfully.');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $internSelectionStep = InternSelectionStep::findOrFail($id);
            $internSelectionStep->delete();

            $this->logUserActivity(
                'Internship Selection Step Deleted',
                "Deleted Intern Selection Step with ID {$internSelectionStep->id}",
                auth()->id(),
                $internSelectionStep
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Selection step deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete selection step.']);
        }
    }
}
