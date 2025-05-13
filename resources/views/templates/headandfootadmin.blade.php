

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href="{{asset('viewcss/simpleheader.css')}}" rel="stylesheet">
<link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
<script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>
</head>

<body>
<div class="navbar navbar-light bg-light navigationbar">
        <div class="navigationbar-main">
        <div class="navbar-button"> DonaCook </div>
        <div class="navigationbar-main">
        <div><a href="{{route('menu')}}"> Menus </a> </div>
        
    

    
        

</div>
</div>
@yield('content')

</body>
</html>