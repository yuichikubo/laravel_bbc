@extends('layouts.default')
@section('content')

<div class="col-xs-8 col-xs-offset-2">

<h2>タイトル：{{ $post->title }}
	<small>投稿日：{{ date("Y年 m月 d日",strtotime($post->created_at)) }}</small>
</h2>
<p>カテゴリー：{{ $post->category->name }}</p>
<p>{{ $post->content }}</p>

<hr />

<h3>コメント一覧</h3>
@foreach($post->comments as $single_comment)
	<h4>{{ $single_comment->commenter }}</h4>
	<p>{{ $single_comment->comment }}</p><br />
	<form action="{{ action('CommentsController@destroy', [$post->id, $single_comment->id]) }}" id="form_{{ $single_comment->id }}" method="post" style="display:inline">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <a href="#" data-id="{{ $single_comment->id }}" onclick="deleteComment(this);" class= 'btn btn-primary'>削除</a>
	</form>
@endforeach

<h3>コメントを投稿する</h3>
{{-- 投稿完了時にフラッシュメッセージを表示 --}}
@if(Session::has('message'))
	<div class="bg-info">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif

{{-- エラーメッセージの表示 --}}
@foreach($errors->all() as $message)
	<p class="bg-danger">{{ $message }}</p>
@endforeach

<form method="post" action="{{ url('/comments') }}">
	  {{ csrf_field() }}

	<div class="form-group">
		<label for="commenter" class="">名前</label>
		<div class="">
			<input type="text" name="commenter" placeholder="名前">
		</div>
	</div>

	<div class="form-group">
		<label for="comment" class="">コメント</label>
		<div class="">
			<textarea name="comment" placeholder="コメント"></textarea>
		</div>
	</div>

	<input type="hidden" name="post_id" value="{{ $post->id }}">

	<div class="form-group">
		<button type="submit" class="btn btn-primary">投稿する</button>
	</div>
	
	</form>
	
<p>{{ link_to("/bbc", '一覧へ戻る', array('class' => 'btn btn-primary')) }}</p>

</div>

<script>
function deleteComment(e) {
  'use strict';

  if (confirm('削除します。本当によろしいですか?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>

@stop