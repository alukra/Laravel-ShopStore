<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | Valdez Mobile </title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,800&amp;subset=cyrillic,latin'>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,300italic" rel="stylesheet" type="text/css">

    <!-- CSS Global Compulsory -->
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/bootstrap/css/bootstrap.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('frontpage/css/shop.style.css' ) }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/blocks.css' ) }}">

    <!-- CSS Header and Footer -->
  	<link rel="stylesheet" href="{{ asset('frontpage/css/headers/header-v5.css')}}">
  	<link rel="stylesheet" href="{{ asset('frontpage/css/footers/footer-v4.css')}}">

    <!-- CSS Implementing Plugins -->
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/animate.css')}}">
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/line-icons/line-icons.css')}}">
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/font-awesome/css/font-awesome.min.css')}}">
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/scrollbar/css/jquery.mCustomScrollbar.css')}}">
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/owl-carousel/owl-carousel/owl.carousel.css')}}">
  	<link rel="stylesheet" href="{{ asset('frontpage/plugins/revolution-slider/rs-plugin/css/settings.css')}}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/plugins/style-switcher.css')}}">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="{{ asset('frontpage/css/theme-colors/default.css')}}" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="{{ asset('frontpage/css/custom.css')}}">

    @yield('cssExtras')

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim || (function(d, s) {
        var z = $zopim = function(c) {
                z._.push(c)
            },
            $ = z.s =
            d.createElement(s),
            e = d.getElementsByTagName(s)[0];
        z.set = function(o) {
            z.set.
            _.push(o)
        };
        z._ = [];
        z.set._ = [];
        $.async = !0;
        $.setAttribute("charset", "utf-8");
        $.src = "//v2.zopim.com/?3wjJawpSFM3DyqaIYLgd1LbstqII0kCm";
        z.t = +new Date;
        $.
        type = "text/javascript";
        e.parentNode.insertBefore($, e)
    })(document, "script");
    </script>
    <!--End of Zopim Live Chat Script-->
  </head>
  <body  class="header-fixed">
    <div class="wrapper">
      @include('frontpage.layout.header')

      @yield('content')

      @include('frontpage.layout.suscribe')
      @include('frontpage.layout.footer')

    </div>
    @include('frontpage.layout.suscribepop')
    <!-- JS Global Compulsory -->
    <script src="{{ asset('frontpage/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/jquery/jquery-migrate.min.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- JS Implementing Plugins -->
    <script src="{{ asset('frontpage/plugins/back-to-top.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/smoothScroll.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/jquery.parallax.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/owl-carousel/owl-carousel/owl.carousel.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{ asset('frontpage/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- JS Customization -->
    <script src="{{ asset('frontpage/js/custom.js')}}"></script>
    <!-- JS Page Level -->
    <script src="{{ asset('frontpage/js/shop.app.js')}}"></script>
    <script src="{{ asset('frontpage/js/plugins/owl-carousel.js')}}"></script>
    <script src="{{ asset('frontpage/js/plugins/revolution-slider.js')}}"></script>
    <script src="{{ asset('frontpage/js/plugins/style-switcher.js')}}"></script>
    @section('scriptsExtras')
    <script>
    	jQuery(document).ready(function() {
    		App.init();
    		App.initScrollBar();
    		App.initParallaxBg();
    		OwlCarousel.initOwlCarousel();
    		RevolutionSlider.initRSfullWidth();
    		StyleSwitcher.initStyleSwitcher();
        APP_URL = {!! json_encode(url('/')) !!};
    	});
    </script>
  </body>
</html>
