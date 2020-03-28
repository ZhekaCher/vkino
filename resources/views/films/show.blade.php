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

                <h3>Genres: <small>@foreach($film -> genres as $genre) <a
                            href="/films?genre={{$genre->value}}">{{$genre->value}} </a>@endforeach</small></h3>
                {{--            <h3>Genres: <small>{{$film -> genres}}</small></h3>--}}

                <div class="row">
                    <div class="small-3 columns">
                        @if(count($film->comments)!=0)
                            <h3>Rating:
                                @php
                                    $i = 0;
                                    $j = 0;
                                        $comments = $film-> comments;
                                        foreach ($comments as $comment){
                                            if ($comment-> rating != null){
                                                $j++;
                                                $i += $comment-> rating;
                                                }
                                        }

                                        $i = $i/$j
                                @endphp

                                @while($i>1)
                                    @php $i = $i-1;@endphp
                                    <i class="fas fa-star" style="color: orange"></i>
                                @endwhile
                                @if(!is_int($i))
                                    <i class="fas fa-star-half-alt" style="color: orange"></i>
                                @else
                                    <i class="fas fa-star" style="color: orange"></i>
                                @endif
                            </h3>
                        @endif
                    </div>
                    <div class="small-9 columns">
                        <input type="text" id="middle-label" placeholder="One fish two fish">
                    </div>
                </div>
            </div>
        </div>

        <div class="column row">
            <hr>
            <ul class="tabs" data-tabs id="example-tabs">
                <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Reviews</a></li>
                <li class="tabs-title"><a href="#panel2">Similar Films</a></li>
            </ul>
            <div class="tabs-content" data-tabs-content="example-tabs">
                <div class="tabs-panel is-active" id="panel1">
                    <h4>Reviews: {{count($film->comments)}}</h4>
                    <div class="grid-x align-center">
                        @foreach($film-> comments as $comment)
                            <div class="media-object stack-for-small large-8"
                                 style="border-left: #0a0a0a solid 1px; border-right: #0a0a0a solid 1px; padding: 20px; margin-top: 2vh; margin-bottom: 2vh;">
                                <div class="media-object-section hide-for-small-only">
                                    <img class="thumbnail" src="https://placehold.it/150x150"
                                         style="height: 150px; width: 150px;">
                                </div>
                                <div class="media-object-section">
                                    <h5><b>{{$comment-> name}}</b> <b
                                            style="font-style: italic">{{$comment -> relevance}}</b></h5>
                                    <p>{{$comment-> text}}</p>
                                    @if($comment-> rating != null)
                                        <p>Rating:
                                            @for($i = $comment-> rating; $i>0; --$i)
                                                <i class="fas fa-star" style="color: orange"></i>
                                            @endfor
                                        </p>
                                    @endif
                                    @auth
                                        @if(Auth::id() == $comment->id)
                                            <button class="button">Delete Comment</button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid-x align-center">
                        <div class="large-6">
                            <label>
                                My Review
                                <textarea placeholder="None"></textarea>
                            </label>
                            <button class="button">Submit Review</button>
                        </div>
                    </div>
                </div>
                <div class="tabs-panel" id="panel2">
                    <div class="grid-x">
                        @for($i=0; $i<5; ++$i)
                            <div class="cell small-12 medium-4 large-2" style="margin: 30px">
                                <div class="column text-center">
                                    <img class="thumbnail" src="\img\film_posters\{{$film -> id}}.jpg"
                                         style="height: 40vh;">
                                    <h5>Other Film </h5>
                                    <p>In condimentum facilisis porta. Sed nec diam eu diam mattis viverra. Nulla
                                        fringilla,
                                        orci ac euismod semper, magna diam.</p>
                                    <small>
                                        @foreach($film->genres as $genre)
                                            {{$genre->value}};
                                        @endforeach
                                    </small>
                                    <a href="#" class="button hollow tiny expanded">Watch</a>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
