@extends('layouts.app');

@section('title','Withdraw Funds from your Wallet')

@section('content')
    
<div class="buysell wide-xs m-auto">
    @include('components.deposit-withdraw-nav')
    <div class="buysell-title text-center">
        <h2 class="title">Withdraw From Your Wallet!</h2>
    </div><!-- .buysell-title -->
    <div class="buysell-block">
        <form action="#" class="buysell-form">
            <div class="buysell-field form-group">
                <div class="form-label-group">
                    <label class="form-label" for="buysell-amount">Amount to Withdraw</label>
                </div>
                <div class="form-control-group">
                    <input type="text" class="form-control form-control-lg form-control-number" id="buysell-amount" name="amount" placeholder="1000.00">
                    <div class="form-dropdown">
                        <div class="text-primary">NGN</div>
                    </div>
                </div>
                <div class="form-note-group">
                    <span class="buysell-min form-note-alt">Minimum: 1000.00 NGN</span>
                    <span class="buysell-rate form-note-alt">1 NGN = 1 NGN (SRS)</span>
                </div>
            </div><!-- .buysell-field -->
            <div class="buysell-field form-group">
                <div class="form-label-group">
                    <label class="form-label">Payment Method</label>
                </div>
                <div class="form-pm-group">
                    <ul class="buysell-pm-list">
                        {{-- <li class="buysell-pm-item">
                            <input class="buysell-pm-control" type="radio" name="bs-method" id="pm-paypal" />
                            <label class="buysell-pm-label" for="pm-paypal">
                                <span class="pm-name">Paystack</span>
                                <span class="pm-icon"><em class="icon ni ni-paypal-alt"></em></span>
                            </label>
                        </li> --}}
                        <li class="buysell-pm-item">
                            <input class="buysell-pm-control" type="radio" name="bs-method" id="pm-bank" required/>
                            <label class="buysell-pm-label" for="pm-bank">
                                <span class="pm-name">MTN MOMO</span>
                                <span class="pm-icon"><em class="icon ni ni-building-fill"></em></span>
                            </label>
                        </li>
                        <li class="buysell-pm-item">
                            <input class="buysell-pm-control" type="radio" name="bs-method" id="pm-card" required/>
                            <label class="buysell-pm-label" for="pm-card">
                                <span class="pm-name">Direct to Bank</span>
                                <span class="pm-icon"><em class="icon ni ni-cc-alt-fill"></em></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div><!-- .buysell-field -->
            <div class="buysell-field form-action">
                <a class="btn btn-lg btn-block btn-primary" data-bs-toggle="modal" href="#buy-coin">Continue to Withdraw</a>
            </div><!-- .buysell-field -->
            <div class="form-note text-base text-center">NB: transfer fees may be included at checkout, <a href="#">Learn about fees</a>.</div>
        </form><!-- .buysell-form -->
    </div><!-- .buysell-block -->
</div><!-- .buysell -->

@endsection

@push('scripts')
    
@endpush

@push('styles')
    
@endpush