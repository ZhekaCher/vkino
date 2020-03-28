@extends('layouts.layout')

@section('title', 'Error')

@section('content')

    <div class="grid-x align-center" style="padding-top: 10vh; padding-bottom: 10vh;">
        <div class="cell large-8">
        <div class="callout alert text-center">
            <h5>Error</h5>
            <p>{{@$errorMessage}}</p>
            <a href="/">Return to main page</a>
        </div>
        </div>
    </div>

    <h1></h1>
@endsection
