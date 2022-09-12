<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return view('post', compact('posts'));
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'     => 'required',
            'content'   =>  'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::create([
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post  
        ]);
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Data Post',
            'data'      => $post,
        ]);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::whereId($id)->first();
        //create post
        $post->update([
            'title'     => $request->title, 
            'content'   => $request->content
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $post  
        ]);
    }

    public function destroy($id)
    {
        //delete post by ID
        Post::whereId($id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]); 
    }
}
