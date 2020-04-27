@extends('layouts.layout')

@section('title', @$film->title)

@section('content')
    <div class="row">
        <div class="grid-x">

            <div class="medium-5 columns text-center">
                <img class="thumbnail" src="\img\film_posters\{{$film -> id}}.jpg" style="height: 40vh">

            </div>
            <div class="medium-8 large-5 columns">

                <h3>
                    {{$film -> title}}
                    @auth
                        <script>
                            function sendFavouriteForm() {
                                $('#add-favourite').submit();
                            }
                        </script>
                        @if($film -> favourite)
                            <form method="post" id="add-favourite" action="/deleteFavourite">
                                @csrf
                                <input type="hidden" name="film_id" value="{{$film->id}}"/>
                                <i class="fav fas fa-bookmark" onclick="sendFavouriteForm()"></i>
                            </form>
                        @else
                            <form method="post" id="add-favourite" action="/addFavourite">
                                @csrf
                                <input type="hidden" name="film_id" value="{{$film->id}}"/>
                                <i class="fav far fa-bookmark" onclick="sendFavouriteForm()"></i>
                            </form>
                        @endif

                    @endauth
                </h3>

                <p>{{$film -> description}}</p>

                <h3>Genres: <small>@foreach($film -> genres as $genre) <a
                            href="/films?genre={{$genre->value}}">{{$genre->value}} </a>@endforeach
                    </small>
                </h3>
                {{--            <h3>Genres: <small>{{$film -> genres}}</small></h3>--}}

                <div class="row">
                    <div class="small-3 columns">

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
                                if($j>0)
                                    $i = $i/$j
                        @endphp
                        @if($j>0)
                            <h3>Rating:
                                @while($i>1)
                                    @php $i = $i-1;@endphp
                                    <i class="fas fa-star" style="color: orange"></i>
                                @endwhile
                                @if(!is_int($i))
                                    <i class="fas fa-star-half-alt" style="color: orange"></i>
                                @else
                                    <i class="fas fa-star" style="color: orange"></i>
                                @endif
                                @endif
                            </h3>
                    </div>
                </div>
                <h3>Duration: {{date('H', mktime(0,$film->duration))}}
                    hours {{date('i', mktime(0,$film->duration))}}
                    minutes</h3>
                <h3>Release Date: {{$film->release}}</h3>
            </div>
        </div>

        <div class="column row">
            <hr>
            <ul class="tabs" data-tabs id="example-tabs">
                <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Reviews</a>
                </li>
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
                                    <img class="thumbnail" src="
                                    @if(file_exists(getcwd().'/img/user_avatars/'.$comment->user_id.'.png'))
                                        /img/user_avatars/{{$comment->user_id}}.png
                                    @else
                                        https://placehold.it/150x150
@endif
                                        "
                                         style="height: 150px; width: 150px;">
                                </div>
                                <div class="media-object-section">
                                    <h5><b>{{$comment-> name}}</b> <b
                                            style="font-style: italic">{{$comment -> relevance}}</b>
                                    </h5>
                                    <p>{{$comment-> text}}</p>
                                    @if($comment-> rating != null)
                                        <p>Rating:
                                            @for($i = $comment-> rating; $i>0; --$i)
                                                <i class="fas fa-star" style="color: orange"></i>
                                            @endfor
                                        </p>
                                    @endif
                                    @auth
                                        @if(Auth::id() == $comment->user_id or Auth::id() == 4)
                                            <form method="post" action="/deleteComment">
                                                @csrf
                                                <input type="hidden" name="comment_id"
                                                       value="{{$comment->comment_id}}">
                                                <input type="hidden" name="user_id"
                                                       value="{{$comment->user_id}}">
                                                <button class="button">Delete Comment</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @auth
                        <div class="grid-x align-center">
                            <div class="large-6">
                                <form action="/addComment" method="post">
                                    @csrf
                                    <input type="hidden" name="film_id" value="{{$film -> id}}">
                                    <textarea type="textarea" name="text"
                                              placeholder="My Review"></textarea>
                                    <button class="button" type="submit">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="tabs-panel" id="panel2">
                    <div class="grid-x">
                        @foreach($film->relatedFilms as $relatedFilm)
                            <div class="cell small-10 medium-5 large-2" style="margin: 30px">
                                <div class="column text-center">
                                    <img class="thumbnail"
                                         src="\img\film_posters\{{$relatedFilm ->id}}.jpg"
                                         style="width: auto; height: 40vh;">
                                    <h5>{{$relatedFilm->title}} </h5>
                                    <p>{{$relatedFilm->description}}</p>
                                    <small>
                                        @foreach($relatedFilm->genres as $genre)
                                            {{$genre->value}};
                                        @endforeach
                                    </small>
                                    <a href="/films/{{$relatedFilm->id}}"
                                       class="button hollow expanded">Watch</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
