@extends('layouts.auth')

@section('title','Login')

@section('content')

    @error('email')
    <strong  style="color: white">{{ $message }}</strong>
    @enderror
    @error('password')
    <strong style="color: white">{{ $message }}</strong>
    @enderror

    <form id="signin" method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" class="form-control @error('email') is-invalid @enderror" id="user" name="email"
               placeholder="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>


        <input type="password" class="@error('password') is-invalid @enderror" id="password" name="password"
               placeholder="password" required autocomplete="current-password"/>


        <button type="submit">&#xf0da;</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        <p>Not yet with us? <a href="{{url('/auth/registration')}}">registration</a></p>
    </form>


    <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
@endsection
