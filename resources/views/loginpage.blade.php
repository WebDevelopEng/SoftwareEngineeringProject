@extends('templates.headandfoot')
@section('title')
Login
@endsection
@section('content')
<script src="{{asset('/viewjs/loginpage.js')}}"></script>
<link href="{{asset('viewcss/login.css')}}" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<body style="background-color: rgba(255,235,205,1)">
<div class="login-card">
    <form method="post" action="{{route('loginacc')}}" id="form" class="login-form">
        @csrf
        <h3 class="login-title" style="margin:0">Welcome to DonaCook!</h3>
        <p class="login-title">Please LOGIN to your own account!</p>
        <div class="login-tabs">
            <button type="button" class="login-tab" onclick="logintype('userselection')" id="userselection">User</button>
            <button type="button" class="login-tab" onclick="logintype('adminselection')" id="adminselection">Admin</button>
            <button type="button" class="login-tab" onclick="logintype('restoselection')" id="restoselection">Restaurant</button>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
        </div>
        <input type="text" style="display:none" name="hidden" id="hidden" value="userselection">
        <button type="submit" class="btn-submit">Login</button>
    </form>
    <div class="register-link">
        No account yet? <a href="{{route('register')}}">Register now!</a>
    </div>
</div>
</body>
@endsection