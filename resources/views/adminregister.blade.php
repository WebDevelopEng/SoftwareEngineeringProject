@extends('templates.headandfoot')
@section('title')
Admin Register
@endsection
@section('content')
<div style="margin:auto;width:80%;text-align:left;margin-top:2%; border-style:solid; border-width:1px;padding:5%;">
    <h3>Admin Registration</h3>
    <form method="post" action="{{route('adminregist')}}" id="form">
        @csrf
    <label for="username">Enter your username:</label><br>
    <input type="text" class="form-control" id="username" name="name"> <br>
    <label for="email"> Enter your email:</label><br>
    <input type="email" class="form-control" id="email" name="email"><br>
    <label for="password"  id="password"> Enter your password:</label><br>
    <input type="password" class="form-control" id="password" name="password"><br>
    <input class="btn btn-success" type="submit" id="submit" name="submit"><br>
</form>
</div>
@endsection