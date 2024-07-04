<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ForumTopics;
use Exception;
class ForumTopicsController extends Controller
{
    public function index(){
      $topics = ForumTopics::orderBy('created_at', 'desc')->get();
      return response()->json(["topics"=>$topics]);
    }

    public function create(Request $request){
        try{
            $request->validate([
                "name" => "required",
                "description" => "required",
                "type" => "required"
            ]);

            $topic = ForumTopics::create([
                'name' => $request->name,
                'description'=>$request->description, 
                'type'=>$request->type, 
                'posts'=>0
            ]);
            return response()->json(["status"=>1, "topic"=>$topic, "message"=>"topic created successfully"],201);
        }
        catch(Exception $e){
            return response()->json(["error"=>$e]);
        }
    }
}
