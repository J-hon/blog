@extends('main')

@section('title', '| All Categories')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">New Category</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}

                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}

                        {{ Form::submit('Create new category', ['class' => 'btn btn-primary form-spacing-top btn-block']) }}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop