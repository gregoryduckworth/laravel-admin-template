@extends('layouts.guest')

@section('content')
    <div class="card-header text-center">
        <a href="/" class="h1">
            <strong>{{ config('app.name') }}</strong>
        </a>
    </div>
    <div class="mt-4">
        {{ __('auth.confirm_password') }}
    </div>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">
                {{ __('user.password') }}
            </label>
            <input
                id="password"
                name="password"
                type="password"
                class="form-control"
                autocomplete="password-password"
            />
            @error('password')
                <span class="text-danger mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary btn-block">
                {{ __('common.submit') }}
            </button>
        </div>
    </form>
@endsection
