<?php

namespace App\Http\Controllers;

use App\Models\InternMentor;
use App\Http\Requests\StoreInternMentorRequest;
use App\Http\Requests\UpdateInternMentorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\ActivityLogHelper;
use Illuminate\Support\Facades\Hash;

class InternMentorController extends Controller
{
    use ActivityLogHelper;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:mentor.index')->only('index', 'list');
        $this->middleware('permission:mentor.create')->only('create', 'store');
        $this->middleware('permission:mentor.edit')->only('edit', 'update');
        $this->middleware('permission:mentor.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $mentors = DB::table('intern_mentors')
                ->leftJoin('users', 'intern_mentors.user_id', '=', 'users.id')
                ->leftJoin('departments', 'intern_mentors.department_id', '=', 'departments.id')
                ->select('intern_mentors.id', 'intern_mentors.name_intern_mentors', 'intern_mentors.status_intern_mentors', 'departments.name_departments as department');

            return DataTables::of($mentors)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('intern-mentors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = DB::table('departments')->where('status_departments', 'active')->select('id', 'name_departments');
        return view('intern-mentors.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternMentorRequest $request)
    {
        $user = User::create([
            'name' => $request->input('nickname_intern_mentors'),
            'email' => $request->input('email_intern_mentors'),
            'password' => Hash::make($request->input('password_intern_mentors'))
            // Ganti default password sesuai kebutuhan
        ]);

        $user->assignRole('mentor');

        $profilePath = null;
        if ($request->hasFile('profile_picture_intern_mentors')) {
            $profilePath = $request->file('profile_picture_intern_mentors')->store('mentors', 'public');
        }
        $mentor = InternMentor::create(array_merge(
            $request->validated(),
            [
                'profile_picture_intern_mentors' => $profilePath,
                'user_id' => $user->id,
            ]
        ));

        $this->logUserActivity(
            'Intern Mentor Created',
            "Created mentor with ID {$mentor->id}",
            auth()->id(),
            $mentor
        );

        return redirect()->route('mentor.index')->with('success', 'Mentor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $internMentor = InternMentor::with('department', 'user')->findOrFail($id);
        return view('intern-mentors.show', compact('internMentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departments = DB::table('departments')->where('status_departments', 'active')->select('id', 'name_departments');
        $internMentor = InternMentor::with('department', 'user')->findOrFail($id);

        return view('intern-mentors.edit', compact('internMentor', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternMentorRequest $request, $id)
    {
        $internMentor = InternMentor::findOrFail($id);

        // Update related User data
        if ($internMentor->user) {
            $internMentor->user->update([
                'name' => $request->input('name_intern_mentors'),
                'email' => $request->input('email_intern_mentors'),
            ]);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture_intern_mentors')) {
            $profilePath = $request->file('profile_picture_intern_mentors')->store('mentors', 'public');
            $internMentor->profile_picture_intern_mentors = $profilePath;
        }

        // Prepare data to update mentor (excluding profile picture handled separately)
        $dataToUpdate = [
            'name_intern_mentors' => $request->input('name_intern_mentors'),
            'email_intern_mentors' => $request->input('email_intern_mentors'),
            'position_title_intern_mentors' => $request->input('position_title_intern_mentors'),
            'status_intern_mentors' => $request->input('status_intern_mentors'),
            'department_id' => $request->input('department_id'),
            'bio_intern_mentors' => $request->input('bio_intern_mentors'),
            'phone_intern_mentors' => $request->input('phone_intern_mentors'),
        ];

        // Update mentor data
        $internMentor->update($dataToUpdate);

        // Save profile picture update if any
        if ($request->hasFile('profile_picture_intern_mentors')) {
            $internMentor->save();
        }

        // Log activity
        $this->logUserActivity(
            'Intern Mentor Updated',
            "Updated mentor with ID {$internMentor->id}",
            auth()->id(),
            $internMentor,
            $dataToUpdate
        );

        return redirect()->route('mentor.index')->with('success', 'Mentor updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $internMentor = InternMentor::findOrFail($id);
            $internMentor->delete();

            $this->logUserActivity(
                'Intern Mentor Deleted',
                "Deleted mentor with ID {$internMentor->id}",
                auth()->id(),
                $internMentor
            );
            return response()->json([
                'success' => true,
                'message' => 'Mentor deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete mentor. Please try again later.'
            ]);
        }
    }
}
