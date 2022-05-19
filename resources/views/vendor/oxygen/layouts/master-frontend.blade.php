<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Sign up for your free trial now!')">

    <title>@yield('pageTitle', 'EM Project')</title>

    {{-- Fonts --}}
    <link
            href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
            rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>

    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

    {{-- Application CSS --}}
    <link rel="stylesheet" href="/css/theme/creative.css" type="text/css">

    <link rel="stylesheet" href="{{ mix('css/dist/public.css') }}"/>

    @stack('meta')

    @include('oxygen::partials.tracking')
</head>

<body id="page-top" class="front-end">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <nav class="navbar">
        <a href="{{ route('home') }}">
            <span class="navbar-brand mb-0 h1">{{ (empty($appName))? config('app.name'): $appName }}</span>
        </a>
    </nav>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    More
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/privacy-policy">Privacy</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/terms-conditions">Terms & Conditions</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="/faqs">FAQs</a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/privacy-policy">Privacy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact-us">Contact Us</a>
            </li>
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            @endguest
        </ul>

    </div>
</nav>

@yield('contents')

@if (empty($noHeaderFooter))
    @include('oxygen::partials.footer')
@endif

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.min.js"></script>

@yield('scripts')
</body>
</html>