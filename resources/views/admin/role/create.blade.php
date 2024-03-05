@extends('layouts.admin')

@section('title', __('role.create'))

@section('content')
    @include(
        'admin.role._form',
        [
            'roles' => null,
            'formAction' => route('admin.role.store'),
            'title' => __('role.create'),
        ]
    )
@endsection
