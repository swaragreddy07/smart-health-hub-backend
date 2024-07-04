<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseData;
use Exception;
class ExerciseDataController extends Controller
{
    public function store(Request $request){
        try{
        $request->validate([
          "user_id"=>"required",
          "date"=>"required",
          "category"=>"required",
          "calories"=>"required",
        ]);

        
        $check = ExerciseData::where('date',$request->date)->where('category', $request->category)->where('user_id', $request->user_id)->get();
        if ($check->isEmpty()) {
        $sign = ExerciseData::create([
            "user_id"=>$request->user_id,
            "date"=>$request->date,
            "category"=>$request->category,
            "calories"=>$request->calories,
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
  
        $sign = ExerciseData::where('user_id', $request->user_id)->get();
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
            "calories"=>"required",
            "user_id"=>"required",
          ]);
        $sign = ExerciseData::where('date', $request->date)
        ->where("category", $request->category)
        ->where('user_id', $request->user_id)
        ->first();
        if($sign){
          $sign->calories = $request->calories;
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
