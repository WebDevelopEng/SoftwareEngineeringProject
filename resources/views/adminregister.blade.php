@extends('templates.headandfoot')
@section('title')
Admin Register
@endsection
@section('content')
<link href="{{asset('viewcss/login-register.css')}}" rel="stylesheet">
<body style="background-color: rgba(255,235,205,1)">
    <div class="login-card">
        <form method="post" action="{{route('adminregist')}}" id="form" class="login-form">
            @csrf
            <h3 class="login-title" style="margin:0">Admin Registration</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="username">Enter your username:</label>
                <input type="text" class="form-control" id="username" name="name" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            {{--<input class="btn btn-success" type="submit" id="submit" name="submit">--}}
            <button type="submit" class="btn-submit">Register</button>
        </form>
    </div>
</body>
@endsection