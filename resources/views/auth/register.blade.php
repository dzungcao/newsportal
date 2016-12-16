@extends('layouts.public',['fluid_container'=>true])

@section('metadata')
<title>Register | Newsportal</title>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h4>Welcome to NewsPortal</h4>
            </div>
            <div class="panel-body">
                <p>Please fill up your information below to signup.</p>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your name">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" value="Signup">Signup</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extrascripts')
@stop