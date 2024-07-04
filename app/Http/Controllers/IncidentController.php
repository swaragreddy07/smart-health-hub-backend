<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\User;
use Exception;

use function PHPUnit\Framework\isEmpty;

class IncidentController extends Controller
{
        public function index(){
            $facility = Incident::all();
            return response()->json(["message"=>$facility]);
            }
        
         public function store(Request $request){
                try {
                $request->validate([
                  
                    'incident_time'=>"required",
                     'description' => "required", 
                     'email' => "required",
                     'status' =>"required"
                ]);
        
            }catch(Exception $e){
                return response()->json(["error"=>$e->getMessage()]);
            }
                
                try{
                    $user = User::where('email' , $request->email)->first();
                    if($user == null){
                        return response()->json(["message"=>1]);
                    }
                    $role = "";
                    if($user->role_id == 1){
                        $role="patient";
                    }
                    else if($user->role_id == 2){
                        $role="doctor";
                    }
                    else if($user->role_id == 3){
                        $role="admin";
                    }
                    else if($user->role_id == 4){
                        $role="pharmacist";
                    }
                    else{
                        $role="health admin";
                    }
                    $compliance = Incident::create([
                       
                        'incident_time'=>$request->incident_time,
                         'description' => $request->description, 
                         'email' => $request->email,
                         'role' =>$role, 
                         'status' =>$request->status,
                    ]);
        
                    return response()->json(["message"=>$compliance]);
                }
                catch(Exception $e){
                    return response()->json(["message"=>$e->getMessage()]);
                }
            }
           
          public function delete($id){
            $facility = Incident::find($id);
            $facility->delete();
            return response()->json(["message"=>"successfully deleted"]);
          }
        
          public function update(Request $request, $id){
            $request->validate([
               
                'incident_time'=>"required",
                 'description' => "required", 
                 'email' => "required",
                 'status' =>"required"
            ]);
            $facility = Incident::find($id);
            $user = User::where('email' , $request->email)->first();
                    if($user == null){
                        return response()->json(["message"=>1]);
                    }
                    $role = "";
                    if($user->role_id == 1){
                        $role="patient";
                    }
                    else if($user->role_id == 2){
                        $role="doctor";
                    }
                    else if($user->role_id == 3){
                        $role="admin";
                    }
                    else if($user->role_id == 4){
                        $role="pharmacist";
                    }
                    else{
                        $role="health admin";
                    }
            $facility->update([
                
                'incident_time'=>$request->incident_time,
                 'description' => $request->description, 
                 'email' => $request->email,
                 'role' =>$role, 
                 'status' =>$request->status,
            ]);
        
            return response()->json(["message"=>$facility]);
        }
        
}
    
