<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <title>@yield('title')</title>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        {{-- <link href="{{ asset('css/fonts/cssb2c8.css?family=Roboto:300,400,400i,500,500i,700,700i,900&amp;display=swap') }}" rel="stylesheet"> --}}
        
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/mite-assets.min.css') }}"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    </head>
    <body>

        <!-- Container -->
        <div id="container">
            <!-- error section 
                ================================================== -->
            <section class="error-section">
                <div class="container">
                    <div class="error-box">
                        <h1>@yield('code')</h1>
                        <h2>@yield('message')</h2>
                        <p>@yield('detail')</p>
                        <a class="button-one" href="{{ url('/') }}">Go To HomePage</a>
                    </div>
                </div>
            </section>
            <!-- End error section -->
        </div>

        <div class="preloader">
            <img alt="" src="{{ asset('images/loader.gif') }}">
        </div>
        
        <script src="{{ asset('js/mite-plugins.min.js') }}"></script>
        {{-- <script src="{{ asset('js/popper.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
        <script src="{{ asset('js/script.js') }}"></script>
        
    </body>
</html>