<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
class AppointmentController extends Controller
{
    
    public function index(Request $request)
    {
        $userId = $request->input('user_id');
    
        if (!$userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }
    
        // Retrieve appointments for the specified user
        $user = User::find($userId);
        if($user->role_id == 1){
        $appointments = Appointment::where('user_id', $userId)
        ->where('appointment_date', '>=', now()) // '>= current(date)' corrected to '>= now()'
        ->get();}
        
    
        // Extract provider IDs from appointments
        $providerIds = $appointments->pluck('provider_id')->unique();
    
        // Retrieve provider details for each provider ID
        $providers = User::whereIn('user_id', $providerIds)->get();
    
        // Map provider details to appointments
        $appointmentsWithProviderDetails = $appointments->map(function ($appointment) use ($providers) {
            $provider = $providers->firstWhere('user_id', $appointment->provider_id);
            $appointment->provider = $provider; // Add provider details to appointment object
            return $appointment;
        });
    
        return response()->json(['appointments' => $appointmentsWithProviderDetails], 200);
    }
    

   public function availability(Request $request){
    $request->validate([
      "provider_id"=> "required",
      "time" =>"required",
      "date" =>"required",
      "user_id" => "required",
    ]);
    try{

        $appointments = Appointment::where('provider_id', $request->provider_id)
        ->whereDate('appointment_date', $request->date)
        ->whereRaw('ADDTIME(appointment_time, "01:00:00") >= ?', [$request->time])
        ->get();

        $appointment = Appointment::where('provider_id', $request->provider_id)
        ->where('user_id', $request->user_id)
        ->whereDate('appointment_date', '>', now()) // Check if appointment date is greater than current date
        ->orWhere(function ($query) use ($request) {
            $query->whereDate('appointment_date', '=', now()) // Check if appointment date is equal to current date
                ->whereTime('appointment_time', '>', now()->format('H:i:s')); // Check if appointment time is greater than current time
        })
        ->get();
    
    

if ($appointments->isEmpty() && $appointment->isEmpty() ) {
   return response()->json(["message"=>"no appointments found"], 201);
} else if(!$appointment->isEmpty()){
    return response()->json(["message"=>"you already have an upcoming appointment with the selected doctor"], 201);
}else{
    return response()->json(["message"=>"Please select another date or time as the selected doctor has some other appointments"], 201);
}
    }
    catch(Exception $e){
        return response()->json(["message"=>$e], 500);
    }
   }


   
public function getcount(Request $request)
{
    // Retrieve the count of appointments grouped by date and provider_id
    $provider_id = $request->provider_id;

$appointmentsCountByDateAndProvider = Appointment::select(DB::raw('DATE(appointment_date) as date'), 'provider_id', DB::raw('COUNT(*) as count'))
    ->where('provider_id', $provider_id)
    ->groupBy(DB::raw('DATE(appointment_date)'), 'provider_id')
    ->get();


    return response()->json([
        'appointments_count_by_date_and_provider' => $appointmentsCountByDateAndProvider
    ], 200);
}

    public function gethealcareproviderappointments(Request $request)
    {
        $userId = $request->input('provider_id');
    
        if (!$userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }
    
        // Retrieve appointments for the specified user
        $appointments = Appointment::where('provider_id', $userId)
                           ->get();
    
        // Extract provider IDs from appointments
        $providerIds = $appointments->pluck('user_id')->unique();
    
        // Retrieve provider details for each provider ID
        $providers = User::whereIn('user_id', $providerIds)->get();
    
        // Map provider details to appointments
        $appointmentsWithProviderDetails = $appointments->map(function ($appointment) use ($providers) {
            $provider = $providers->firstWhere('user_id', $appointment->user_id);
            $appointment->provider = $provider; // Add provider details to appointment object
            return $appointment;
        });
    
        return response()->json(['appointments' => $appointmentsWithProviderDetails], 200);
    }





    public function store(Request $request)
    {
        // Validate request data
        try{
        $request->validate([
            'user_id' => 'required|exists:dbt_user,user_id', // Keep 'user_id' if it matches your column name
            'appointment_date' => 'required|date',
        ]);

       
        // Create new appointment
        $appointment = Appointment::create($request->all());

        // Return response
        return response()->json(['appointment' => $appointment], 201);
        }
        catch(Exception $e){
            return response()->json(['eroor' => $e->getMessage()]);
        }
    }





    
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Update appointmen

        // Return response
       

            $appointments = Appointment::where('provider_id', $request->provider_id)
            ->whereDate('appointment_date', $request->date)
            ->whereRaw('ADDTIME(appointment_time, "01:00:00") >= ?', [$request->time]) 
            ->get();
    
            $appointment_doctor = Appointment::where('provider_id', $request->provider_id)
            ->where('user_id', $appointment->user_id)
            ->whereDate('appointment_date', '>', now()) // Check if appointment date is greater than current date
            ->orWhere(function ($query) use ($request) {
                $query->whereDate('appointment_date', '=', now()) // Check if appointment date is equal to current date
                    ->whereTime('appointment_time', '>', now()->format('H:i:s')); // Check if appointment time is greater than current time
            })
            ->get();
        
        
            try{
           if ($appointments->count() <=1 && $appointment_doctor->count()<=1 ) {
                $appointment->update($request->all());
                return response()->json(["message"=>"successfully updated"], 201);
            } 
            else if($appointments->count() > 1){
            return response()->json(["message"=>"you already have an upcoming appointment with the selected doctor"], 201);
            }
            else{
            return response()->json(["message"=>"Please select another date or time as the selected doctor has some other appointments"], 201);
            }
        
        }
        catch(Exception $e){
            return response()->json(["message"=>$e], 500);
        }
    }
    

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Delete appointment
        $appointment->delete();

        // Return response
        return response()->json(['message' => 'Appointment deleted'], 200);
    }

    
}
