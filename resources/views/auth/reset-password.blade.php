@extends('layouts.guest')

@section('content')
    <div class="card-header text-center">
        <a href="/" class="h1">
            <strong>{{ config('app.name') }}</strong>
        </a>
    </div>
    <div class="card-body">
        <p class="login-box-msg">
            {{ __('auth.reset_password_text') }}
        </p>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input
                type="hidden"
                name="token"
                value="{{ $request->route('token') }}"
            />
            <div class="input-group mb-3">
                <input
                    id="email"
                    class="form-control"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
                    autocomplete="username"
                    readonly
                />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input
                    id="password"
                    class="form-control"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your new password"
                />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input
                    id="password_confirmation"
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm Password"
                />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('auth.reset_password') }}
                    </button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mb-1 mt-3">
            <a href="{{ route('login') }}">{{ __('auth.login') }}</a>
        </p>
    </div>
@endsection
