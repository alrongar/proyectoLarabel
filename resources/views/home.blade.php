@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card dashboard">
                <div class="dashboard__header card-header">{{ __('Dashboard') }}</div>
                <div class="dashboard__controls row mb-0">
                    <!--<div class="dashboard__buttons col-md-6 offset-md-4">
                        <button type="submit" class="button button--primary">
                            {{ __('Register') }}
                        </button>
                        
                    </div>-->
                </div>
                <div class="dashboard__body card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="dashboard__message">{{ __('You are logged in!') }}</p>

                    <button class="button button--secondary">{{ __('Go to Events') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
