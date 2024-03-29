<!DOCTYPE html>

<html lang="en" class="no-js">
    <head>
        <title>Air Keruh</title>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="{{ asset('css/fonts/cssb2c8.css?family=Roboto:300,400,400i,500,500i,700,700i,900&amp;display=swap') }}" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="{{ asset('css/mite-assets.min.css?v=20200221') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css?v=20200221') }}">

    </head>
    <body>

        <!-- Container -->
        <div id="container">
            <!-- Header
                ================================================== -->
            <header class="clearfix header-style4">
                <div class="logo-place">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png?v=20200221') }}" alt="">
                        </a>
                    </div>
                </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <a class="search-button" href="#"><i class="fa fa-search"></i></a>
                            <form class="form-search">
                                <input type="search" placeholder="Search:"/>
                            </form>
                            <ul class="navbar-nav m-auto">
                                <li>
                                    <a href="{{ url('/') }}">K-Drama</a>
                                </li>
                                 <li>
                                    <a href="{{ url('/ost') }}">Drama OST</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <!-- End Header -->

            <!-- fresh-section2 
                ================================================== -->
            <section class="fresh-section2">
                <div class="container">
                    <div class="title-section text-center">
                        <h1>Drama OST</h1>
                    </div>
                    <div class="fresh-box">
                        <div class="row">
                        @foreach($osts as $ost)
                            <div class="col-lg-2 col-md-6">
                                <div class="news-post standard-post left-align">
                                    <div class="image-holder">
                                        <center><a href="{{ $ost['url'] }}"><img src="{{ $ost['img'] }}" alt=""></a></center>
                                    </div>
                                    <!-- <a class="text-link" href="#">Food</a> -->
                                    <h2>
                                        <center>
                                            <a href="{{ url($ost['url']) }}">{{ $ost['title'] }}</a>    
                                        </center>
                                    </h2>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="pagination-box">
                            <ul class="pagination-list">
                                <!-- <li><a href="{{ url($page == 1 ? '/#' : '/') }}"><<</a></li> -->
                                <li><a href="{{ url($prev ?? '#') }}"><</a></li>
                                <li><a class="active" >{{ $page }}</a></li>
                                <li><a href="{{ url($next ?? '/#') }}">></a></li>
                                <!-- <li><a href="{{ url('/page/' . $last) }}">>></a></li> -->
                            </ul>
                        </div>
                        <div class="advertise-box">
                            <center><iframe data-aa="1330831" src="//acceptable.a-ads.com/1330831" scrolling="no" style="border:0px; padding:0; width:100%; height:100%; overflow:hidden" allowtransparency="true"></iframe></center>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End fresh section -->

            <!-- footer 
                ================================================== -->
            <footer class="dark-style">
                <div class="container">

                    <h1>Mitte</h1>
                    <p class="copyright-line">© Copyright 2019 - All rights reserved.</p>
                    <ul class="social-list">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                    <!-- BEGIN: Powered by Supercounters.com -->


                </div>
                <div style="margin-top: 20px;">
                    <center><script type="text/javascript" src="//widget.supercounters.com/ssl/online_i.js"></script><script type="text/javascript">sc_online_i(1570298,"ffffff","e61c1c");</script><br><noscript><a href="https://www.supercounters.com/">free online counter</a></noscript>
                    </center>
                </div>

            </footer>
            <!-- End footer -->

        </div>
        <!-- End Container -->

        <div class="preloader">
            <img alt="" src="{{ asset('images/loader.gif?v=20200221') }}">
        </div>
        
        <script src="{{ asset('js/mite-plugins.min.js?v=20200221') }}"></script>
        <script src="{{ asset('js/popper.js?v=20200221') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js?v=20200221') }}"></script>
        <script src="{{ asset('js/script.js?v=20200221') }}"></script>
        
    </body>
</html>