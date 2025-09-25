<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InternBatcheController;
use App\Http\Controllers\InternLocationController;
use App\Http\Controllers\InternMentorController;
use App\Http\Controllers\InternPositionBatcheController;
use App\Http\Controllers\InternPositionController;
use App\Http\Controllers\InternSelectionStepController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MentorBatchAssignmentController;
use App\Http\Controllers\MentorScheduleSlotController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegistersInternshipController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\SelectionStepController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\UserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Middleware\LogUserLocation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/internship/backend-developer', function () {
    return view('detail-internship');
});
Route::get('/internship-batch/{slug}', [LandingPageController::class, 'detailBatchInternship'])->name('detail-batch-internship');

Route::get('/sertifikat', function () {
    return view('sertifikat');
});

Route::get('/register/thanks', function () {
    return view('auth.thanks');
})->name('register.thanks');

Route::post('/register/candidate-intern', [RegistersInternshipController::class, 'register'])->name('register.candidate-intern');

// Override route login POST Fortify, pakai middleware custom
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(LogUserLocation::class);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('home');
    });

    


    Route::prefix('master-management')->group(function () {
        Route::resource('department', DepartmentController::class);
        Route::post('/department/list', [DepartmentController::class, 'list'])->name('department.list');

        //internship-batch
        Route::resource('internship-batch', InternBatcheController::class);
        Route::post('/internship-batch/list', [InternBatcheController::class, 'list'])->name('internship-batch.list');

        //recruitment-step
        Route::resource('recruitment-step', SelectionStepController::class);
        Route::post('/recruitment-step/list', [SelectionStepController::class, 'list'])->name('recruitment-step.list');

        //intern-position
        Route::resource('intern-position', InternPositionController::class);
        Route::post('/intern-position/list', [InternPositionController::class, 'list'])->name('intern-position.list');

        //intern-locations
        Route::resource('intern-locations', InternLocationController::class);
        Route::post('/intern-locations/list', [InternLocationController::class, 'list'])->name('intern-locations.list');

        //internship-offering
        Route::resource('internship-offering', InternPositionBatcheController::class);
        Route::post('/internship-offering/list', [InternPositionBatcheController::class, 'list'])->name('internship-offering.list');
        Route::get('/internship-offering/intern-selection-steps/{id}', [InternSelectionStepController::class, 'index'])->name('internship-offering.selection-steps.index');
        Route::get('/internship-offering/intern-selection-steps/list/{id}', [InternSelectionStepController::class, 'list'])->name('internship-offering.selection-steps.list');
        Route::get('/internship-offering/intern-selection-steps/create/{id}', [InternSelectionStepController::class, 'create'])->name('internship-offering.selection-steps.create');
        Route::post('/internship-offering/intern-selection-steps/store/{id}', [InternSelectionStepController::class, 'store'])->name('internship-offering.selection-steps.store');
        Route::get('/internship-offering/intern-selection-steps/{internSelectionStep}/show', [InternSelectionStepController::class, 'show'])->name('internship-offering.selection-steps.show');
        Route::get('/internship-offering/intern-selection-steps/{internSelectionStep}/edit', [InternSelectionStepController::class, 'edit'])->name('internship-offering.selection-steps.edit');
        Route::put('/internship-offering/intern-selection-steps/{internSelectionStep}', [InternSelectionStepController::class, 'update'])->name('internship-offering.selection-steps.update');
        Route::delete('/internship-offering/intern-selection-steps/{internSelectionStep}', [InternSelectionStepController::class, 'destroy'])->name('internship-offering.selection-steps.destroy');
    });

    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::post('/user/list', [UserController::class, 'list'])->name('user.list');

        //mentor
        Route::resource('mentor', InternMentorController::class);
        Route::post('/mentor/list', [InternMentorController::class, 'list'])->name('mentor.list');
        Route::get('/mentor/{id}/assign-batch', [MentorBatchAssignmentController::class, 'index'])->name('mentor.batch.assignment.index');
        Route::post('/mentor/{id}/assign-batch/list', [MentorBatchAssignmentController::class, 'list'])->name('mentor.batch.assignment.list');
        Route::get('/mentor/{id}/assign-batch/create', [MentorBatchAssignmentController::class, 'create'])->name('mentor.batch.assignment.create');
        Route::post('/mentor/{id}/assign-batch/store', [MentorBatchAssignmentController::class, 'store'])->name('mentor.batch.assignment.store');
        Route::get('/mentor/assign-batch/{internBatch}/show', [MentorBatchAssignmentController::class, 'show'])->name('mentor.batch.assignment.show');
        Route::get('/mentor/{id}/assign-batch/{internBatch}/edit', [MentorBatchAssignmentController::class, 'edit'])->name('mentor.batch.assignment.edit');
        Route::put('/mentor/{id}/assign-batch/{internBatch}', [MentorBatchAssignmentController::class, 'update'])->name('mentor.batch.assignment.update');
        Route::delete('/mentor/{id}/assign-batch/{internBatch}', [MentorBatchAssignmentController::class, 'destroy'])->name('mentor.batch.assignment.destroy');
        Route::get('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty', [MentorScheduleSlotController::class, 'index'])->name('mentor.batch.assignment.slot-empty.index');
        Route::post('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty/list', [MentorScheduleSlotController::class, 'list'])->name('mentor.batch.assignment.slot-empty.list');
        Route::get('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty/create', [MentorScheduleSlotController::class, 'create'])->name('mentor.batch.assignment.slot-empty.create');
        Route::get('/mentor/assignment/{assignmentId}/steps', [MentorScheduleSlotController::class, 'getStepSelection'])->name('mentor.assignment.selection-steps');
        Route::post('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty/store', [MentorScheduleSlotController::class, 'store'])->name('mentor.batch.assignment.slot-empty.store');
        Route::get('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty/{scheduleSlot}/edit', [MentorScheduleSlotController::class, 'edit'])->name('mentor.batch.assignment.slot-empty.edit');
        Route::put('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty/{scheduleSlot}', [MentorScheduleSlotController::class, 'update'])->name('mentor.batch.assignment.slot-empty.update');
        Route::delete('/mentor/{id}/assign-batch/{internBatch}/add-slot-empty/{scheduleSlot}', [MentorScheduleSlotController::class, 'destroy'])->name('mentor.batch.assignment.slot-empty.destroy');
    });
    Route::prefix('category-management')->group(function () {
        Route::resource('category', CategoryController::class);
    });

    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::post('/menu-group/list', [MenuGroupController::class, 'list'])->name('menu-group.list');

        Route::resource('menu-item', MenuItemController::class);
        Route::post('/menu-item/list', [MenuItemController::class, 'list'])->name('menu-item.list');
    });

    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::post('/role/list', [RoleController::class, 'list'])->name('role.list');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::post('/permission/list', [PermissionController::class, 'list'])->name('permission.list');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');
        Route::post('/assign/list', [AssignPermissionController::class, 'list'])->name('assign.list');
        Route::get('/roles/{role}/permissions', function (Role $role) {
            return response()->json($role->permissions->pluck('name'));
        })->name('roles.permissions');



        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assign-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
        Route::post('/assign-user/list', [AssignUserToRoleController::class, 'list'])->name('assign.user.list');
    });

    Route::prefix('setting-management')->group(function () {
        Route::resource('log-activity', ActivityLogController::class);
        Route::post('/log-activity/list', [ActivityLogController::class, 'list'])->name('log-activity.list');
    });
});

// Pakai {name} bukan {id}
Route::get('/get-regencies/{province_name}', [RegionController::class, 'getRegencies'])->name('region.regencies');
Route::get('/get-districts/{regency_name}', [RegionController::class, 'getDistricts'])->name('region.districts');
Route::get('/get-villages/{district_name}', [RegionController::class, 'getVillages'])->name('region.villages');
