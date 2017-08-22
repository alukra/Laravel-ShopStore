<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>Valdez Mobile - @yield('title') </title>
    <link rel="stylesheet" href="{!! asset('backoffice/css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('backoffice/css/app.css') !!}" />
    <link href="{{ asset('backoffice/css/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
    @yield('cssExtras')
</head>
<body class="skin-3">

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('backoffice.layout.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('backoffice.layout.topnavbar')

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@yield('title') </h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <!-- Main view  -->
            @yield('content')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->

<script src="{!! asset('backoffice/js/app.js') !!}" type="text/javascript"></script>
<script src="{{ asset('backoffice/js/jasny/jasny-bootstrap.min.js')}}"></script>
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!};
</script>
@section('scriptsExtras')
@show

</body>
</html>
