@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                  <a href="{{ route('register_teacher') }}" class="btn btn-primary btn-lg btn-block">
                    {{ __('auth.teacher') }}
                </a>
                  <a href="{{ route('register_student') }}" class="btn btn-primary btn-lg btn-block">
                    {{ __('auth.student') }}
                </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
