@extends('layouts.layout')

@section('title', 'Films')

@section('content')


    @foreach($films  as $film)
        <h1>{{$film -> title}}</h1>
    @endforeach
    {{$films -> links()}}
    This is films list page
@endsection
