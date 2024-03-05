@extends('layouts.admin')

@section('title', __('common.dashboard'))

@section('content')
    <div class="row">
        @role('admin')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $users }}</h3>
                        <p>{{ __('common.total_users') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a
                        href="{{ route('admin.user.index') }}"
                        class="small-box-footer"
                    >
                        {{ __('common.view') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $roles }}</h3>
                        <p>{{ __('common.total_roles') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-tag"></i>
                    </div>
                    <a
                        href="{{ route('admin.role.index') }}"
                        class="small-box-footer"
                    >
                        {{ __('common.view') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $permissions }}</h3>
                        <p>{{ __('common.total_permissions') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-th"></i>
                    </div>
                    <a
                        href="{{ route('admin.permission.index') }}"
                        class="small-box-footer"
                    >
                        {{ __('common.view') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endrole
    </div>
@endsection
