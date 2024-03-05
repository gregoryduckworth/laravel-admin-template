@extends('layouts.guest')

@section('content')
    <div class="card-header text-center">
        <a href="/" class="h1">
            <strong>{{ config('app.name') }}</strong>
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">
                    {{ __('user.email') }}
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                />
                @error('email')
                    <span class="mt-2 text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="password" class="form-label">
                    {{ __('user.password') }}
                </label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    required
                    autocomplete="current-password"
                />
                @error('password')
                    <span class="mt-2 text-red-500">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" />
                        <label for="remember">
                            {{ __('auth.remember_me') }}
                        </label>
                    </div>
                </div>
                <div class="col-4 text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('auth.sign_in') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-8 mt-3 text-right">
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">
                        {{ __('auth.forgot_password') }}
                    </a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}">
                        {{ __('auth.register') }}
                    </a>
                </p>
                <p class="mb-0">
                    <a href="{{ url()->previous() }}">
                        {{ __('common.back') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
