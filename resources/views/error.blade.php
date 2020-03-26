@extends('layouts.layout')

@section('title', 'Error')

@section('content')
    <h1>{{@$errorMessage}}</h1>
@endsection
