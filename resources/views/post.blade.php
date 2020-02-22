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
                            <img src="{{ asset('images/logo.png') }}" alt="">
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
                                    <a class="active" href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <form class="form-search">
                                <input type="search" placeholder="Search:"/>
                            </form>
                                </li>
                                <!-- <li>
                                    <a href="{{ url('/') }}">K-Drama</a>
                                </li>
                                <li>
                                    <a href="index-2.html">Drama OST</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <!-- End Header -->

<!-- blog section 
            ================================================== -->
        <section class="blog-section">
            <div class="container">
                <div class="single-post no-sidebar">
                    <div class="title-single-post">
                        <!-- <a class="text-link" href="#">Lifestyle</a> -->
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="single-post-content">
                        <center><img src="{{ $image }}" style="max-width: 300px;" alt=""></center>
                        <div class="post-content">
                            <div class="post-content-text">
                                <center>
                                <h4>Plot</h4>
                                <p align="justify">{{ $plot }}</p>
                                @if ($ostExist)
                                    <h4>OST</h4>
                                    <a href="{{ url('/ost/' . $ostSlug) }}">Download OST {{ $title }}</a><p></p>
                                @endif
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <center>
                                                <span>
                                                    <strong>Source: </strong>
                                                </span>
                                                </center>
                                            </td>
                                            <td>
                                                <span>
                                                    <strong><a href="http://smalllencode.com">Smallencode</a> & <a href="http://kordramas.com">Kordramas</a></strong>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        @foreach($list as $key => $episode)
                                        <tr>
                                            <!-- <td>{{ $key }}</td> -->
                                            <td>
                                                <center><strong class="episode">Episode {{ $key }}</strong></center>
                                                <center>
                                                360p: 
                                                @if(is_string($episode[0]))
                                                belum tersedia
                                                @else
                                                    @foreach($episode[0] as $server)
                                                    <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                                                    @endforeach
                                                @endif
                                                <br>
                                                480p: 
                                                @foreach($episode[1] as $server)
                                                <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                                                @endforeach
                                                <br>
                                                540p: @foreach($episode[2] as $server)
                                                <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                                                @endforeach
                                                <br>
                                                720p: @foreach($episode[3] as $server)
                                                <a href="{{ $server['link'] }}">{{ $server['server'] }}</a> {{ $loop->last ? '' : '|' }}
                                                @endforeach
                                                </center>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </center>
                            </div>  
                        </div>
                    </div>

                    <div class="advertise-box">
                        <center><iframe data-aa="1330831" src="//acceptable.a-ads.com/1330831" scrolling="no" style="border:0px; padding:0; width:100%; height:100%; overflow:hidden" allowtransparency="true"></iframe></center>
                    </div>
                </div>
            </div>
        </section>
        <!-- End blog section -->

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