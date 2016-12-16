<div class="row news-item">
	<div class="col-sm-4 item">
		<div class="image-teaser">
			<img src="/{{config('app.upload_dir')}}/{{$item->picture}}" class="img-responsive">
		</div>
	</div>
	<div class="col-sm-8">
		@if($item->status)
		<a href="{{$item->getSlug()}}"><h2><i class="fa fa-check"></i> {{$item->title}}</h2></a>
		@else
		<a href="{{$item->getSlug()}}"><h2>{{$item->title}}</h2></a>
		@endif
		<div class="byline">
			<span>By <a>{{$item->author->name}}</a></span>, 
		    <span>{{date('M d,Y',strtotime($item->created_at))}}</span>
		    <span><i class="fa fa-clock-o"></i> {{date('H:i',strtotime($item->created_at))}}</span>
		</div>
		<p>{!!strip_tags(substr($item->content,0,220))!!}...</p>
		@if($showItemStatus and $item->published)
			<i class="fa fa-check-circle fa-2x article-status"></i>
		@elseif($showItemStatus)
			<i class="fa fa-check-circle fa-2x article-status" style="color:#efefef"></i>
		@endif
	</div>
</div>

