<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Topazdom Technologies Limited">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base For Recycling System.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset("images/favicon.png") }}">
    <!-- Page Title  -->
    <title>@yield('title') | {{ config('app.name', 'SRS Projects') }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset("assets/css/dashlite.css?ver=3.1.3") }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset("assets/css/theme.css?ver=3.1.3") }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    {{--
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Styles -->
    {{--
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    @livewireStyles
    @stack('styles')
    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
</head>

<body class="nk-body npc-crypto bg-white has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('layouts.partials.sidebar')
            <!-- sidebar @e -->

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                @include('layouts.partials.header')
                <!-- main header @e -->

                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            @include('components.toast')
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- content @e -->

                <!-- footer @s -->
                @include('layouts.partials.footer')
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->

        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    @stack('modals')
    <!-- JavaScript -->
    <script src="{{ asset("assets/js/bundle.js?ver=3.1.3") }}"></script>
    <script src="{{ asset("assets/js/scripts.js?ver=3.1.3") }}"></script>
    <script src="{{ asset("assets/js/charts/chart-srs.js?ver=3.1.3") }}"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>