@extends('layouts.email',['title'=>'Complete your registration'])


@section('content')
<!-- START CENTERED WHITE CONTAINER -->
<span class="preheader">Complete your registration.</span>
<table class="main">
  <!-- START MAIN CONTENT AREA -->
  <tr>
    <td class="wrapper">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <p>Hi <strong>{{$user->name}}</strong>,</p>
            <p>Please click the below link to complete your account registration on {{config('app.site_name')}}.</p>
            <br>
            <a href="{{$link}}"> {{$link}} </a>
            <br>
            <br>
            <p>__ Best regards.</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- END MAIN CONTENT AREA -->
  </table>
@stop