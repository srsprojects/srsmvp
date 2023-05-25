@extends('layouts.auth')

@section('title', 'Login to your SRS Account')

@section('content')


    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Login</h5>
            <div class="nk-block-des">
                <p>Login to your {{ config('app.name') }} Account</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="text-danger">
        <x-jet-validation-errors class="mb-4" />
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="login">Email Address or Phone Number</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="login" name="login"
                    placeholder="Enter your Phone Number or Email Address">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Passcode</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg required" id="password" name="password"
                    placeholder="Set your passcode" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Login to SRS</button>
        </div>
    </form><!-- form -->
    <div class="form-note-s2 pt-4"> Don't have an account yet ? <a href="{{ route('register') }}"><strong>Register in
                instead</strong></a>
    </div>

@endsection

@push('styles')
    <style>
        .bg-abstract {
            background-color: green;
        }
    </style>
@endpush
