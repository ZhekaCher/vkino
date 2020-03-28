@extends('layouts.layout')

@section('title', 'Films')

@section('content')


    @foreach($films  as $film)
        <h1>{{$film -> title}}</h1>
    @endforeach
    @if($films instanceof \Illuminate\Pagination\LengthAwarePaginator)
    {{$films -> links()}}
    @endif
@endsection
