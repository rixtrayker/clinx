@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{trans('admin.Child info')}}</h4>
            </div>
            <div class="card-body">
    </div>
</div>
@endsection


{{--
<div class="col-md-8">
    <div class="card">
<div class="card-header">Admin :: Dashboard @lang('admin.ID') </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in!
        </div>
    </div>
</div> --}}
