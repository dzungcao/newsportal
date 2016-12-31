@extends('layouts.public')

@section('metadata')
<title>{{$item->title}}</title>
@stop
@section('extraheads')
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=e77bdc06-2dc7-4d0d-b6c3-d6dd29d91175"></script>
<script type="text/javascript">stLight.options({publisher: "e77bdc06-2dc7-4d0d-b6c3-d6dd29d91175", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<style type="text/css">
	body{
		background-color:#fff;
	}
</style>
@stop
@section('content')
@if(\Auth::check() and \Auth::id() == $item->author_id)
@include('news.__article_controls')
@endif
<div class="article">
<h1>{{$item->title}}</h1>
<div class="byline">
    <span>By <a>{{$item->author->name}} - {{$item->author->email}}</a></span>, 
    <span>{{date('M d,Y',strtotime($item->created_at))}}</span>
    <span><i class="fa fa-clock-o"></i> {{date('H:i',strtotime($item->created_at))}}</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <span class='st_sharethis_large' displayText='ShareThis'></span>
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_linkedin_large' displayText='LinkedIn'></span>
        <span class='st_pinterest_large' displayText='Pinterest'></span>
        <span class='st_email_large' displayText='Email'></span>
    </div>
</div>
<hr>
<img src="/{{config('app.upload_dir')}}/{{$item->picture}}" class="img-responsive center-block">
{!!$item->content!!}
</div>
<div class="comment">
    <h3>Comments and discussion</h3>
    <hr>
    <div id="disqus_thread"></div>
    <script>

    
    var disqus_config = function () {
        this.page.url = '{{config("app.url")."/".$item->getSlug()}}';
        this.page.identifier = 'page-{{$item->id}}';
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '//dzungcaocom.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                    
</div>
@endsection


@section('extrascripts')
<script type="text/javascript">
	
</script>
@stop