@extends('layouts.app');

@section('title','Deposit Funds to Prefund Wallet')

@section('content')
    
<div class="buysell wide-xs m-auto">
    @include('components.deposit-withdraw-nav')
    <div class="buysell-title text-center">
        <h2 class="title">Pre Fund Your Wallet!</h2>
    </div><!-- .buysell-title -->
    <div class="buysell-block">
        <form action="#" class="buysell-form">
            {{-- <div class="buysell-field form-group">
                <div class="form-label-group">
                    <label class="form-label">Choose what you want to get</label>
                </div>
                <input type="hidden" value="btc" name="bs-currency" id="buysell-choose-currency">
                <div class="dropdown buysell-cc-dropdown">
                    <a href="#" class="buysell-cc-choosen dropdown-indicator" data-bs-toggle="dropdown">
                        <div class="coin-item coin-btc">
                            <div class="coin-icon">
                                <em class="icon ni ni-sign-btc-alt"></em>
                            </div>
                            <div class="coin-info">
                                <span class="coin-name">Bitcoin (BTC)</span>
                                <span class="coin-text">Last Order: Nov 23, 2019</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
                        <ul class="buysell-cc-list">
                            <li class="buysell-cc-item selected">
                                <a href="#" class="buysell-cc-opt" data-currency="btc">
                                    <div class="coin-item coin-btc">
                                        <div class="coin-icon">
                                            <em class="icon ni ni-sign-btc-alt"></em>
                                        </div>
                                        <div class="coin-info">
                                            <span class="coin-name">Bitcoin (BTC)</span>
                                            <span class="coin-text">Last Order: Nov 23, 2019</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="buysell-cc-item">
                                <a href="#" class="buysell-cc-opt" data-currency="eth">
                                    <div class="coin-item coin-eth">
                                        <div class="coin-icon">
                                            <em class="icon ni ni-sign-eth-alt"></em>
                                        </div>
                                        <div class="coin-info">
                                            <span class="coin-name">Ethereum (ETH)</span>
                                            <span class="coin-text">Not order yet!</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div><!-- .dropdown-menu -->
                </div><!-- .dropdown -->
            </div> --}}<!-- .buysell-field -->
            <div class="buysell-field form-group">
                <div class="form-label-group">
                    <label class="form-label" for="buysell-amount">Amount to Deposit</label>
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
                                <span class="pm-name">Credit / Debit Card</span>
                                <span class="pm-icon"><em class="icon ni ni-cc-alt-fill"></em></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div><!-- .buysell-field -->
            <div class="buysell-field form-action">
                <a class="btn btn-lg btn-block btn-primary" data-bs-toggle="modal" href="#buy-coin">Continue to Deposit</a>
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