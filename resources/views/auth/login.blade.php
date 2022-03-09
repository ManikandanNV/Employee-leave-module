@extends('layouts.app')

@section('content')

<div class="login-section">

    <div class="card login-card">
        <img src="{{ asset('images/HA_Logo.svg') }}" class="img-fluid mb-3" alt="logo" width="140">
        <h5>Sign in to HR Portal</h5>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">{{ __('Email Address') }}</label>
                
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>    

            <div class="input-group mb-2">
                <label for="password">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>    

            <button type="submit" class="btn w-100 btn-primary">
                {{ __('Login') }}
            </button>
                
        </form>
    </div>    
</div>    
                
@endsection
