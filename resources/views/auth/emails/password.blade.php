@extends('layouts.email',['title'=>'Yêu cầu lấy lại mật khẩu'])


@section('content')
<!-- START CENTERED WHITE CONTAINER -->
<span class="preheader">Yêu cầu đặt lại mật khẩu awork của bạn.</span>
<table class="main">
  <!-- START MAIN CONTENT AREA -->
  <tr>
    <td class="wrapper">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <p>Xin chào <strong>{{$user->name}}</strong>,</p>
            <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn, vui bấm vào liên kết bên dưới đây để điền mật khẩu mới.</p>
            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
              <tbody>
                <tr>
                  <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td> <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> Đặt lại mật khẩu </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <p>Nếu không phải bạn đã gửi yêu cầu này, vui lòng bỏ qua email này, mọi thông tin của bạn vẫn an toàn.</p>
            <p style="color:#880E4F;font-style: italic;">Vui lòng không trả lời email này vì đây là email tự động, nếu bạn có câu hỏi hoặc cần trợ giúp vui lòng liên hệ theo thông tin trên website của chúng tôi</p>
            <p>__ Thân ái.</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <!-- END MAIN CONTENT AREA -->
  </table>
@stop


