<!DOCTYPE html>
<html lang="en">
<head>
    <title>Donau Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/uniform.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/matrix-media.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
    <link rel="stylesheet" href="{{ asset('fonts/backend_fonts/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/jquery.gritter.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/sweetalert2.min.css') }}" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body onload="blink()">

@include('layouts.adminLayout.admin_header')

@include('layouts.adminLayout.admin_sidebar')

@yield('content')

@include('layouts.adminLayout.admin_footer')



</body>
</html>
