@extends('layouts.app')
@section('title')| Home @stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome {{ \Illuminate\Support\Facades\Auth::user()->name ?? 'guest' }}, this is the home page of this News portal
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
