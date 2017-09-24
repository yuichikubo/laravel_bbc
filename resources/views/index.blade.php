@extends('layouts/default')
@section('content')

<div class="col-xs-8 col-xs-offset-2">
@if(Session::has('message'))
	<div class="bg-info">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif

@forelse($posts as $post)

	<h2>タイトル：{{ $post->title }}
		<small>投稿日：{{ date("Y年 m月 d日",strtotime($post->created_at)) }}</small>
	</h2>
	<p>カテゴリー：{{ config('cat')[$post->cat_id] }}</p>
	<p>{{ $post->content }}</p>
	<p>{{ link_to("/bbc/{$post->id}", '続きを読む', array('class' => 'btn btn-primary')) }}</p>
	<p>コメント数：{{ $post->comment_count }}</p>
	<a href="{{ action('PostsController@edit', $post->id) }}" class= 'btn btn-primary'>編集</a>
	<form method="post" action="{{ action('PostsController@destroy', $post->id) }}" id="form_{{ $post->id }}" style="display:inline">
	{{ csrf_field() }}
    {{ method_field('delete') }}
	<a href="#" data-id="{{ $post->id }}" onclick="deletePost(this);" class= 'btn btn-primary'>削除</a>
	</form>
	<hr />
	@empty
	<p>No posts yet</p>
@endforelse

</div>

@stop
<script>
function deletePost(e) {
  'use strict';

  if (confirm('削除します。本当によろしいですか?')) {
    document.getElementById('form_' + e.dataset.id).submit();
  }
}
</script>