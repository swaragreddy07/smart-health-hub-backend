<?php

namespace App\Http\Controllers;
use App\Models\MedicalHistory;
use App\Models\User;
use Exception;
use Faker\Provider\Medical;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
   public function store(Request $request){
    try{
     $provider = User::find($request->user_id);
     $request->validate([
        'user_id' =>"required", 
        'provider_id' => "required", 
        'appointment_id'=> "required", 
        'summary' => "required",
        'date'=> "required",
        'medical_condition' =>"required"
     ]);
   $medical = MedicalHistory::create([
    'provider_name' => $provider->full_name,
    'user_id' =>$request->user_id, 
    'provider_id' => $request->provider_id, 
    'appointment_id'=> $request->appointment_id,
    'summary' => $request->summary,
    'date'=> $request->date,
    'medical_condition' =>$request->medical_condition,
   ]);
    return response()->json(["message"=>$medical]);
}
    catch(Exception $e){
        return response()->json(["message"=>$e->getMessage()]);
    }
   }

   public function index($id){
    try{
    $medical = MedicalHistory::where('user_id', $id)->get();
    return response()->json(["message"=>$medical]);
    }
    catch(Exception $e){
        return response()->json(["message"=>$e->getMessage()]);
    }
   }

}
