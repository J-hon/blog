@extends('main')

@section('title', '| View Post')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('images/'.$post->image) }}" width="400" height="400" alt="Photo">
            <h1>{{ $post->title }}</h1>

            <p class="lead">{!! $post->body !!}</p>

            <hr>

            <div class="tags">

                @foreach($post->tags as $tag)
                    <span class="badge badge-secondary">{{ $tag->name }}</span>

                @endforeach

            </div>

            <div id="backend-comments" style="margin-top: 50px">
                <h3>Comments <small> {{ $post->comments()->count() }} comments</small></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Comments</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($post->comments as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td><a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a></td>
                                <td><a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <dl class="dl-horizontal">
                        <dt>URL: </dt>
                        <dd><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Category: </dt>
                        <dd>{{ $post->category->name }}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Created at: </dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->created_at) )}}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Last Updated: </dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->updated_at) )}}</dd>
                    </dl>

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-block">Edit</a>
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

                                {{ Form::submit('Delete post', ['class' => 'btn btn-danger btn-block']) }}

                            {!! Form::close() !!}
                        </div>

                        <div class="col-sm-12" style="margin-top: 20px">
                            {{ Html::linkRoute('posts.index', '<< See all posts', array(), ['class' => 'btn btn-light btn-block btn-h1-spacing']) }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection