@extends('layouts.public')

@section('metadata')
<title>Your list | NewsPortal</title>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3 id="highlight"><span class="text">YOUR NEWS LIST</span> <span class="line"></span></h3>
		<p id="view-options">View options: <a class="{{\Input::get('view','all')=='all'?'active':''}}" href="/news?view=all">All</a> - <a class="{{\Input::get('view','all')=='draft'?'active':''}}" href="/news?view=draft">Draft</a> - <a class="{{\Input::get('view','all')=='published'?'active':''}}" href="/news?view=published">Published</a></p>
		<hr>
		@if(count($items) > 0)
			@foreach($items as $item)
			@include('news.__item',compact('item'))
			@endforeach
		@else
			<div class="empty-list">
				<h1>Your news list is empty</h1>
				<a href="/news/create" class="btn btn-success btn-lg">Create your first article now</a>
			</div>
		@endif
	</div>
</div>
@stop

