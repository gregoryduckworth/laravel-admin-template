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
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">
                    {{ __('user.email') }}
                </label>
                <input
                    id="email"
                    class="form-control"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="email"
                />
                @error('email')
                    <span class="text-danger mt-2">
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
                    class="form-control"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your new password"
                />
                @error('password')
                    <span class="text-danger mt-2">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3 mt-3">
                <label for="password_confirmation" class="form-label">
                    {{ __('profile.confirm_password') }}
                </label>
                <input
                    id="password_confirmation"
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm Password"
                />
                @error('password_confirmation')
                    <span class="text-danger mt-2">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('auth.reset_password') }}
                    </button>
                </div>
                <div class="col-8 mt-2 text-right">
                    <a href="{{ url()->previous() }}">
                        {{ __('common.back') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
