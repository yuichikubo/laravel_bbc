@extends('layouts.default')
@section('content')

<div class="col-xs-8 col-xs-offset-2">

<h1>投稿ページ</h1>

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

<form method="post" action="{{ url('/bbcs') }}">
	  {{ csrf_field() }}
	<div class="form-group">
		<label for="title" class="">タイトル</label>
		<div class="">
			<input type="text" name="title" placeholder="タイトル" value="{{ old('title') }}">
		</div>
	</div>

	<div class="form-group">
		<label for="cat_id" class="">カテゴリー</label>
		<div class="">
			<select name="cat_id" type="text" class="">
				@foreach(config('cat') as $index => $name)
    				<option value="{{ $index }}">{{ $name }}</option>
  				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="content" class="">本文</label>
		<div class="">
    		<textarea name="content" placeholder="本文">{{ old('content') }}</textarea>
		</div>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">投稿する</button>
	</div>
</form>
</div>
@stop