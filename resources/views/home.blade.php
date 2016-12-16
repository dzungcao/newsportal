@extends('layouts.public')

@section('metadata')
<title>Home | NewsPortal</title>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3 id="highlight"><span class="text">HIGHLIGHT</span> <span class="line"></span></h3>
		@foreach($items as $item)
		
		@include('news.__item',compact('item'))
		
		@endforeach
		
	</div>
</div>
@stop