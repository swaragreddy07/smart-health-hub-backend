<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\MedicationDispensation;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;


class PharmacistController extends Controller
{
    public function dispenseMedication(Request $request)
    {
        // Validate the request
        $request->validate([
            'prescription_id' => 'required|exists:prescriptions,prescription_id',
            // 'dispensation_date_time' => 'required|date',
            // Add more validation rules as needed
        ]);

        // Retrieve the prescription details
        
        // Create a new medication dispensation record
        $medicationDispensation = MedicationDispensation::create([
            'prescription_id' => $request->prescription_id,
            'dispensation_date_time' => date('Y-m-d H:i:s'),
            'pharmacist_id' =>$request->pharmacist_id,
            'user_id' => $request->user_id,
            // Add more fields as needed
        ]);

         $pres = Prescription::find($request->prescription_id);
         $user = User::find($pres->user_id);

        // Communicate dispensation information to the patient (e.g., through email, SMS, or platform messaging)
        // Example: sendEmailNotification($prescription, $medicationDispensation);

        return response()->json(['medication_dispensation' => $medicationDispensation], 201);
    }
        public function sendMessage(Request $request)
        {
            // Validate the request
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
                'message' => 'required|string',
            ]);
    
            // Create a new message
            $message = Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);
    
            return response()->json(['message' => 'Message sent successfully', 'data' => $message]);
        }
    
        public function getMessages($userId)
        {
            // Retrieve messages between the authenticated user (pharmacist) and the specified user (patient)
            $messages = Message::where(function ($query) use ($userId) {
                $query->where('sender_id', auth()->id())->where('receiver_id', $userId);
            })->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)->where('receiver_id', auth()->id());
            })->orderBy('created_at')->get();
    
            return response()->json(['messages' => $messages]);
        }
        public function getPrescriptionsNotDispensed()
        {
            // Get prescriptions that are not in the medication_dispensation table
            $prescriptions = Prescription::whereNotIn('prescription_id', function ($query) {
                $query->select('prescription_id')->from('medication_dispensation');
            })->with('user.address', 'provider')->get();
        
    
            return response()->json(['prescriptions' => $prescriptions]);
        }    
        public function getPrescriptionsDispensed()
        {
            // Get prescriptions that have been dispensed
            $dispensedPrescriptions = MedicationDispensation::with('prescription.user', 'prescription.provider')->get();
        
            return response()->json(['dispensedPrescriptions' => $dispensedPrescriptions]);
        }
          
    public function history(Request $request){
        $request->validate([
            "user_id" => "required"
        ]);
        try{
        $history = Prescription::where('user_id', $request->user_id)
                   ->with('medication')
                   ->get();
        return response()->json(["message"=>$history]);
        }
        catch(Exception $e){
            return response()->json(["message"=>$e->getMessage()]);
        }

    }

  
}


