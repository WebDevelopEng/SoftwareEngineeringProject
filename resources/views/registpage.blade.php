@extends('templates.headandfoot')
@section('title')
Registration
@endsection
@section('content')
<script src="{{asset('viewjs/registration.js')}}"></script>
<link href="{{asset('viewcss/login-register.css')}}" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<body style="background-color: rgba(255,235,205,1)">
<div class="login-card">
    <form method="post" action="{{route('registacc')}}" id="form"  class="login-form">
        @csrf
        <h3 class="login-title" style="margin:0">Welcome to DonaCook!</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login-tabs">
            <button type="button" class="login-tab" onclick="registtype('userselection')" id="userselection" >User</button>
            <button type="button" class="login-tab" onclick="registtype('restoselection')" id="restoselection" >Restaurant</button>
        </div>
        <div class="form-group">
            <label for="username">Enter your username:</label>
            <input type="text" class="form-control" id="username" name="name">
        </div>
        <div class="form-group">
            <label for="email"> Enter your email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password"  id="password"> Enter your password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <div id="userselectionarea"> 
            <label for="dob"> Enter your date of birth:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>

        <div class="form-group">
            <div id="restoselectionarea" style="display:none">
            <label for="location"> Enter your location: </label>
            <textarea id="location" name="location" row="4" column="50"></textarea>
            </div>
        </div>

        <input type="text" style="display:none" name="hidden" id="hidden" value="userselection">
        <button type="submit" class="btn-submit">Register</button>
    </form>
</div>
</div>
</body>
@endsection