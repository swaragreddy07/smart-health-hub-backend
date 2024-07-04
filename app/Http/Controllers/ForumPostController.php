<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\ForumTopics;
use App\Models\ForumComment;
class ForumPostController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
          "topic_id" => "required",
        ]);
        try{
        $posts = ForumPost::with(['user'])->where('topic_id', $request->topic_id)->orderBy('created_at', 'desc')->get();
        return response()->json(["posts"=>$posts],201);
        }
        catch(Exception $e){
            return response()->json(["posts"=>$e->getMessage()],500);
        }
    }

    public function create()
    {
        return view('forum.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'topic_id' => 'required',
        ]);
        
        try{
        $post = ForumPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'topic_id' => $request->topic_id, 
            'post_date_time'=>date('Y-m-d H:i:s')
        ]);

        $topic = ForumTopics::where('topic_id', $request->topic_id)->first();
        if ($topic) {
            $topic->posts = $topic->posts + 1;
            $topic->save();
        }

        return response()->json(["status"=>"stored successfully", "post"=>$post],201);
        }
        catch(Exception $e){
            return response()->json(["error" => "something went wrong", "exception" => $e->getMessage()], 500);
        }
    }


    public function show(ForumPost $post)
    {
        $post->load('user', 'comments.user');
        return view('forum.show', compact('post'));
    }


    public function edit(ForumPost $post)
    {
        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = ForumPost::find($id);

        try{
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json(["message"=>"post updated successfully", "post"=>$post]);
    }
    catch(Exception $e){
        return response()->json(["post"=>$e]);
    }

    }

    public function destroy($id)
    { 
        $post = ForumPost::find($id);
        $topic = $post->topic_id;
        ForumPost::where('post_id', $id)->delete();
        ForumComment::where('post_id', $id)->delete();
          $topic = ForumTopics::where('topic_id', $topic)->first();
        if ($topic) {
            $topic->posts = $topic->posts - 1;
            $topic->save();
        }

        return response()->json(["message"=>"succesfully deleted"]);
    }
}
