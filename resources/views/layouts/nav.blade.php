<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
    <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="responsive-menu" style="margin-bottom: 5vh">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li><a class="logo" href="/"><img id="logo" src="/img/vkino-black.png" alt="Logo"></a></li>
            <li><a href="/films">Films</a></li>
            <li class="has-submenu">
                <a href="#">Genres</a>
                <ul class="submenu menu vertical" data-submenu>
                    @php
                        $genres = App\Genre::all() -> sortBy('value');
                    @endphp
                    @foreach($genres as $genre)
                        <li><a href="/films?genre={{$genre->value}}">{{$genre->value}}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            @auth
                <li>
                    <form action="/imageUpload" method="POST" class="text-center" enctype="multipart/form-data"
                          style="border-left: #0a0a0a solid 2px;border-right: #0a0a0a solid 2px; margin-right: 5vh">
                        @csrf
                        <label for="upload-photo" id="upload-photo-label">Upload avatar...</label>
                        <input type="file" name="image" id="upload-photo"/>
                        <button type="submit" id="submit-upload-photo">Submit</button>
                    </form>
                </li>
                <ul class="dropdown menu" data-dropdown-menu style="padding-right: 2vh">
                    <li class="has-submenu">

                        <img class="ava" src="
                        @if(file_exists(getcwd().'/img/user_avatars/'.Auth::id().'.png'))
                            /img/user_avatars/{{Auth::id()}}.png
@else
                            https://placehold.it/150x150
@endif
                            " style="width: 40px; height: auto">
                        <ul class="submenu menu vertical" data-submenu>
                            <li style="padding: .7rem 1rem">Signed in as <strong></strong>
                            </li>
                            <li><a href="/films/favourites" style="padding-bottom: 1px">Favourites</a></li>
                            <li>
                                <hr/>
                            </li>


                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <a onclick="document.getElementById('logout-form').submit()">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

            @endauth
            <li>
                <form class="menu" method="GET" action="/films">
                    <input type="text" id="search" name="search" placeholder="Search">
                    <button type="submit" class="button">Search</button>
                </form>
            </li>
            @guest
                <li>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @endguest


        </ul>
    </div>
</div>
