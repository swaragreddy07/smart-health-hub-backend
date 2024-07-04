<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compliance;
use Exception;
class ComplianceContoller extends Controller
{
    public function index(){
        $facility = Compliance::all();
        return response()->json(["message"=>$facility]);
        }
    
        public function store(Request $request){
            try {
            $request->validate([
                'name'=>"required",
                'description'=>"required",
                 'type' => "required", 
                 'status' => "required",
                 'issue' =>"required", 
            ]);
    
        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()]);
        }
            
            try{
                $compliance = Compliance::create([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'type' => $request->type, 
                    'status' => $request->status, 
                    'issue' =>$request->issue, 
                ]);
    
                return response()->json(["message"=>$compliance]);
            }
            catch(Exception $e){
                return response()->json(["message"=>$e->getMessage()]);
            }
        }
       
      public function delete($id){
        $facility = Compliance::find($id);
        $facility->delete();
        return response()->json(["message"=>"successfully deleted"]);
      }
    
      public function update(Request $request, $id){
        $request->validate([
            'name'=>"required",
            'description'=>"required",
             'type' => "required", 
             'status' => "required",
             'issue' =>"required", 
        ]);
        $facility = Compliance::find($id);
        $facility->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'type' => $request->type, 
            'status' => $request->status, 
            'issue' =>$request->issue, 
        ]);
    
        return response()->json(["message"=>$facility]);
    }
    
}
