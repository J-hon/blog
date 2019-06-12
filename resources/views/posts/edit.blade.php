@extends('main')

@section('title', '| Edit Post')

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

    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
    <div class="form-row">
        <div class="col-md-8 mb-3">

            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ["class" => 'form-control']) }}

            {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ["class" => 'form-control']) }}

            {{ Form::label('category_id', 'Category: ') }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

            {{ Form::label('tags', 'Tags: ') }}
            {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

            {{ Form::label('featured_image', 'Update featured image: ', ['class' => 'form-spacing-top']) }}
            {{ Form::file('featured_image') }}

            {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, ["class" => 'form-control']) }}
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <dl class="dl-horizontal">
                        <dt>Created at:</dt>
                        <dd>{{ date('M j, Y - H:i', strtotime($post-> created_at))}}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y - H:i', strtotime($post-> updated_at)) }}</dd>
                    </dl>

                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
                        </div>

                        <div class="col-sm-6">
                            <!-- Laravel way to create an anchor element linked to a route -->
                            {{ Form::submit('Save changes', ['class' => 'btn btn-success btn-block']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close()!!}

@stop


@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2-multi').select2();
        {{--$('.select2-multi').select2().val({!! json_encode($post->tags->pluck('id')) !!}).trigger('change');--}}
    </script>

@endsection