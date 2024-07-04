<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicationDispensation;

class PrescriptionController extends Controller
{
    public function createPrescription(Request $request)
    {
        // Validate the request
        $provider = User::find($request->user_id);
        $request->validate([
            'provider_id' => 'required|integer',
            'user_id' => 'required|integer',
            "appointment_id"=>"required",
        ]);
        $appointment = Appointment::find($request->appointment_id);
        if($appointment->prescription_given == true){
            return response()->json(["message" =>1]);
        }
        // Create a new prescription
        $prescription = Prescription::create([
            'provider_id' => $request->provider_id,
            'user_id' => $request->user_id,
            'medicines' => json_encode($request->medicines), // Serialize medicines array to JSON

            'frequency' => $request->frequency,
            'summary' => $request->summary,
            'appointment_id'=>$request->appointment_id,
            'provider_name' => $provider->full_name
        ]);

        $appointment = Appointment::find($request->appointment_id);
        $appointment->prescription_given = true;
        $appointment->save();

        // Save medicine details within the prescription record
        // $prescription->update(['medicines' => json_encode($request->medicines)]);

        return response()->json(['message' => 'Prescription created successfully', 'prescription' => $prescription], 201);
    }


    public function getPrescriptionsForProvider(Request $request)
{
    // Validate the request
    $request->validate([
        'provider_id' => 'required|integer',
    ]);

    // Retrieve prescriptions for the given provider_id
    $prescriptions = Prescription::where('provider_id', $request->provider_id)
        ->leftJoin('dbt_user', 'prescriptions.user_id', '=', 'dbt_user.user_id')
        ->select('prescriptions.*','dbt_user.*') // Select only prescription fields
        ->get();

    return response()->json(['prescriptions' => $prescriptions], 200);
}

public function getPrescriptionsForUser(Request $request){
    $request->validate([
        "user_id"=>"required"
    ]);
    $comment = Prescription::where('user_id', $request->user_id)->get();
    return response()->json(["prescription"=>$comment]);
}

public function getPrescriptions(Request $request){
    $request->validate([
        "user_id"=>"required"
    ]);
    $comment = Prescription::where('user_id', $request->user_id)->get();
    return response()->json(["prescription"=>$comment]);
}

public function medication()
    {
        return $this->belongsTo(MedicationDispensation::class, 'prescription_id');
    }



    public function remainder($id){
        $r = Prescription::find($id);
        if($r->remainder == false){
            $r->update([
                "remainder" => true,
            ]);
        }
        else{
            $r->update([
                "remainder" => false,
            ]);
        }
        return response()->json(["message"=>$r]);
    }
}
