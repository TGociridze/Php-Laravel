<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Mail\PostCreated;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index () {
      //$posts = DB::table('posts')->get();
      //return $posts;
     // return Post::find(9)->text;

      //return Post::all(); იგივეა რაც ზედა ორი ხაზი

        $posts = Post::paginate(8);
        return view('posts/index', compact('posts'));
    }

    public function create () {
        return view('posts.create');
    }

    public function show($id) {
        $post = Post::find($id);
        return  view('posts.show', compact('post'));
    }

    public function store(CreatePostRequest $request) {
        $post = Post::create([
            'title' => $request->get('title'),
            'text' => $request->get('text'),
            'author' => $request->get('author'),
        ]);


        $user = Auth::user();
        $data = [
            'text' => 'Done',
        ];

        $user->notify(new PostCreated($data));
        return response(['message' => 'This post has been created', 'post'=> $post], '/posts');
//        return redirect('/posts');
    }

    public function edit($id) {

        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }


    public function update(CreatePostRequest $request, $id) {
        $post = Post::findOrFail($id);

        $post->update($request->all());
        return redirect('/posts');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->back();
    }

//    public function approve(Post $post) {
////
//
//    }
}
