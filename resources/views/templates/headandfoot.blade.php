<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="{{asset('viewcss/header.css')}}" rel="stylesheet">
        <link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>
</head>

<body>
{{--header--}}
<nav class="navbar navbar-expand-lg navbar-custom" id="header">
        <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('homepage') }}">
                         <img src="{{asset('photo/logo.png')}}" alt="Logo" style="height: 40px; margin-right: 5px;">
                        DonaCook
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <a class="nav-link" href="{{ route('menudashboard') }}">Recipes</a>
                                </li>

                                @if (Session::get('user'))
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('bookmarks') }}">Bookmarks</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('donate') }}">Donate</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('restaurants') }}">Restaurants</a>
                                </li>
                                @elseif (Session::get('restaurant'))
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('recipecreation') }}">Create a Recipe</a>
                                </li>
                                @elseif (Session::get('admin'))
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('restaurants') }}">Restaurants</a>
                                </li>
                                @endif
                        </ul>
                        <ul class="navbar-nav">
                                @if (Session::get('user') || Session::get('restaurant') || Session::get('admin'))
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                </li>
                                @else
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                                @endif
                        </ul>
                </div>
        </div>
</nav>

{{--content--}}
<div class="container-fluid" id="content">
        @yield('content')
</div>

{{--footer--}}
<div class="container-fluid" id="footer">
        <div class="row">
                <div class="col">
                        <hr>
                        <ul class="navbar-nav navbar-custom mb-2 mb-lg-0">
                                <img src="{{asset('photo/logo.png')}}" alt="DonaCookLogo" class="img-fluid" style="max-width: 60px;">
                                <li class="nav-item me-4"><a class="nav-link" href="/">Home</a></li>
                                <li class="nav-item me-4"><a class="nav-link" href="aboutus">About Us</a></li>
                                <li class="nav-item me-4"><a class="nav-link" href="contactus">Contact Us</a></li>
                        </ul>
                        <hr>
                </div>
        </div>
        <div class="row">
            <div class="col text-center" style="color: white">
                &copy;2025 DonaCook. All Right Reserved
            </div>
            <br>
            <br>
        </div>
</div>

</body>
</html>