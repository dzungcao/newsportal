@extends('layouts.public')

@section('metadata')
<title>Login | NewsPortal</title>
@stop
@section('extraheads')
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            

            <div class="panel-heading">
            <h4>Welcome to NewsPortal</h4>
            </div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                <p>Please enter your email and password to login</p>
                <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email đăng nhập" name="email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b" value="Login">Login</button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot password?</a>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

