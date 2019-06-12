@extends('main')

@section('title', '| Create new post')

@section('stylesheets')

    {!! Html::style('css/select2.min.css') !!}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: "textarea",
            plugins: "link",
            toolbar: "link"
        });
    </script>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2 mb-3">
            <h1>Create new post</h1>

            <hr>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                {{csrf_field()}}
                <div class="form-group">
                    <label name="title">Title:</label>
                    <input id="title" name="title" class="form-control">
                </div>

                {{ Form::label('slug', 'Slug: ') }}
                {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

                {{ Form::label('category_id', 'Category: ') }}
                <select name="category_id" class="form-control">

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>

                {{ Form::label('tags', 'Tags: ') }}
                <select name="tags[]" class="form-control select2-multi" multiple="multiple">

                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach

                </select>

                {{ Form::label('featured_image', 'Upload featured image: ') }}
                {{ Form::file('featured_image') }}

                <div class="form-group">
                    <label>Post Body: </label>
                    <textarea id="body" name="body" rows="10" class="form-control"></textarea>
                </div>

                <input type="submit" value="Create Post" class="btn btn-success btn-block">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>

        </div>
    </div>

@endsection

@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>

@endsection