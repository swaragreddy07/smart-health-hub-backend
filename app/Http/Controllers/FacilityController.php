<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use Exception;


class FacilityController extends Controller
{
    public function index(){
    $facility = Facility::all();
    return response()->json(["message"=>$facility]);
    }

    public function store(Request $request){
        try {
        $request->validate([
            'name'=>"required",
            'street'=>"required",
             'city' => "required", 
             'state' => "required",
             'zipcode' =>"required", 
             'operational_status' =>"required",
        ]);

    }catch(Exception $e){
        return response()->json(["error"=>$e->getMessage()]);
    }
        
        try{
            $facility = Facility::create([
                'name'=>$request->name,
                'street'=>$request->street,
                'city' => $request->city, 
                'state' => $request->state, 
                'zipcode' =>$request->zipcode, 
                'primary_care' => $request->primary_care,
                'special_care' => $request->special_care,
                'emergency_care' => $request->emergency_care,
                'diagnostic_service' => $request->diagnostic_service,
                'operational_status' =>$request->operational_status
            ]);

            return response()->json(["message"=>$facility]);
        }
        catch(Exception $e){
            return response()->json(["message"=>$e->getMessage()]);
        }
    }
   
  public function delete($id){
    $facility = Facility::find($id);
    $facility->delete();
    return response()->json(["message"=>"successfully deleted"]);
  }

  public function update(Request $request, $id){
    $request->validate([
        'name'=>"required",
        'street'=>"required",
         'city' => "required", 
         'state' => "required",
         'zipcode' =>"required", 
         'operational_status' =>"required",
    ]);
    $facility = Facility::find($id);
    $facility->update([
        'name'=>$request->name,
        'street'=>$request->street,
        'city' => $request->city, 
        'state' => $request->state, 
        'zipcode' =>$request->zipcode, 
        'primary_care' => $request->primary_care,
        'special_care' => $request->special_care,
        'emergency_care' => $request->emergency_care,
        'diagnostic_service' => $request->diagnostic_service,
        'operational_status' =>$request->operational_status
    ]);

    return response()->json(["message"=>$facility]);
}

}
