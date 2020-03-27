@extends('layouts.auth')

@section('title','Login')

@section('content')

    @error('email')
    <script type="text/javascript">
        let messageText = {!! json_encode($message) !!};
        Toast.add({
            text: messageText,
            color: '#ffffff',
            autohide: true,
            delay: 6500
        });
    </script>
    @enderror

    @error('password')
    <script type="text/javascript">
        let messageText = {!! json_encode($message) !!};
        Toast.add({
            text: messageText,
            color: '#ffffff',
            autohide: true,
            delay: 6500
        });
    </script>
    @enderror

    <form id="signin" method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" style="@error('email') border: red solid 1px; @enderror" id="user" name="email"
               placeholder="E-Mail" value="{{ old('email') }}" required autocomplete="email" autofocus/>


        <input type="password" style="@error('email') border: red solid 1px; @enderror" id="password" name="password"
               placeholder="Password" required autocomplete="current-password"/>
        <p>
            <input type="checkbox" name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
                {{ __('Remember Me') }}
            </label>
        </p>
        <button type="submit">&#xf0da;</button>
        {{--        @if (Route::has('password.request'))--}}
        {{--            <br>--}}
        {{--            <a style="color: white" href="{{ route('password.request') }}">--}}
        {{--                {{ __('Forgot Your Password?') }}--}}
        {{--            </a>--}}
        {{--        @endif--}}
        <p>Not yet with us? <a href="{{url('/register')}}">registration</a></p>
    </form>
@endsection
