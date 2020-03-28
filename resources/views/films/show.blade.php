@extends('layouts.layout')

@section('title', @$film->title)

@section('content')

    <div class="row">
        <div class="grid-x">
        <div class="medium-5 columns text-center">
            <img class="thumbnail" src="\img\film_posters\{{$film -> id}}.jpg" style="height: 40vh">

        </div>
        <div class="medium-8 large-5 columns">
            <h3>{{$film -> title}}</h3>
            <p>{{$film -> description}}</p>

            <h3>Genres: <small>@foreach($film -> genres as $genre) <a href="/films?genre={{$genre->value}}">{{$genre->value}} </a>@endforeach</small></h3>
{{--            <h3>Genres: <small>{{$film -> genres}}</small></h3>--}}

            <div class="row">
                <div class="small-3 columns">
                    <h3>Rating: </h3>
                </div>
                <div class="small-9 columns">
                    <input type="text" id="middle-label" placeholder="One fish two fish">
                </div>
            </div>
        </div>
        </div>
    </div>







@endsection
