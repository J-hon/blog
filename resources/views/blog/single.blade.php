@extends ('main')

<?php

    $titleTag = htmlspecialchars($post->title);

?>

@section('title', "| $titleTag ")

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <img src="{{ asset('images/'.$post->image) }}" height="400" width="450" alt="blog-image">

            <h1>{{ $post->title }}</h1>
            <p>{!! $post->body !!}</p>
            <hr>
            <p>Category: {{ $post->category->name }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="comments-title"><i class="fa fa-comments"></i>{{ $post->comments()->count() }} Comments</h3>
            @foreach($post->comments as $comment)

                <div class="comment">
                    <div class="author-info">
                        <img src="{{ 'https://www.gravatar.com/avatar/'. md5(strtolower(trim($comment->email))) }}" class="author-image">
                        <div class="author-name">
                            <h4>{{ $comment->name }}</h4>
                            <p class="author-time">{{ date('F jS, Y - g:i a', strtotime($comment->created_at)) }}</p>
                        </div>
                    </div>

                    <div class="comment-content">
                        {{ $comment->comment }}
                    </div>
                </div>

            @endforeach
        </div>
    </div>

    <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2">
            {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name', 'Name: ') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-6">
                    {{ Form::label('email', 'Email: ') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-12">
                    {{ Form::label('comment', 'Comment ') }}
                    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

                    {{ Form::submit('Add comment', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
                </div>
            </div>


            {{ Form::close() }}
        </div>
    </div>

@endsection