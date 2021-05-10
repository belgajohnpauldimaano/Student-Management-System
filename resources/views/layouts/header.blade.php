<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="private school" name="keywords">
    <meta content="St. John's Academy Inc., formerly known as Saint John Academy, is a private Roman Catholic secondary school in Dinalupihan, Bataan, Philippines. It provides a deeply-rooted Christian formation to the young and supply the volunteers for the Parochial catechetical program at the public schools within the parish. The school is a member of the Diocesan Schools of Bataan (DSOB) and the Catholic Educational Association of the Philippines (CEAP)" name="description">
    <meta name="author" content="Intelliroad Business Solutions">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" 
    integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <!-- Favicons -->
    {{-- <link href="{{ asset('theme/img/favicon.png') }}" rel="icon"> --}}
    {{-- <link href="{{ asset('theme/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}
    <!-- Google Fonts -->
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="{{ asset('theme/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="{{ asset('theme/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    
    <!-- Main Stylesheet File -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('img/sja-logo.png') }}" rel=icon>

    {{-- alertify --}}
    <link rel="stylesheet" href="{{ asset('cms/plugins/alertifyjs/css/alertify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/alertifyjs/css/themes/bootstrap.min.css') }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GRDQMJRGKQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GRDQMJRGKQ');
    </script>
</head>

<body>
    <div id="preloader" class="d-none">
        <img class="preloader" src="{{ asset('img/loader.gif')}}" alt="">
    </div>

    <header id="header">
        <div class="container-fluid">
            <div id="logo" class="pull-left">
                <h1><a href="{{ route('home_page') }}" class="scrollto">St. John's</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu"><a href="{{ route('home_page') }}">Home</a></li>
                    <li class="menu-has-children"><a href="#">About SJAI</a>
                        <ul>
                            <li><a href="{{ route('school_profile') }}">School Profile</a></li>
                            <li><a href="{{ route('vision_mission') }}">Vision  Mission</a></li>
                            <li><a href="{{ route('philosophy') }}">Philosophy</a></li>
                            <li><a href="{{ route('history') }}">History</a></li>
                            <li><a href="{{ route('hymn') }}">Hymn</a></li>
                            <li><a href="{{ route('award_recognition') }}">Awards & Recognition</a></li>
                            <li><a href="{{ route('administration_offices') }}">Administration & Offices</a></li>
                            <li><a href="{{ route('faculty_staff') }}">Faculty and Staff</a></li>
                        </ul>
                    </li>                    
                    <li class="menu-has-children"><a href="#">Students</a>
                        <ul>
                            <li><a href="{{ route('students_organizations') }}">Students Organizations</a></li>
                            <li><a href="{{ route('students_services_academic') }}">Students Services</a></li>
                            <li><a href="{{ route('publication') }}">Publication</a></li>
                            <li><a href="{{ route('students_council') }}">Students Council</a></li>
                            <li><a href="{{ route('students_handbook') }}">Students Handbook</a></li>
                        </ul>
                    </li>                    
                    <li class="menu"><a href="{{ route('facilities') }}">Facilities</a></li>
                    <li class="menu-has-children"><a href="#">FAQs</a>
                        <ul>
                            <li>
                                <a href="{{route('pages.faqs')}}">
                                    Frequently Asked Questions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pages.faqs_on_distance_learning') }}">
                                    Frequently Asked Questions on Distance Learning
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if($data == 1)
                        <li class="menu">
                            <a class="btn-enroll" data-toggle="modal" data-target="#js-registration"  href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                <i class="fas fa-mouse-pointer"></i> Registration
                            </a>
                        </li>
                    @endif
                    <li class="menu">
                        <a class="btn-login" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                </ul>
            </nav>
            <!-- #nav-menu-container -->
        </div>
    </header>
