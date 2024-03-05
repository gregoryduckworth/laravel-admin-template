@extends('layouts.admin')

@section('title', __('role.edit'))

@section('content')
    @include(
        'admin.role._form',
        [
            'role' => $role,
            'formAction' => route('admin.role.store'),
            'title' => __('role.edit'),
        ]
    )
@endsection
