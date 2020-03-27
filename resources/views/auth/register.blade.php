@extends('layouts.auth')

@section('title','Register')

@section('content')


    @error('name')
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


    <form id="signin" method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf
        <input type="text" style="@error('name') border: red solid 1px; @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus/>
        <input type="email" style="@error('email') border: red solid 1px; @enderror" id="email" name="email" placeholder="E-Mail" value="{{ old('email') }}" required autocomplete="email"/>
        <input type="password" style="@error('password') border: red solid 1px; @enderror" id="password" name="password" placeholder="Password" required autocomplete="new-password"/>
        <input type="password" style="@error('password') border: red solid 1px; @enderror" id="password-confirm" name="password_confirmation" placeholder="Password cofirmation" required autocomplete="new-password"/>
        <button type="submit">&#xf0da;</button>
        <p>Already with us? <a href="{{ url('/login') }}">login</a></p>
    </form>
@endsection
