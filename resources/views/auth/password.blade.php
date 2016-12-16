@extends('layouts.public')
@section('metadata')
<title>Đặt lại mật khẩu</title>
@stop
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Confirm account registration</div>

    <div class="panel-body">
        <p>Hi <strong>{{$user->name}}</strong>, please choose the password that you will use to login</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/activation/'.$token) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input type="password" class="form-control" name="password" placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
