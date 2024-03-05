@extends('layouts.admin')

@section('title', __('user.edit'))

@section('content')
    @include(
        'admin.user._form',
        [
            'user' => $user,
            'roles' => $roles,
            'formAction' => route('admin.user.update', $user),
            'method' => 'PUT',
            'title' => __('user.edit'),
        ]
    )
@endsection
