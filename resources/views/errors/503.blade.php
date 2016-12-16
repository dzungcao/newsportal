@extends('layouts.public')

@section('content')
<div class="middle-box text-center animated fadeInDown">
    <h1>500</h1>
    <h3 class="font-bold">Something wrong happened!</h3>

    <div class="error-desc">
        The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
        You can go back to main page: <br/><a href="/" class="btn btn-primary m-t">Homepage</a>
    </div>
</div>
@stop