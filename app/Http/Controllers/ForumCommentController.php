<?php

namespace App\Http\Controllers;

use App\Models\ForumComment;
use Illuminate\Http\Request;
use Exception;

class ForumCommentController extends Controller
{

    public function index(){
      try{
      $comments = ForumComment::with(['user'])->orderBy('created_at', 'desc')->get();
      return response()->json(["comments"=>$comments],201);
      }
      catch(Exception $e){
        return response()->json(["error"=>$e],500);
      }
    }

    public function store(Request $request)
    {
        $request->validate([
            "user_id"=> "required",
            "post_id"=> "required",
            "content"=> "required",
        ]);
        
        $comment = ForumComment::create([
          'post_id'=>$request->post_id,
          'user_id'=>$request->user_id,
          'content'=>$request->content,
          'post_date_time'=>date('Y-m-d H:i:s')
        ]);
         
        return response()->json(["comment"=>$comment],201);

    }

    public function edit(ForumComment $comment)
    {
        return view('forum.edit_comment', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = ForumComment::find($id);
        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json(["comment"=>$comment]);
    }

    public function destroy($id)
    {
       ForumComment::where('comment_id', $id)->delete();
       return response()->json(["message"=>"comment deleted successfully"]);
    }
}
