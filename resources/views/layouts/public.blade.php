<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    @yield('metadata')
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/rrssb.css" />
    <link rel="stylesheet" href="/css/myapp.css" />
    @yield('extraheads')
</head>
<body>
    
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default mynav">
        <!-- begin container -->
        <div class="container">
            <div class="row">
            <div class="col-md-10 col-md-offset-1">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">
                    <strong>DZUNG'S WEBLOG</strong>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- begin navbar-collapse -->
            <div class="collapse navbar-collapse" id="header-navbar" >
                <ul class="nav navbar-nav navbar-right">             
                    @if(!\Auth::check())
                    <li><a href="/login">LOGIN</a></li>
                    <li><a href="/register">REGISTER</a></li>
                    @else
                    <li><a href="/"><i class="fa fa-home"></i> HOME</a></li>
                    <li><a href="/news"><i class="fa fa-bars"></i> YOUR LIST</a></li>
                    <li><a href="/news/create"><i class="fa fa-edit"></i> WRITE</a></li>
                    <li>
                        <a href="javascript:;" data-toggle="dropdown"><i class="fa fa-user"></i> {{\Auth::user()->name}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/logout"><i class="fa fa-key"></i> LOGOUT</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            </div>
            </div>
            <!-- end navbar-collapse -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #header -->

    <!-- begin #content -->
    
    <div class="container">
        <div class="row">
            @if(\Session::has('message'))
            <div class="col-md-10 col-md-offset-1">
                <p class="alert alert-warning">
                    {{\Session::get('message')}}
                </p>
            </div>
            @endif
            <div class="col-md-10 col-md-offset-1">
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- end #content -->

    <!-- ================== BEGIN BASE JS ================== -->
    
    <script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/rrssb.min.js"></script>
    <script src="/js/all.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    @yield('extrascripts')
    
</body>
</html>