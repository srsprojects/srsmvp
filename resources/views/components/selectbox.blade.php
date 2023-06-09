<div class="buysell-field form-group">
    <div class="form-label-group">
        <label class="form-label">Choose choose bank to withdraw to:</label>
    </div>
    <input type="hidden" value="btc" name="bs-bank" id="buysell-choose-currency">
    <div class="dropdown buysell-cc-dropdown">
        <a href="#" class="buysell-cc-choosen dropdown-indicator" data-bs-toggle="dropdown">
            <div class="coin-item coin-btc">
                <div class="coin-icon">
                    <em class="icon ni ni-building-fill"></em>
                </div>
                <div class="coin-info">
                    <span class="coin-name">Select Bank</span>
                    <span class="coin-text">Nigerian banks, and CBN Code</span>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-auto dropdown-menu-mxh">
            <ul class="buysell-cc-list">
                <li class="buysell-cc-item selected">
                    <a href="#" class="buysell-cc-opt" data-currency="btc">
                        <div class="coin-item coin-btc">
                            <div class="coin-icon">
                                <em class="icon ni ni-building-fill"></em>
                            </div>
                            <div class="coin-info">
                                <span class="coin-name">Select Bank</span>
                                <span class="coin-text">Nigerian banks, and CBN Code</span>
                            </div>
                        </div>
                    </a>
                </li>
                @forelse ( getAllNigerianBanks() as $bank )
                <li class="buysell-cc-item">
                    <a href="#" class="buysell-cc-opt" data-value="{{ $bank->code }}" data-currency="{{ $bank->code }}">
                        <div class="coin-item coin-{{ $bank->code }}">
                            <div class="coin-icon">
                                <em class="icon ni ni-building-outline"></em>
                            </div>
                            <div class="coin-info">
                                <span class="coin-name">{{ $bank->name }}</span>
                                <span class="coin-text">{{ $bank->code }}</span>
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
                                <span class="coin-name">No Banks Fetched</span>
                                <span class="coin-text">Check You Internet Connection and Refresh Page</span>
                            </div>
                        </div>
                    </a>
                </li>
                @endforelse
            </ul>
        </div><!-- .dropdown-menu -->
    </div><!-- .dropdown -->
</div><!-- .buysell-field -->

@push('scripts')
    <script>
        function handlePay(event) {
            event.preventDefault(); // Prevent the form from submitting

            payment_method = document.forms["deposit"]["bs-method"].value;

            switch (payment_method) {
                case 'card':
                    makeCardPayment();
                    break;

                default:
                    break;
            }
        }
    </script>
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
});