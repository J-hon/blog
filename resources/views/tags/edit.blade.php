@extends('main')

@section('title', '| Edit Tag')

@section('content')

    {{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => "PUT"]) }}

        {{-- name below is the name of the column in the database --}}
        {{ Form::label('name', 'Title') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}

        {{ Form::submit('Save changes', ['class' => 'btn-h1-spacing btn btn-success']) }}

    {{ Form::close() }}

@endsection