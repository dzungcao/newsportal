<div class="row">
	<div class="col-md-12">
		@if(!$item->published)
		<div class="alert alert-warning published-notice">
			<p>This article is in draft mode, only you can see this article</p>
			<div class="buttons">
				<ul>
					<li>
						<a href="/news/edit/{{$item->id}}" class="btn  btn-success"><i class="fa fa-edit"></i> Edit</a>
					</li>
					<li>
						<form method="POST" action="/news/publish/{{$item->id}}">
						{{csrf_field()}}
						@if(Auth::user()->active)
						<button class="btn btn-success"><i class="fa fa-check"></i> Publish</button>
						@else
						<button disabled class="btn btn-success"><i class="fa fa-check"></i> Publish</a>
						@endif
						</form>
					</li>
					<li>
						<form method="POST" action="/news/delete/{{$item->id}}" onsubmit="return confirm('Do you want to delete this article?')">
						{{csrf_field()}}
						<button class="btn btn-warning"><i class="fa fa-trash"></i> Remove</button>
						</form>
					</li>
				</ul>
				@if(!\Auth::user()->active)
				<small>Please check email to complete your registration before you can publish any article</small>
				@endif
			</div>
		</div>
		@else
		<div class="alert alert-warning published-notice">
			<p>This article has been published, you may remove it, but no edit is permitted</p>
			<form 	method="POST" 
					style="display: inline-block;" 
					action="/news/delete/{{$item->id}}"
					onsubmit="return confirm('Do you want to delete this article?')">
						{{csrf_field()}}
						<button class="btn btn-warning"><i class="fa fa-trash"></i> Remove</button>
			</form>
			<form 	method="POST" 
					style="display: inline-block;" 
					action="/news/unpublish/{{$item->id}}"
					>
						{{csrf_field()}}
						<button class="btn btn-warning"><i class="fa fa-trash"></i> Unpublish</button>
			</form>
		</div>
		@endif
		<hr>
	</div>
</div>