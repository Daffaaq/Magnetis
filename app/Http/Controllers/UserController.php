<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Events\UserActivityEvent;
use Illuminate\Support\Facades\DB;
use App\Traits\ActivityLogHelper;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ActivityLogHelper;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user.index')->only('index', 'list');
        $this->middleware('permission:user.create')->only('create', 'store');
        $this->middleware('permission:user.edit')->only('edit', 'update');
        $this->middleware('permission:user.destroy')->only('destroy');
    }
    

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $users = DB::table('users')->select('name', 'email', 'id');
            return DataTables::of($users)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        // Emit event setelah berhasil create user
        $this->logUserActivity(
            'User Created',
            "Created new user with ID {$user->id}",
            auth()->id(),
            $user
        );

        return redirect()->route('user.index')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        //mengupdate data user ke database
        $validate = $request->validated();

        $user->update($validate);

        // Emit event setelah berhasil update user
        $this->logUserActivity(
            'User Updated',
            "Updated user with ID {$user->id}",
            auth()->id(),
            $user
        );
        return redirect()->route('user.index')->with('success', 'User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $userId = $user->id;
            //delete data
            $user->delete();

            $this->logUserActivity(
                'User Deleted',
                "Deleted user with ID {$userId}",
                auth()->id(),
                $user
            );
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'User Deleted Successfully'
            ]);
        } catch (\Exception $e) {
            // If there's an error, return a failure response
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the user. Please try again later.'
            ]);
        }
    }
}
