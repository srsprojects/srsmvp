@extends('layouts.app');

@section('title', 'Collect Recyclables')

@section('content')

    <div class="buysell wide-xs m-auto">
        <div class="buysell-title text-center">
            <h2 class="title">Collect Recyclables Now!</h2>
        </div><!-- .buysell-title -->
        <div class="buysell-block">
            <div class="text-danger">
                <x-jet-validation-errors class="mb-4" />
            </div>
            <form action="{{ route('recyclables.store') }}" method="POST" class="buysell-form">
                @csrf
                <div class="buysell-field form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="buysell-amount">Enter Depositor Phone or Scan QR Code</label>
                    </div>
                    <div class="form-control-group">

                        <input type="number" class="form-control form-control-lg form-control-number" id="buysell-phone"
                            name="phone" placeholder="08062238849" required>
                        <div class="form-dropdown scan">
                            <em class="icon ni ni-scan" style="font-size:50px;"></em>
                        </div>
                    </div>
                    <div class="form-note-group">
                        <span class="buysell-min form-note-alt">User Name: <em id="user_name"></em> </span>
                    </div>
                </div><!-- .buysell-field -->

                <div class="buysell-field form-group">
                    <div class="form-label-group">
                        <label class="form-label">Choose what you want to deposit</label>
                    </div>
                    <input type="hidden" name="recyclable_type" required id="buysell-choose-currency">
                    <div class="dropdown buysell-cc-dropdown">
                        <a href="#" class="buysell-cc-choosen dropdown-indicator" data-bs-toggle="dropdown">
                            <div class="coin-item coin-000">
                                <div class="coin-icon">
                                    <em class="icon ni ni-virus"></em>
                                </div>
                                <div class="coin-info">
                                    <span class="coin-name">Select Recyclable Type</span>
                                    <span class="coin-text">Plastic bottles, minerals etc</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
                            <ul class="buysell-cc-list">
                                <li class="buysell-cc-item selected">
                                    <a href="#" class="buysell-cc-opt" data-currency="000">
                                        <div class="coin-item coin-000">
                                            <div class="coin-icon">
                                                <em class="icon ni ni-virus"></em>
                                            </div>
                                            <div class="coin-info">
                                                <span class="coin-name">Select Recyclable Type </span>
                                                <span class="coin-text">Plastic bottles, minerals etc</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                {{-- <li class="buysell-cc-item">
                                    <a href="#" class="buysell-cc-opt" data-currency="eth">
                                        <div class="coin-item coin-eth">
                                            <div class="coin-icon">
                                                <em class="icon ni ni-virus"></em>
                                            </div>
                                            <div class="coin-info">
                                                <span class="coin-name">Nylons</span>
                                                <span class="coin-text">All Types of Nylons</span>
                                            </div>
                                        </div>
                                    </a>
                                </li> --}}
                                @forelse ($categories as $cat)
                                    <li class="buysell-cc-item">
                                        <a href="#" class="buysell-cc-opt" data-value="{{ $cat->id }}"
                                            data-currency="{{ $cat->id }}">
                                            <div class="coin-item coin-{{ $cat->id }}">
                                                <div class="coin-icon">
                                                    <em class="icon ni ni-package"></em>
                                                </div>
                                                <div class="coin-info">
                                                    <span class="coin-name">{{ $cat->name }}</span>
                                                    <span class="coin-text">{{ $cat->slug }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="buysell-cc-item">
                                        <a href="#" class="buysell-cc-opt" data-currency="eth">
                                            <div class="coin-item coin-eth">
                                                <div class="coin-icon">
                                                    <em class="icon ni ni-covid"></em>
                                                </div>
                                                <div class="coin-info">
                                                    <span class="coin-name">No Recyclable Types Found</span>
                                                    <span class="coin-text">No Recyclable Type Configured</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforelse
                            </ul>
                        </div><!-- .dropdown-menu -->
                    </div><!-- .dropdown -->
                </div><!-- .buysell-field -->

                <div class="buysell-field form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="buysell-amount">Measurement Qty (KG)</label>
                    </div>
                    <div class="form-control-group">
                        <input type="number" class="form-control form-control-lg form-control-number" id="buysell-amount"
                            name="qty" step=".0001" required placeholder="0.0012">
                        <div class="form-dropdown">
                            <div class="text">KG<span>/</span></div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-indicator-caret" data-bs-toggle="dropdown"
                                    data-offset="0,2">KG</a>
                                <div class="dropdown-menu dropdown-menu-xxs dropdown-menu-end text-center">
                                    <ul class="link-list-plain">
                                        <li><a href="#">g (Grammes)</a></li>
                                        <li><a href="#">lb (Tonnes)</a></li>
                                        <li><a href="#">p (Pounds)</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-note-group">
                        <span class="buysell-min form-note-alt">Recommended Metrics: KG</span>
                        <span class="buysell-rate form-note-alt">1000g (Grammes) = 1Kg (Kilogrammes)</span>
                    </div>
                </div><!-- .buysell-field -->

                <div class="buysell-field form-action">
                    <button class="btn btn-lg btn-block btn-primary" type="submit">Collect
                        Recyclables</button>
                </div><!-- .buysell-field -->
                <div class="form-note text-base text-center">NB: You'll be charged for this collection, <a
                        href="#">Learn about recyclables collection</a>.</div>
            </form><!-- .buysell-form -->
        </div><!-- .buysell-block -->
    </div><!-- .buysell -->

@endsection
@include('components.modals.scan-modal')
@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<script>
    $(document).ready(function() {
        // Event handler for selecting an option
        $('.buysell-cc-opt').click(function(e) {
                e.preventDefault();

                // Get the selected option's data-currency and data-value values
                var selectedCurrency = $(this).data('currency');
                var selectedValue = $(this).data('value');

                // Update the hidden input value and data-value attribute
                $('#buysell-choose-currency').val(selectedCurrency).attr('data-value', selectedValue);

                // Update the displayed selected option
                var selectedOption = $(this).html();
                $('.buysell-cc-choosen').html(selectedOption);

                // Remove the "selected" class from all options
                $('.buysell-cc-item').removeClass('selected');

                // Add the "selected" class to the clicked option
                $(this).closest('.buysell-cc-item').addClass('selected');
            });

        $('.scan').click(function(e) {
            e.preventDefault();
            $('#scan').modal('show');
            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code Scanned = ${decodedText}`, decodedResult);
                $('#buysell-phone').val(decodedText);
                runPhoneCheck(decodedText);
                $('#scan').modal('hide');
            }
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10
                    , qrbox: 250
                });
            html5QrcodeScanner.render(onScanSuccess);

        });

        $('#buysell-phone').on('input', function() {
        var phoneNumber = $(this).val();
        
        if (phoneNumber.length === 11) {
            runPhoneCheck(phoneNumber);
        } else {
            $('#user_name').text('');
        }
    });
    });

    function runPhoneCheck(phoneNumber)
    {   
            $.ajax({
                url: '/user/'+phoneNumber,
                type: 'GET',
                data: {
                    phone_number: phoneNumber
                },
                success: function(response) {
                    console.log(response);
                    $('#user_name').text(response.data.name);
                },
                error: function() {
                    $('#user_name').text('Error fetching user name');
                }
            });
    }

</script>

@endpush

@push('styles')
@endpush
