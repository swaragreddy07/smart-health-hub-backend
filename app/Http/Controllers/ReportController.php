<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Exception;
class ReportController extends Controller
{
    public function report(){
        $reports = Report::all();
        return response()->json(["message"=>$reports]);
    }

    public function create(Request $request){
      
        try{
        $report = Report::create([
          'title'=>$request->title,
          'description'=>$request->description,
          'type'=>$request->type,
        ]);
       
        return response()->json(["message"=>$report]);
    }
    catch(Exception $e){
        return response()->json(['status' => 0, 'message' => 'User registration failed', "Exception" => $e->getMessage()], 500);
    }
    }

    public function update(Request $request, $id){
       
        try{
        $report = Report::find($id);
        $report->update([
          'title'=>$request->title,
          'description'=>$request->description,
          'type'=>$request->type,
        ]);
        return response()->json(["message"=>$report]);
    }
    catch(Exception $e){
        return response()->json(['status' => 0, 'message' => 'User registration failed', "Exception" => $e->getMessage()], 500);
    }
    }

    public function delete($id){
        $report = Report::find($id);
        $report->delete();
        return response()->json(["message"=>"deleted"]);
    }
}
