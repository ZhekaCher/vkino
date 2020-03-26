@extends('layouts.layout')

@section('title', @$film->title)

@section('content')
    This is {{$film->title}} film preview page
    @endsection
