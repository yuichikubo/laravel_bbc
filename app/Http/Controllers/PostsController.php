<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Validator;
use Illuminate\Support\Facades\Redirect;

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
    
    public function edit($id){
        $post = Post::findOrFail($id);
        return view('edit')->with('post', $post);
    }
    
    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/bbc')->with('message', '削除しました。');
    }
    
    public function create() {
      return view('create');
    }
    
    public function store(Request $request){
        
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'cat_id' => 'required',
            ];
            
        $messages = array(
		'title.required' => 'タイトルを正しく入力してください。',
		'content.required' => '本文を正しく入力してください。',
		'cat_id.required' => 'カテゴリーを選択してください。',
	    );

        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->passes()) {
		$post = new Post;
		$post->title = $request->title;
		$post->content = $request->content;
		$post->cat_id = $request->cat_id;
		$post->save();
		return redirect('/bbc')
			->with('message', '投稿が完了しました。');
	}else{
		return Redirect::back()
			->withErrors($validator)
			->withInput();
	}
    }
    
    public function update(Request $request, $id){
        
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'cat_id' => 'required',
            ];
            
        $messages = array(
		'title.required' => 'タイトルを正しく入力してください。',
		'content.required' => '本文を正しく入力してください。',
		'cat_id.required' => 'カテゴリーを選択してください。',
	    );

        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->passes()) {
		$post = Post::findOrFail($id);
		$post->title = $request->title;
		$post->content = $request->content;
		$post->cat_id = $request->cat_id;
		$post->save();
		return redirect('/bbc')
			->with('message', '投稿が完了しました。');
	}else{
		return Redirect::back()
			->withErrors($validator)
			->withInput();
	}
    }
}
