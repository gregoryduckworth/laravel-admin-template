@extends('layouts.guest')

@section('content')
    <div class="card-header text-center">
        <a href="/" class="h1">
            <strong>{{ config('app.name') }}</strong>
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('password.email') }}" method="POST">
            {{ __('auth.forgot_password_text') }}
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
                    placeholder="Enter email"
                />
                @error('email')
                    <span class="mt-2 text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('auth.email_reset_link') }}
                    </button>
                </div>
                <div class="col-8 mt-2 text-right">
                    <a href="{{ url()->previous() }}">
                        {{ __('common.back') }}
                    </a>
                </div>
            </div>
            <div></div>
        </form>
    </div>
@endsection
