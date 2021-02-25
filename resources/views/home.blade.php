@extends('layouts.front')

@section('banner')
    <div class="jumbotron">
        <div class="container">
            <h1>Hello World</h1>
            <p>
                <a class="btn btn-primary btn-lg">Learn more</a>
            </p>
        </div>
    </div>
@endsection
@section('heading',"Threads")
@section('content')
    @include('thread.partials.thread-list')
@endsection

