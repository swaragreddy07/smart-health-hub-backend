<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PharmacistController; // Add the PharmacistController import
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\ForumCommentController;
use App\Http\Controllers\SymptomCheckerController;
use App\Http\Controllers\ForumTopicsController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\VitalSignController;
use App\Http\Controllers\ExerciseDataController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ComplianceContoller;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ConfigurationController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// new once
Route::put('/remainder/{id}', [PrescriptionController::class, 'remainder']);

Route::post('/register', [UserController::class, 'register']);
Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
Route::get('/patients', [UserController::class, 'getAllUsers']);
Route::get('/patient', [UserController::class, 'getUserData']);
Route::get('/usersdelete', [UserController::class, 'deleteUser']);
Route::post('/updateUserData', [UserController::class, 'updateUserData']);
Route::get('/change', [UserController::class, 'change']);
Route::post('/get', [UserController::class, 'get']);
Route::post('/access', [UserController::class, 'access']);

Route::get('/configi', [ConfigurationController::class, 'report']);
Route::post('/configi', [ConfigurationController::class, 'create']);
Route::put('/configi/{id}', [ConfigurationController::class, 'update']);
Route::delete('/configi/{id}', [ConfigurationController::class, 'delete']);

Route::get('/report', [ReportController::class, 'report']);
Route::post('/report', [ReportController::class, 'create']);
Route::put('/report/{id}', [ReportController::class, 'update']);
Route::delete('/report/{id}', [ReportController::class, 'delete']);

//compliance route
Route::post('/compliance', [ComplianceContoller::class, 'store']);
Route::get('/compliance', [ComplianceContoller::class, 'index']);
Route::delete('/compliance/{id}', [ComplianceContoller::class, 'delete']);
Route::put('/compliance/{id}', [ComplianceContoller::class, 'update']);

//facilities route
Route::post('/facility', [FacilityController::class, 'store']);
Route::get('/facility', [FacilityController::class, 'index']);
Route::delete('/facility/{id}', [FacilityController::class, 'delete']);
Route::put('/facility/{id}', [FacilityController::class, 'update']);

//incident route
Route::post('/incident', [IncidentController::class, 'store']);
Route::get('/incident', [IncidentController::class, 'index']);
Route::delete('/incident/{id}', [IncidentController::class, 'delete']);
Route::put('/incident/{id}', [IncidentController::class, 'update']);
// Removed auth:api middleware from the route group
    Route::post('/appointment', [AppointmentController::class, 'store']);

    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments/availability', [AppointmentController::class, 'availability']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
    Route::get('/gethealcareproviderappointments',[AppointmentController::class,'gethealcareproviderappointments']);
    Route::get('/getcount',[AppointmentController::class,'getcount']);
    Route::post('/dispense-medication', [PharmacistController::class, 'dispenseMedication']);
    Route::get('/notdispense-medication', [PharmacistController::class, 'getPrescriptionsNotDispensed']);
    Route::get('/dispensed-medications', [PharmacistController::class, 'getPrescriptionsDispensed']);
    Route::post('/history', [PharmacistController::class, 'history']);

    Route::post('/doctor', [UserController::class, 'doctor']);
    Route::post('/storedoctor', [UserController::class, 'storedoctor']);
    Route::put('/storedoctor/{id}', [UserController::class, 'updatedoctor']);
    Route::delete('/storedoctor/{id}', [UserController::class, 'deletedoctor']);
    Route::put('/password/{id}', [UserController::class, 'password']);

    Route::post('/alert', [AlertController::class, 'storeAlert']);
    Route::get('/medication-history/{userId}', [PharmacistController::class, 'getMedicationHistory']);
        Route::post('/send-message', [PharmacistController::class, 'sendMessage']);
        Route::get('/messages/{userId}', [PharmacistController::class, 'getMessages']);
        Route::post('/prescriptions', [PrescriptionController::class, 'createPrescription']);
        Route::get('/prescriptions', [PrescriptionController::class, 'getPrescriptionsForProvider']);
        Route::post('/prescriptions/record', [PrescriptionController::class, 'getPrescriptions']);
        Route::post('/prescriptions/user', [PrescriptionController::class, 'getPrescriptionsForUser']);

        Route::get('/patient-health-records', [PatientHealthRecordController::class, 'index']);
        Route::get('/patient-health-records/{id}', [PatientHealthRecordController::class, 'show']);
        Route::post('/patient-health-records', [PatientHealthRecordController::class, 'store']);
        Route::put('/patient-health-records/{id}', [PatientHealthRecordController::class, 'update']);
        Route::delete('/patient-health-records/{id}', [PatientHealthRecordController::class, 'destroy']);
        
        Route::post('/medical', [MedicalHistoryController::class, 'store']);
        Route::get('/medical/{id}', [MedicalHistoryController::class, 'index']);
        // Forum Topics routes
        Route::post('/topics/create', [ForumTopicsController::class, 'create']);
        Route::get('/topics', [ForumTopicsController::class, 'index']);

        Route::post('/sign', [VitalSignController::class, 'store']);
        Route::post('/sign/index', [VitalSignController::class, 'index']);
        Route::post('/sign/update', [VitalSignController::class, 'update']);
        // Forum Post routes
        Route::post('/exercise', [ExerciseDataController::class, 'store']);
        Route::post('/exercise/index', [ExerciseDataController::class, 'index']);
        Route::post('/exercise/update', [ExerciseDataController::class, 'update']);
        
        Route::post('/forum/posts', [ForumPostController::class, 'index']);
        Route::get('/forum/create', [ForumPostController::class, 'create'])->name('forum.create');
        Route::post('/forum', [ForumPostController::class, 'store'])->name('forum.store');
        Route::get('/forum/{post}', [ForumPostController::class, 'show'])->name('forum.post.show');
        Route::get('/forum/{post}/edit', [ForumPostController::class, 'edit'])->name('forum.post.edit');
        Route::put('/forum/{post}', [ForumPostController::class, 'update'])->name('forum.post.update');
        Route::delete('/forum/{post}', [ForumPostController::class, 'destroy'])->name('forum.post.destroy');
        
        // Forum Comment routes
        Route::get('/forum/comment/index', [ForumCommentController::class, 'index'])->name('forum.comment.index');
        Route::post('/forum/comment', [ForumCommentController::class, 'store'])->name('forum.comment.store');
        Route::get('/forum/comment/{comment}/edit', [ForumCommentController::class, 'edit'])->name('forum.comment.edit');
        Route::put('/forum/comment/{comment}', [ForumCommentController::class, 'update'])->name('forum.comment.update');
        Route::delete('/forum/comment/{comment}', [ForumCommentController::class, 'destroy'])->name('forum.comment.destroy');
        

        Route::get('/usersactivate', [UserController::class, 'activateAccount']);
        Route::get('/usersdeactivate', [UserController::class, 'deactivateAccount']);

        Route::group(['prefix' => 'healthcare-providers'], function () {
            Route::get('/', [UserController::class,'getAllHealthcareProviders']);
            Route::get('/user', [UserController::class,'getHealthcareProvider']);
            Route::put('/update', [UserController::class,'updateHealthcareProvider']);
            Route::get('/delete', [UserController::class,'deleteHealthcareProviders']);

        });

        Route::post('/symptom-checker', [SymptomCheckerController::class,'checkSymptoms']);


        