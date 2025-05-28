

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href="{{asset('viewcss/simpleheader.css')}}" rel="stylesheet">
<link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="navbar navbar-light bg-light navigationbar">
        <div class="navigationbar-main">
        <div class="navbar-button" style="padding-left:2%;"> DonaCook </div>
        <div><a href="{{route('menudashboard')}}"> Menus </a> </div>
        @if (Session::get('user'))
        <div><a href="{{route('subscription')}}"> Subscription </a></div>
        <div><a href="{{route('donate')}}"> Donate</a></div>
        <div><a href="{{route('viewtransaction')}}"> Transaction </a></div>
        </div>
        <div class="navigationbar-profile">
        <div><a href="{{route('profile')}}">Account</a></div>
        <div><a href="{{route('logout')}}">Logout </a></div>
</div>
        @elseif(Session::get('restaurant'))
        <div><a href="{{route('recipecreation')}}">Create a Recipe</a></div>
        <div><a href="{{route('allmyrecipes')}}">My Recipes</a></div>
        <div><a href="{{route('donate')}}">Donations</a></div>
</div>
        <div class="navigationbar-profile">
        <div><a href="{{route('profile')}}">Account</a></div>
        <div><a href="{{route('logout')}}">Logout</a></div>
</div>
        @elseif(Session::get('admin'))
        <div><a href="{{route('addashboard')}}">Ads</a></div>
        <div><a href="{{route('donate')}}">Donations</a></div>
        <div><a href="{{route('admrecipes')}}">Recipes</a></div>
</div>
        <div class="navigationbar-profile">
        <div><a href="{{route('profile')}}">Account</a></div>
        <div><a href="{{route('logout')}}">Logout </a></div>
</div>
        @else
</div>
        <div class="navigationbar-profile">
        <div><a href="{{route('login')}}">Login </a></div>
</div>
        @endif
</div>
</div>
@yield('content')

</body>
</html>