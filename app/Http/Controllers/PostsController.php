<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('index')->with('posts', $posts);
    }
    
    public function show($id){
        $post = Post::find($id);
        return view('single')->with('post', $post);
    }
}
