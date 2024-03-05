@extends('layouts.admin')

@section('title', __('permission.create'))

@section('content')
    @include(
        'admin.permission._form',
        [
            'permission' => null,
            'formAction' => route('admin.permission.store'),
            'title' => __('permission.create'),
        ]
    )
@endsection
