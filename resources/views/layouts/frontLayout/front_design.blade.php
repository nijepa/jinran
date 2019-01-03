<!DOCTYPE html>
<html lang="en">
<head>
    <title>Donau trade - Business Meetings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('css/frontend_css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/responsee.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/template-style.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,700,900&amp;subset=latin-ext" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/frontend_css/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/owl-carousel/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/css/lightcase.css') }}">



    <link rel="stylesheet" href="{{ asset('css/frontend_css/footable.standalone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/footable.standalone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/FooTable.FontAwesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/FooTable.Glyphicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/FooTable.css') }}">

</head>
<body>

@include('layouts.frontLayout.front_sidebar')

@yield('content')



@include('layouts.frontLayout.front_footer')

@include('layouts.frontLayout.front_scripts')

</body>
</html>