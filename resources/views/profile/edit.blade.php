@extends('layouts.admin')

@section('title', __('profile.edit'))

@section('content')
    <div class="container">
        <div class="mb-3 p-3">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
