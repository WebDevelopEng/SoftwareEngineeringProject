<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href="{{asset('viewcss/simpleheader.css')}}" rel="stylesheet">
<link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
<script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>
<body>
<div class="navbar navbar-light bg-light navigationbar">
        <div class="navigationbar-main">
        <div class="navbar-button"> DonaCook </div>
        <div class="navigationbar-main">
        <div><a href="{{route('menu')}}"> Menus </a> </div>
        <div><a href="{{route('bookmarks')}}"> Bookmarks </a></div>
        <div><a href="{{route('donate')}}"> Donate</a></div>
        <div><a href="{{route('restaurants')}}"> Restaurants </a> </div>
        </div>
        </div>
        <div class="navigationbar-profile">
        <div><a href="{{route('profile')}}">Profile</a></div>
        <div><a href="{{route('login')}}">Login </a></div>
</div>
</div>
<div>
    <form method="post" action="{{route('registacc')}}">
        @csrf
    <label for="username">Enter your username:</label>
    <input type="text" id="username" name="name"> 
    <label for="email"> Enter your email:</label>
    <input type="email" id="email" name="email">
    <label for="password" id="password"> Enter your password:</label>
    <input type="password" id="password" name="password">
    <label for="dob"> Enter your date of birth:</label>
    <input type="date" id="dob" name="dob">
    <input type="submit" id="submit" name="submit">
</form>
</div>

</body>
</html>