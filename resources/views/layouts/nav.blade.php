<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
    <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="responsive-menu">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li><img id="logo" src="/img/vkino-black.png" alt="Logo"></li>
            <li class="has-submenu">
                <a href="#0">Films</a>
                <ul class="submenu menu vertical" data-submenu>
                    @php
                        $genres = App\Genre::all();
                    @endphp
                    @foreach($genres as $genre)
                        <li><a href="/films?genre={{$genre->value}}">{{$genre->value}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#0">Two</a></li>
            <li><a href="#0">Three</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><input type="search" placeholder="Search"></li>
            <li>
                <button type="button" class="button">Search</button>
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
