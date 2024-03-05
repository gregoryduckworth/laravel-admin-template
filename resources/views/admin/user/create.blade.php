@extends('layouts.admin')

@section('title', __('user.create'))

@section('content')
    @include(
        'admin.user._form',
        [
            'user' => null,
            'roles' => $roles,
            'formAction' => route('admin.user.store'),
            'title' => __('user.create'),
        ]
    )
@endsection
