<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="/css/myapp.css" />
    @yield('extraheads')
</head>
<body>
    
    <h1>{{$item->title}}</h1>
    <div class="byline">
        <span>By <a href="">{{$item->author->name}}</a></span>, 
        <span>{{date('M d,Y',strtotime($item->created_at))}}</span>
        <span> <i class="fa fa-clock-o"></i> {{date('H:i',strtotime($item->created_at))}}</span>
    </div>
    <hr>
    <img src="{{config('app.url')}}/{{config('app.upload_dir')}}/{{$item->picture}}" style="width: 100%;display: block">
    <br>
    {!!$item->content!!}
</body>
</html>
