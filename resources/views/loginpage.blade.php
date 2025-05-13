@extends('templates.headandfoot')
@section('title')
Login
@endsection
@section('content')
<div style="margin:auto;width:80%;text-align:center;margin-top:10%; border-style:solid; border-width:1px;padding:5%;">
<form method="post" action="{{route('loginacc')}}">
    @csrf
<h3>Login</h3>
<label for="email">Enter your email:</label><br>
<input type="email" id="email" name="email"><br>
<label for="password">Enter your password:</label><br>
<input type="password" id="password" name="password"><br><br>
<input type="submit">
</form>
<a href="{{route('register')}}">No account yet? Register now !</a>
</div>
@endsection