@extends('templates.headandfoot')
@section('title')
Registration
@endsection
@section('content')
<script src="{{asset('viewjs/registration.js')}}"></script>
<div style="margin:auto;width:80%;text-align:left;margin-top:2%; border-style:solid; border-width:1px;padding:5%;">
    <h3>Registration</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="post" action="{{route('registacc')}}" id="form">
        @csrf
    <button type="button" class="btn btn-primary" style="width:100px" onclick="registtype('userselection')" id="userselection" >User</button>
<button type="button" class="btn btn-secondary" style="width:100px" onclick="registtype('restoselection')" id="restoselection" >Restaurant</button><br>
    <label for="username">Enter your username:</label><br>
    <input type="text" class="form-control" id="username" name="name"> <br>
    <label for="email"> Enter your email:</label><br>
    <input type="email" class="form-control" id="email" name="email"><br>
    <label for="password"  id="password"> Enter your password:</label><br>
    <input type="password" class="form-control" id="password" name="password"><br>
    <div id="userselectionarea"> 
    <label for="dob"> Enter your date of birth:</label><br>
    <input type="date" class="form-control" id="dob" name="dob"><br><br>
</div>
    <div id="restoselectionarea" style="display:none">
    <label for="location"> Enter your location: </label><br>
    <textarea id="location" name="location" row="4" column="50"></textarea><br><br>
</div>

    <input class="btn btn-success" type="submit" id="submit" name="submit"><br>
</form>
</div>
@endsection