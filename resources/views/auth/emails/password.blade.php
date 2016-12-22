@extends('layouts.email',['title'=>'Password reset request'])


@section('content')
<!-- START CENTERED WHITE CONTAINER -->
<span class="preheader">Password reset request.</span>
<table class="main">
  <!-- START MAIN CONTENT AREA -->
  <tr>
    <td class="wrapper">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <p>Hi <strong>{{$user->name}}</strong>,</p>
            <p>We received a request to reset your password on {{config('app.site_name')}}, please click the link below to go to the next step.</p>
            <br>
            <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{$link}} </a>
            <br>
            <p>If you did not make this request, just ignore this email, you are still safe with us.</p>
            <p>__ Best regards.</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- END MAIN CONTENT AREA -->
  </table>
@stop


