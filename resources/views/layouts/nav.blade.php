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
                        $genres = App\Genre::all();
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
            <li> <form class="menu" method="GET" action="/films">
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
            @auth
                {{--                TODO(Add menu for user with logout)--}}
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="button">Logout</button>
                    </form>
                </li>
            @endauth

        </ul>
    </div>
</div>
