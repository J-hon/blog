@extends('main')

@section('title', '| Delete comment')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>DELETE THIS COMMENT?</h1>
            <p>
                <strong>Name: </strong>{{ $comment->name }}<br>
                <strong>Email: </strong>{{ $comment->email }}<br>
                <strong>Comment: </strong>{{ $comment->comment }}
            </p>

            <div class="row">
                <div class="col-md-6">
                    {!! Html::linkRoute('posts.show', 'CANCEL', array($comment->post->id), array('class'=>'btn btn-lg btn-block btn-primary')) !!}
                </div>

                {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}

                    {{ Form::submit('YES, DELETE THIS COMMENT', ['class' => 'btn btn-lg btn-danger']) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>


@endsection