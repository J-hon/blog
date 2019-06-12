@extends('main')

@section('title', '| Forgot my password')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">

                        {!! Form::open(['url' => 'password/email', 'method' => 'POST']) !!}

                            {{ Form::label('email', 'Email Address: ') }}
                            {{ Form::email('email', null, ['class' => 'form-control']) }}

                            {{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection