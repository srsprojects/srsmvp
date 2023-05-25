@extends('layouts.auth')

@section('title', 'Register a SRS Account')

@section('content')


    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Register</h5>
            <div class="nk-block-des">
                <p>Create New {{ config('app.name') }} Account</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="text-danger">
        <x-jet-validation-errors class="mb-4" />
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="name" name="name"
                    placeholder="Enter your Legal Full Name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="phone">Phone Number</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="phone" name="phone"
                    placeholder="Enter your Banking Phone Number" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="email">Email Address (Optional)</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="email" name="email"
                    placeholder="Enter your Email Address or ">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="role">Registering As (Role)</label>
            <div class="form-control-wrap">
                <select class="form-control form-control-lg" id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="depositor" selected>Waste Depositor</option>
                    <option value="agent">Waste Collection Agent</option>
                    <option value="rider">Delivery Rider</option>
                    <option value="collection-hub">Waste Collection Hub</option>
                </select>
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
            <label class="form-label" for="confirm-password">Confirm Passcode</label>
            <div class="form-control-wrap">
                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                    data-target="confirm-password">
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg" id="confirm-password" name="confirm-password"
                    placeholder="Enter your passcode again" required>
            </div>
        </div>

        <div class="form-group">
            <div class="form-control-wrap">
                <label class="form-label" for="address">Set Your Address</label>
                <input type="text" id="address" name="address" class="form-control map-input"
                    placeholder="Start Typing or Use the Map to Pin your Address">
                <input type="hidden" name="latitude" id="latitude" value="0" />
                <input type="hidden" name="longitude" id="longitude" value="0" />

                <div class="card card-bordered card-preview mb-4">
                    <div class="card-inner">
                        <div id="gMap" class="card google-map w-100"></div>
                    </div>
                </div><!-- .card-preview -->
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-control-xs custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox" required>
                <label class="custom-control-label" for="checkbox">I agree to {{ config('app.name') }} <a tabindex="-1"
                        href="#">Privacy Policy</a> &amp; <a tabindex="-1" href="#"> Terms.</a></label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
        </div>
    </form><!-- form -->
    <div class="form-note-s2 pt-4"> Already have an account ? <a href="{{ route('login') }}"><strong>Sign in
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

@push('scripts')
    <!-- Map API Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
    <script defer src="/js/map.js"></script>
@endpush
