<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInternLocationRequest;
use App\Http\Requests\UpdateInternLocationRequest;
use App\Models\InternLocation;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Nnjeim\World\Models\Country;
use Nnjeim\World\World;
use Yajra\DataTables\Facades\DataTables;

class InternLocationController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:intern-locations.index')->only('index', 'list');
        $this->middleware('permission:intern-locations.create')->only('create', 'store');
        $this->middleware('permission:intern-locations.edit')->only('edit', 'update');
        $this->middleware('permission:intern-locations.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $internLocations = DB::table('intern_locations')
                ->select('id', 'intern_location_name', 'intern_location_address', 'intern_location_type', 'intern_location_status');

            return DataTables::of($internLocations)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('intern-locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $province = Province::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();

        return view('intern-locations.create', compact('province', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternLocationRequest $request)
    {
        $internLocation = InternLocation::create($request->validated());

        $this->logUserActivity(
            'Intern Location Created',
            "Created new intern location with ID {$internLocation->id}",
            auth()->id(),
            $internLocation
        );

        return redirect()->route('intern-locations.index')->with('success', 'Intern Location Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $internLocation = InternLocation::findOrFail($id);
        return view('intern-locations.show', compact('internLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $province = Province::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();
        $internLocation = InternLocation::findOrFail($id);
        return view('intern-locations.edit', compact('internLocation', 'province', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternLocationRequest $request, $id)
    {
        $internLocation = InternLocation::findOrFail($id);
        $internLocation->update($request->validated());

        $this->logUserActivity(
            'Intern Location Updated',
            "Updated intern location with ID {$internLocation->id}",
            auth()->id(),
            $internLocation
        );

        return redirect()->route('intern-locations.index')->with('success', 'Intern Location Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $internLocation = InternLocation::findOrFail($id);
            $internLocation->delete();

            $this->logUserActivity(
                'Intern Location Deleted',
                "Deleted intern location with ID {$internLocation->id}",
                auth()->id(),
                $internLocation
            );

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Intern Location Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete the intern location. Please try again later.']);
        }
    }
}
