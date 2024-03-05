@extends('layouts.guest')

@section('content')
    <div class="card-header text-center">
        <a href="/" class="h1">
            <strong>{{ config('app.name') }}</strong>
        </a>
    </div>
    <div class="mb-4 mt-4 text-center">
        <p>{{ __('common.welcome_message') }}</p>
    </div>
    <div class="mb-4 text-center">
        <a href="{{ route('login') }}" class="btn btn-primary">
            {{ __('auth.login') }}
        </a>
        <a href="{{ route('register') }}" class="btn btn-secondary">
            {{ __('auth.register') }}
        </a>
    </div>
    <div class="mb-4 text-center">
        <a href="{{ route('password.request') }}">
            {{ __('auth.forgot_password') }}
        </a>
    </div>
@endsection
