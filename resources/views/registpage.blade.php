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
    <form action="{{route('registacc')}}">
        @csrf
    <label for="username">Enter your username:</label>
    <input type="text" id="username"> 
    <label for="email"> Enter your email:</label>
    <input type="email" id="email">
    <label for="password" id="password"> Enter your password:</label>
    <input type="password" id="password" name="password">
    <label for="dob"> Enter your date of birth:</label>
    <input type="date" id="dob" name="dob">
</form>

</body>
</html>