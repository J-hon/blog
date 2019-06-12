@extends('main')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">

                        {!! Form::open() !!}

                            {{ Form::label('email', 'Email:') }}
                            {{ Form::email('email', null, ['class' => 'form-control']) }}

                            {{ Form::label('password',('Password:')) }}
                            {{ Form::password('password',  ['class' => 'form-control']) }}

                            <br>

                            {{ Form::checkbox('remember') }} {{ Form::label('remember', "Remember Me") }}

                            <p class="text-center"><a href="{{ url('password/reset') }}">Forgot Password?</a></p>

                            {{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection