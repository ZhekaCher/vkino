@extends('layouts.layout')

@section('title', 'Films')

@section('content')


    @foreach($films as $film)
        <h1>{{$film}}</h1>
    @endforeach

    This is films list page
@endsection
