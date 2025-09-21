<?php

namespace App\Http\Controllers;

use App\Models\InternMentor;
use App\Models\InternSelectionStep;
use App\Models\MentorBatchAssignment;
use App\Models\MentorScheduleSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Yajra\DataTables\Facades\DataTables;

class MentorScheduleSlotController extends Controller
{
    use ActivityLogHelper;
    public function index($mentorId, $assignmentId)
    {
        $mentor = InternMentor::with('department')->findOrFail($mentorId);

        $assignment = MentorBatchAssignment::with([
            'internPositionBatch.internPosition.department',
            'internPositionBatch.internBatch',
        ])->findOrFail($assignmentId);

        return view('mentor-schedule-slot.index', compact('mentor', 'assignment'));
    }

    public function list(Request $request, $mentorId, $assignmentId)
    {

        $mentorScheduleSlot = DB::table('mentor_schedule_slots')
            ->leftJoin('intern_selection_steps', 'mentor_schedule_slots.intern_selection_step_id', '=', 'intern_selection_steps.id')
            ->leftJoin('selection_steps', 'intern_selection_steps.selection_step_id', '=', 'selection_steps.id')
            ->where('mentor_schedule_slots.intern_mentor_id', '=', $mentorId)
            ->where('mentor_schedule_slots.mentor_batch_assignments_id', '=', $assignmentId)
            ->select(
                'mentor_schedule_slots.id',
                'selection_steps.name_selection_steps',
                'mentor_schedule_slots.date_mentor_schedule_slots',
                'mentor_schedule_slots.start_time_mentor_schedule_slots',
                'mentor_schedule_slots.end_time_mentor_schedule_slots',
                'mentor_schedule_slots.is_booked_mentor_schedule_slots'
            );
        return DataTables::of($mentorScheduleSlot)
            ->addIndexColumn()
            ->make(true);
    }

    public function create($mentorId, $assignmentId)
    {
        $mentor = InternMentor::findOrFail($mentorId);
        $assignment = MentorBatchAssignment::findOrFail($assignmentId);
        return view('mentor-schedule-slot.create', compact('mentor', 'assignment'));
    }

    public function getStepSelection($assignmentId)
    {
        $assignment = MentorBatchAssignment::findOrFail($assignmentId);

        $selectionSteps = $assignment->internPositionBatch
            ->selectionSteps()
            ->with('selectionStep')
            ->get();

        return response()->json($selectionSteps);
    }

    public function store(Request $request, $mentorId, $assignmentId)
    {
        $request->validate([
            'date_mentor_schedule_slots' => 'required|date',
            'start_time_mentor_schedule_slots' => 'required',
            'end_time_mentor_schedule_slots' => 'required',
            'intern_selection_step_id' => 'required',
            'location_mentor_schedule_slots' => 'nullable',
            'meeting_link_mentor_schedule_slots' => 'nullable',
            'is_booked_mentor_schedule_slots' => 'nullable',
        ]);

        $selectionStep = InternSelectionStep::findOrFail($request->intern_selection_step_id);

        $slotDate = $request->date_mentor_schedule_slots;

        // Pakai Carbon supaya aman bandingkan tanggal
        $slotDateCarbon = \Carbon\Carbon::parse($slotDate);
        $startDate = \Carbon\Carbon::parse($selectionStep->estimated_start_date_intern_selection_steps);
        $endDate = \Carbon\Carbon::parse($selectionStep->estimated_end_date_intern_selection_steps);

        // Validasi: harus lebih dari estimated_end_date
        if ($slotDateCarbon->lte($endDate)) {
            return back()->withErrors([
                'date_mentor_schedule_slots' => 'Tanggal slot mentor harus setelah tanggal akhir tahapan seleksi.',
            ])->withInput();
        }


        // Gabungkan data dari form + data dari URL
        $data = $request->all();
        $data['intern_mentor_id'] = $mentorId;
        $data['mentor_batch_assignments_id'] = $assignmentId;

        // Simpan ke database
        $mentorScheduleSlot = MentorScheduleSlot::create($data);

        // Log activity
        $this->logUserActivity(
            'Mentor Schedule Slot Created',
            "Created mentor schedule slot with ID {$mentorScheduleSlot->id}",
            auth()->id(),
            $mentorScheduleSlot
        );

        return redirect()
            ->route('mentor.batch.assignment.slot-empty.index', [$mentorId, $assignmentId])
            ->with('success', 'Mentor Schedule Slot Created Successfully');
    }

    public function edit($mentorId, $assignmentId, $slotId)
    {
        $mentor = InternMentor::findOrFail($mentorId);
        $assignment = MentorBatchAssignment::findOrFail($assignmentId);
        $slot = MentorScheduleSlot::findOrFail($slotId);

        // Pastikan slot memang terkait dengan mentor dan assignment yang sesuai (opsional, tapi disarankan)
        if ($slot->intern_mentor_id != $mentorId || $slot->mentor_batch_assignments_id != $assignmentId) {
            abort(404);
        }

        return view('mentor-schedule-slot.edit', compact('mentor', 'assignment', 'slot'));
    }

    public function update(Request $request, $mentorId, $assignmentId, $slotId)
    {
        $request->validate([
            'date_mentor_schedule_slots' => 'required|date',
            'start_time_mentor_schedule_slots' => 'required',
            'end_time_mentor_schedule_slots' => 'required',
            'intern_selection_step_id' => 'required',
            'location_mentor_schedule_slots' => 'nullable',
            'meeting_link_mentor_schedule_slots' => 'nullable',
            'is_booked_mentor_schedule_slots' => 'nullable',
        ]);

        $slot = MentorScheduleSlot::findOrFail($slotId);

        // Pastikan slot memang terkait dengan mentor dan assignment yang sesuai (opsional)
        if ($slot->intern_mentor_id != $mentorId || $slot->mentor_batch_assignments_id != $assignmentId) {
            return redirect()->route('mentor.batch.assignment.slot-empty.index', [$mentorId, $assignmentId])->with('error', 'Slot tidak ditemukan.');
        }

        $selectionStep = InternSelectionStep::findOrFail($request->intern_selection_step_id);

        $slotDate = $request->date_mentor_schedule_slots;

        $slotDateCarbon = \Carbon\Carbon::parse($slotDate);
        $startDate = \Carbon\Carbon::parse($selectionStep->estimated_start_date_intern_selection_steps);
        $endDate = \Carbon\Carbon::parse($selectionStep->estimated_end_date_intern_selection_steps);

        // Validasi: harus lebih dari estimated_end_date
        if ($slotDateCarbon->lte($endDate)) {
            return back()->withErrors([
                'date_mentor_schedule_slots' => 'Tanggal slot mentor harus setelah tanggal akhir tahapan seleksi.',
            ])->withInput();
        }

        // Update data slot
        $slot->update($request->all());

        // Log activity
        $this->logUserActivity(
            'Mentor Schedule Slot Updated',
            "Updated mentor schedule slot with ID {$slot->id}",
            auth()->id(),
            $slot
        );

        return redirect()
            ->route('mentor.batch.assignment.slot-empty.index', [$mentorId, $assignmentId])
            ->with('success', 'Mentor Schedule Slot Updated Successfully');
    }

    public function destroy($mentorId, $assignmentId, $slotId)
    {
        DB::beginTransaction();

        try {
            $slot = MentorScheduleSlot::findOrFail($slotId);

            // Validasi relasi mentor dan assignment
            if ($slot->intern_mentor_id != $mentorId || $slot->mentor_batch_assignments_id != $assignmentId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Slot tidak ditemukan atau tidak valid.'
                ]);
            }

            $slot->delete();

            $this->logUserActivity(
                'Mentor Schedule Slot Deleted',
                "Deleted mentor schedule slot with ID {$slot->id}",
                auth()->id(),
                $slot
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Mentor Schedule Slot Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the mentor schedule slot. Please try again later.'
            ]);
        }
    }
}
