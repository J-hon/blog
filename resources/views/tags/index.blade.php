@extends('main')

@section('title', '| All Tags')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                <tbody>

                    @foreach($tags as $tag)
                        <tr>
                            <th>{{ $tag->id }}</th>
                            <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">New Tag</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}

                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}

                        {{ Form::submit('Create new Tag', ['class' => 'btn btn-primary form-spacing-top btn-block']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop