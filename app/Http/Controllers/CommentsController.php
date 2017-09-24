<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use Validator;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
	
    public function store(Request $request){
        
        $rules = [
            'commenter' => 'required',
            'comment' => 'required',
            ];
            
        $messages = array(
		'commenter.required' => 'タイトルを正しく入力してください。',
		'comment.required' => '本文を正しく入力してください。',
	    );

        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->passes()) {
		$comment = new Comment;
		$comment->commenter = $request->commenter;
		$comment->comment = $request->comment;
		$comment->post_id = $request->post_id;
		$comment->save();
		$post = Post::findOrFail($comment->post_id);
		$post->comment_count += 1;
		$post->save();
		return redirect()
		    ->action('PostsController@show', $comment->post_id)
			->with('message', '投稿が完了しました。');
	}else{
		return Redirect::back()
			->withErrors($validator)
			->withInput();
	}
    }
    
    public function destroy($postId, $commentId) {
      $post = Post::findOrFail($postId);
      $post->comment_count -= 1;
      $post->save();
      $post->comments()->findOrFail($commentId)->delete();
      return redirect()
             ->action('PostsController@show', $post->id);
    }
}
