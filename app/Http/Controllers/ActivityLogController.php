<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:log-activity.index')->only('index', 'list');
        $this->middleware('permission:log-activity.create')->only('create', 'store');
        $this->middleware('permission:log-activity.edit')->only('edit', 'update');
        $this->middleware('permission:log-activity.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $activityLog = DB::table('activity_logs')
                ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
                ->select('activity_logs.id', 'activity_logs.activity', 'activity_logs.date', 'activity_logs.time', 'users.name as nameUsers')
                ->orderBy('activity_logs.date', 'desc')
                ->orderBy('activity_logs.time', 'desc');

            return DataTables::of($activityLog)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('settings.activity-log.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activityLog = ActivityLog::with('user')->find($id);
        return view('settings.activity-log.show', compact('activityLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityLog $activityLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivityLog $activityLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityLog $activityLog)
    {
        //
    }
}
