@extends('layouts.layout')

@section('title', 'Films')

@section('content')

    <div class="grid-x align-center">
        @foreach($films  as $film)
            <hr class="cell large-12">
            <div class="media-object stack-for-small large-10">
                <div class="media-object-section">
                    <div class="thumbnail">
                        <img src="/img/film_posters/{{$film -> id}}.jpg" style=" width:auto;height: 20vh">
                    </div>
                </div>
                <div class="media-object-section">
                    <h4><a href="/films/{{$film->id}}">{{$film->title}}</a></h4>
                    <p>{{$film->description}}</p>
                    <b>Genres: @foreach($film-> genres as $genre) <a href="/films?genre={{$genre->value}}" style="font-style: italic">{{$genre->value}} </a>@endforeach</b><br>
                    <b>Duration: {{date('H', mktime(0,$film->duration))}} hours {{date('i', mktime(0,$film->duration))}} minutes</b><br>
                    <b>Release Date: {{$film->release}}</b>
                </div>
            </div>
        @endforeach
            <hr class="cell large-12">
    </div>

    @if($films instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="text-center">{{$films -> links()}}</div>
    @endif

@endsection
