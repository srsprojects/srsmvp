@if(session('success'))
    @if(session('toast'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                        // Code to execute when the document has finished loading
                        toastr.success("<?php echo session('success'); ?>",'',{
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "timeOut": "10000",
          "extendedTimeOut": "5000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        });
                    });
        </script>
    @endif
    <div class="alert alert-success alert-dismissible">
        <button class="close" data-dismiss="alert" aria-label="close"></button>
        <strong>Success!</strong> {{ session('success') }}.
      </div>
@elseif (session('error'))
    @if(session('toast'))
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
                // Code to execute when the document has finished loading
                toastr.error("<?php echo session('error'); ?>",'',{
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "timeOut": "10000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    });
            });
    </script>
    @endif

    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
        <strong> Error, Oops!</strong> {{ session('error') }}.
      </div>
@endif
