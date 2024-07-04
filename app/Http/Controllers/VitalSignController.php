<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\VitalSign;
use Carbon\Carbon;
use Exception;

class VitalSignController extends Controller
{
    public function store(Request $request){
        try{
        $request->validate([
          "user_id"=>"required",
          "date"=>"required",
          "category"=>"required",
          "value"=>"required",
        ]);

        
        $check = VitalSign::where('date',$request->date)->where('category', $request->category)->where('user_id', $request->user_id)->get();
        if ($check->isEmpty()) {
        $sign = VitalSign::create([
            "user_id"=>$request->user_id,
            "date"=>$request->date,
            "category"=>$request->category,
            "value"=>$request->value,
        ]);
        return response()->json(["message"=>$sign]);
    }
    else{
        return response()->json(["message"=>1]);
    }
    }
    catch(Exception $e){
      return response()->json(["message"=>$e->getMessage()]);
    }
    }

    public function index(Request $request){
        try{
        $request->validate([
            "user_id"=>"required"
          ]);
  
        $sign = VitalSign::where('user_id', $request->user_id)->get();
        return response()->json(["sign"=>$sign]);
        }
        catch(Exception $e){
            return response()->json(["message"=>$e->getMessage()]);
          }
    }


    public function update(Request $request){
      try{
        $request->validate([
            "date"=>"required",
            "category"=>"required",
            "value"=>"required",
            "user_id"=>"required",
      
          ]);
        $sign = VitalSign::where('date', $request->date)
        ->where("category", $request->category)
        ->where('user_id', $request->user_id)
        ->first();
        if($sign){
          $sign->value = $request->value;
          $sign->save();
          return response()->json(["message"=>"success update"]);
        }
        else{
          return response()->json(["message"=>1]);
        }}
        catch(Exception $e){
          return response()->json(["message"=>$e->getMessage()]);
        }
      }

}