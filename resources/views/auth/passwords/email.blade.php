@extends('layouts.public')
@section('metadata')
<title>Đặt lại mật khẩu</title>
@stop
<!-- Main Content -->
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Forgot password</h4>
            </div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-warning">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="/password/email">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-6">
                            <label>Please enter your email below, we will send you an instruction to reset your password</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-envelope"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        
    </div>
</div>
@endsection
