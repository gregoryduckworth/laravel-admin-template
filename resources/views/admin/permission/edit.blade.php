@extends('layouts.admin')

@section('title', __('permission.edit'))

@section('content')
    @include(
        'admin.permission._form',
        [
            'permission' => $permission,
            'formAction' => route('admin.permission.store'),
            'title' => __('permission.edit'),
        ]
    )
@endsection
