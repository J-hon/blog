@extends('main')

@section('title', '| Contact me')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Contact</h1>
            <hr>
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
                </div>

                <div class="form-group">
                    <label>Message: </label>
                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Type your message here..."></textarea>
                </div>

                <input type="submit" value="Send message" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection