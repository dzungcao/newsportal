@extends('layouts.public')

@section('metadata')
<title>Add news | {{config('app.site_name')}}</title>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Add new a news item</h4>
            </div>
            <div class="panel-body">
                
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title')}}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <label>Content</label>
                            <textarea id="news_content" type="text" class="form-control" name="content" rows="12">{{ old('content') }}</textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <label>Picture</label>
                            <input type="file" name="picture">
                            @if ($errors->has('picture'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('picture') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary" value="Save">Save draft</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extrascripts')
<script src="https://cdn.ckeditor.com/4.6.1/standard-all/ckeditor.js"></script>
<script>
    var config = {
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'monokai_sublime',
        height: 356
    };

    CKEDITOR.replace( 'news_content', config );

</script>
@stop