<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use Exception;
class ConfigurationController extends Controller
{
    public function report(){
        $reports = Configuration::all();
        return response()->json(["message"=>$reports]);
    }

    public function create(Request $request){
      
        try{
        $report = Configuration::create([
            'value'=>$request->value,
            'description'=>$request->description,
            'type'=>$request->type,
            'config'=>$request->config,
            'affected_data'=>$request->affected_data,
            'time'=>$request->time,
            'status'=>$request->status
        ]);
       
        return response()->json(["message"=>$report]);
    }
    catch(Exception $e){
        return response()->json(['status' => 0, 'message' => 'User registration failed', "Exception" => $e->getMessage()], 500);
    }
    }

    public function update(Request $request, $id){
       
        try{
        $report = Configuration::find($id);
        $report->update([
          'value'=>$request->value,
          'description'=>$request->description,
          'type'=>$request->type,
          'config'=>$request->config,
          'affected_data'=>$request->affected_data,
          'time'=>$request->time,
          'status'=>$request->status
        ]);
        return response()->json(["message"=>$report]);
    }
    catch(Exception $e){
        return response()->json(['status' => 0, 'message' => 'User registration failed', "Exception" => $e->getMessage()], 500);
    }
    }

    public function delete($id){
        $report = Configuration::find($id);
        $report->delete();
        return response()->json(["message"=>"deleted"]);
    }
}
