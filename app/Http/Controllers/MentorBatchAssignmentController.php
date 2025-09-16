<?php

namespace App\Http\Controllers;

use App\Models\InternMentor;
use App\Models\InternPositionBatche;
use App\Models\MentorBatchAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Yajra\DataTables\Facades\DataTables;

class MentorBatchAssignmentController extends Controller
{
    use ActivityLogHelper;
    public function list($id)
    {
        $MentorBatchAssignment = DB::table('mentor_batch_assignments')
            ->leftJoin('intern_mentors', 'mentor_batch_assignments.intern_mentor_id', '=', 'intern_mentors.id')
            ->leftJoin('intern_position_batches', 'mentor_batch_assignments.intern_position_batch_id', '=', 'intern_position_batches.id')
            ->leftJoin('intern_positions', 'intern_position_batches.intern_position_id', '=', 'intern_positions.id')
            ->leftJoin('intern_locations', 'intern_position_batches.intern_location_id', '=', 'intern_locations.id')
            ->leftJoin('intern_batches', 'intern_position_batches.intern_batch_id', '=', 'intern_batches.id')

            ->where('intern_mentor_id', '=', $id)
            ->select(
                'mentor_batch_assignments.id',
                'intern_locations.intern_location_name',
                DB::raw("CONCAT(intern_positions.name_intern_positions, ' - ', intern_batches.name_intern_batches) as intern_position_batch"),
                'mentor_batch_assignments.status_mentor_batch_assignments'
            );

        return DataTables::of($MentorBatchAssignment)
            ->addIndexColumn()
            ->make(true);
    }
    public function index($id)
    {
        $mentors = DB::table('intern_mentors')->find($id);
        return view('mentors-batch-assignment.index', compact('mentors'));
    }

    public function create($id)
    {
        $mentor = InternMentor::with('department')->findOrFail($id);

        // Ambil semua intern position batch (bisa difilter)
        $positionBatches = InternPositionBatche::with(['internPosition.department'])
            ->where('status_intern_position_batches', 'active')
            ->get();
        $isEmptyBatch = $positionBatches->isEmpty();
        return view('mentors-batch-assignment.create', compact('mentor', 'positionBatches', 'isEmptyBatch'));
    }

    public function store(Request $request, $id)
    {
        $mentor = InternMentor::with('department')->findOrFail($id);
        $positionBatch = InternPositionBatche::with('internPosition.department')->findOrFail($request->intern_position_batch_id);

        $isCrossDepartment = $mentor->department_id !== $positionBatch->internPosition->department_id;

        // Validasi dasar
        $rules = [
            'intern_position_batch_id' => 'required|exists:intern_position_batches,id',
            'status_mentor_batch_assignments' => 'required|in:active,inactive,resigned,on_leave',
        ];

        // Jika lintas divisi, note wajib
        if ($isCrossDepartment) {
            $rules['note_mentor_batch_assignments'] = 'required|string|min:10|max:10000';
        }

        $request->validate($rules, [
            'note_mentor_batch_assignments.required' => 'Karena ini lintas divisi, kolom catatan wajib diisi.',
        ]);

        // Cek apakah sudah pernah assign
        $existing = MentorBatchAssignment::where('intern_mentor_id', $mentor->id)
            ->where('intern_position_batch_id', $positionBatch->id)
            ->first();

        if ($existing) {
            return back()->withErrors('Mentor sudah di-assign ke batch ini sebelumnya.');
        }

        $mentorBatchAssignment = MentorBatchAssignment::create([
            'intern_mentor_id' => $mentor->id,
            'intern_position_batch_id' => $positionBatch->id,
            'status_mentor_batch_assignments' => $request->status_mentor_batch_assignments,
            'note_mentor_batch_assignments' => $request->note_mentor_batch_assignments,
        ]);

        $this->logUserActivity(
            'Mentor Batch Assignment Created',
            "Created mentor batch assignment with ID {$mentor->id}",
            auth()->id(),
            $mentorBatchAssignment
        );

        return redirect()->route('mentor.batch.assignment.index', $mentor->id)
            ->with('success', 'Mentor berhasil di-assign ke batch.');
    }

    public function show($id)
    {
        $mentorBatchAssignment = MentorBatchAssignment::with([
            'internMentor.department',
            'internPositionBatch.internPosition.department'
        ])->findOrFail($id);

        return view('mentors-batch-assignment.show', compact('mentorBatchAssignment'));
    }


    public function edit($mentorId, $assignmentId)
    {
        $mentor = InternMentor::with('department')->findOrFail($mentorId);
        $assignment = MentorBatchAssignment::with('internPositionBatch.internPosition.department')->findOrFail($assignmentId);

        // Ambil semua intern position batch (misalnya ingin bisa ubah ke batch lain)
        $positionBatches = InternPositionBatche::with('internPosition.department')
            ->where('status_intern_position_batches', 'active')
            ->get();

        return view('mentors-batch-assignment.edit', compact('mentor', 'assignment', 'positionBatches'));
    }

    public function update(Request $request, $mentorId, $assignmentId)
    {
        $mentor = InternMentor::with('department')->findOrFail($mentorId);
        $assignment = MentorBatchAssignment::findOrFail($assignmentId);

        $positionBatch = InternPositionBatche::with('internPosition.department')->findOrFail($request->intern_position_batch_id);

        $isCrossDepartment = $mentor->department_id !== $positionBatch->internPosition->department_id;

        // Validasi
        $rules = [
            'intern_position_batch_id' => 'required|exists:intern_position_batches,id',
            'status_mentor_batch_assignments' => 'required|in:active,inactive,resigned,on_leave',
        ];

        if ($isCrossDepartment) {
            $rules['note_mentor_batch_assignments'] = 'required|string|min:10|max:10000';
        }

        $request->validate($rules, [
            'note_mentor_batch_assignments.required' => 'Karena ini lintas divisi, kolom catatan wajib diisi.',
        ]);

        // Cek jika ganti batch, pastikan tidak duplikat
        if ($assignment->intern_position_batch_id != $request->intern_position_batch_id) {
            $exists = MentorBatchAssignment::where('intern_mentor_id', $mentor->id)
                ->where('intern_position_batch_id', $request->intern_position_batch_id)
                ->first();

            if ($exists) {
                return back()->withErrors('Mentor sudah di-assign ke batch ini sebelumnya.');
            }
        }

        // Update data
        $assignment->update([
            'intern_position_batch_id' => $request->intern_position_batch_id,
            'status_mentor_batch_assignments' => $request->status_mentor_batch_assignments,
            'note_mentor_batch_assignments' => $request->note_mentor_batch_assignments,
        ]);

        $this->logUserActivity(
            'Mentor Batch Assignment Updated',
            "Updated mentor batch assignment ID {$assignment->id}",
            auth()->id(),
            $assignment
        );

        return redirect()->route('mentor.batch.assignment.index', $mentor->id)
            ->with('success', 'Assignment mentor berhasil diperbarui.');
    }

    public function destroy($mentorId, $assignmentId)
    {
        DB::beginTransaction();

        try {
            $assignment = MentorBatchAssignment::findOrFail($assignmentId);
            $assignment->delete();

            $this->logUserActivity(
                'Mentor Batch Assignment Deleted',
                "Deleted mentor batch assignment ID {$assignment->id}",
                auth()->id(),
                $assignment
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Assignment mentor berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal menghapus assignment mentor.']);
        }
    }
}
