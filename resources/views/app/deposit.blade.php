@extends('layouts.app');

@section('title', 'Deposit Funds to Prefund Wallet')

@section('content')

    <div class="buysell wide-xs m-auto">
        @include('components.deposit-withdraw-nav')
        <div class="buysell-title text-center">
            <h2 class="title">Pre Fund Your Wallet!</h2>
        </div><!-- .buysell-title -->
        <div class="buysell-block">
            <div id="loader" class="spinner" style="display: none;"></div>

            <form action="#" name="deposit" class="buysell-form">
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
            </div> --}}
                <!-- .buysell-field -->
                <div class="buysell-field form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="buysell-amount">Amount to Deposit</label>
                    </div>
                    <div class="form-control-group">
                        <input type="number" step=".01" class="form-control form-control-lg form-control-number"
                            id="buysell-amount" name="amount" required placeholder="1000.00">
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
                                <input class="buysell-pm-control" type="radio" value="mtnmomo" name="bs-method"
                                    id="pm-bank" required />
                                <label class="buysell-pm-label" for="pm-bank">
                                    <span class="pm-name">MTN MOMO</span>
                                    <span class="pm-icon"><em class="icon ni ni-building-fill"></em></span>
                                </label>
                            </li>
                            <li class="buysell-pm-item">
                                <input class="buysell-pm-control" type="radio" value="card" name="bs-method"
                                    id="pm-card" required />
                                <label class="buysell-pm-label" for="pm-card">
                                    <span class="pm-name">Credit / Debit Card</span>
                                    <span class="pm-icon"><em class="icon ni ni-cc-alt-fill"></em></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div><!-- .buysell-field -->
                <div class="buysell-field form-action">
                    <button class="btn btn-lg btn-block btn-primary" onclick="handlePay(event)">Continue to Deposit</button>
                </div><!-- .buysell-field -->
                <div class="form-note text-base text-center">NB: transfer fees may be included at checkout, <a
                        href="#">Learn about fees</a>.</div>
            </form><!-- .buysell-form -->
        </div><!-- .buysell-block -->
    </div><!-- .buysell -->

@endsection
@php
    $user = Auth::user();
@endphp
@push('scripts')
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script>
        function handlePay(event) {
            event.preventDefault(); // Prevent the form from submitting

            payment_method = document.forms["deposit"]["bs-method"].value;

            switch (payment_method) {
                case 'card':
                    makeCardPayment();
                    break;
                case 'mtnmomo':
                    makeMomoPayment()

                default:
                    break;
            }
        }

        function makeCardPayment() {
            var amount = document.querySelector("#buysell-amount").value;
            FlutterwaveCheckout({
                public_key: "<?php echo env('FLW_PUB_KEY'); ?>",
                tx_ref: "SRS-" + generateUniqueID(),
                amount: parseFloat(amount).toFixed(2),
                currency: "NGN",
                payment_options: "card, mobilemoneyghana, ussd",
                callback: function(payment) {
                    // Send AJAX verification request to backend
                    verifyTransactionOnBackend(payment.id);
                },
                onclose: function(incomplete) {
                    /* if (incomplete || window.verified === false) {
                        document.querySelector("#payment-failed").style.display = 'block'; 
                    } else {
                        
                    } */
                    window.location.href = '/dashboard';
                },
                meta: {
                    user_id: "<?php echo $user->id; ?>",
                },
                customer: {
                    email: "<?php echo $user->email; ?>",
                    phone_number: "<?php echo $user->phone; ?>",
                    name: "<?php echo $user->name; ?>",
                },
                customizations: {
                    title: "SRS Wallet Deposit",
                    description: "Payment for Wallet Deposit Transaction",
                    logo: "",
                },
            });
        }

        function makeMomoPayment() {
            var amount = parseFloat(document.querySelector("#buysell-amount").value).toFixed(2);
            //phone_number: "<?php echo $user->phone; ?>"
            var loader = $('#loader');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Show the loader
                loader.show();

                $.ajax({
                    url: '/wallets/fund/momo',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                    },
                    data: {
                        phone_number: "<?php echo $user->phone; ?>",
                        amount
                    },
                    success: function(response) {
                        // Hide the loader
                        loader.hide();

                        // Show success message
                        alert('Success' + response.message);
                    },
                    error: function(xhr, status, error) {
                        // Hide the loader
                        loader.hide();
                        console.log(error);
                        // Show error message
                        alert('An error occurred: ' + status.data.message);
                    }
                });
        }

        function verifyTransactionOnBackend(transactionId) {
            // Let's just pretend the request was successful
            setTimeout(function() {
                window.verified = true;
            }, 200);
        }

        function generateUniqueID() {
            var timestamp = Date.now().toString(36);
            var randomChars = Math.random().toString(36).substr(2, 5);
            var uniqueID = timestamp + randomChars;
            return uniqueID;
        }
    </script>
@endpush

@push('styles')
<style>
    /* CSS for the spinner */
    .spinner {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        margin: 20px auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush
