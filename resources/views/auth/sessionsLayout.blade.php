<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Valdez Mobile - @yield('title') </title>
  <link rel="stylesheet" href="{!! asset('backoffice/css/vendor.css') !!}" />
  <link rel="stylesheet" href="{!! asset('backoffice/css/app.css') !!}" />
  @yield('cssExtras')
</head>
<body class="gray-bg">

  @yield('content')

  <script src="{!! asset('backoffice/js/app.js') !!}" type="text/javascript"></script>
  @section('scriptsExtras')
  @show
</body>
</html>
