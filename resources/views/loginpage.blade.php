@extends('templates.headandfoot')
@section('title')
Login
@endsection
@section('content')
<script src="{{asset('/viewjs/loginpage.js')}}"></script>
<div style="margin:auto;width:80%;text-align:center;margin-top:10%; border-style:solid; border-width:1px;padding:5%;">
<form method="post" action="{{route('loginacc')}}" id="form">
    @csrf
<h3>Login</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<button type="button" class="btn btn-primary" style="width:100px" onclick="logintype('userselection')" id="userselection" >User</button>
<button type="button" class="btn btn-secondary"  style="width:100px" onclick="logintype('adminselection')" id="adminselection" >Admin</button>
<button type="button" class="btn btn-secondary" style="width:100px" onclick="logintype('restoselection')" id="restoselection" >Restaurant</button><br>
<label for="email">Enter your email:</label><br>
<input type="email" id="email" name="email"><br>
<label for="password">Enter your password:</label><br>
<input type="password" id="password" name="password"><br><br>
<input type="text" style="display:none" name="hidden" id="hidden" value="userselection">
<input type="submit">
</form>
<a href="{{route('register')}}">No account yet? Register now !</a>
</div>
@endsection