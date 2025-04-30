<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
</head>
<nk href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href="{{asset('viewcss/simpleheader.css')}}" rel="stylesheet">
<link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
<script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>li

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
    <div class="menuoverview" style="border-radius:20px;border-style:solid;border-color:black;border-width:1px;padding-top:1%;">
        <h3 class="title" style="margin-bottom:2%;">Salmon Beurre Blanc </h3>
        <div class="foodimagecontainer">
            <img style="position:absolute;object-fit:fill;width:inherit;height:inherit;filter:blur(10px)grayscale(100);" src="{{asset('salmonbeurreblanc.jpg')}}"> 
        <img style="position:relative;vertical-align:middle;width:100%;height:100%;object-fit:none;" src="{{asset('salmonbeurreblanc.jpg')}}"></div>
    <div class="tablerowcontainer">
        <div class="halfwidth">
        <h5> Taste Rating: </h5>
        
</div>
    <div class="halfwidth" style="border-left:solid;border-width:2px;border-color:black;">
    <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star-half"></i>
</div>
</div>
    <div class="tablerowcontainer">
    <div class="halfwidth">
        <h5>Difficulty Rating:</h5>
        </div>
    <div class="halfwidth" style="border-left:solid;border-width:2px;border-color:black;">
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star"></i>
        <i class="fa-regular fa-star-half"></i>
        </div>
</div>
    </div>
    </div>
        <div class="menucontent">
            <div style="width:50%; position:relative;">
        </div>
        <div style="width:50%; position:relative;border-left:5px solid black;">
</div>


        </div>


    </div>
</body>
</html>