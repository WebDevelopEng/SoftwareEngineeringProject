@extends('templates.headandfoot')
@section('title')
    Profile Page
@endsection
@section('content')
    @if (isset($restaurant))
    <div style="width:60%;margin:auto;min-height:1200px;">
        <div style="width:40%;">
        <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;"><img src="storage/{{$restaurant->picture}}"></div>
     </div>
    </div>
    @endif
    @if (isset($user))
    <div style="width:60%;margin:auto;height:1200px;">
        <div style="width:40%;">
        @if($user->picture == null)
        <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;"><img src='storage/{{$user->picture}}'></div>
     </div>
     <div style="width:60%;">
        <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;">
            <b>Username</b>: $user->name
            <b>Email</b> : $user->email
            <b>Date of Birth</b>: $user->dob
            <b>Balance</b>: $user->balance
</div>
</div>
    </div>
    @endif
    @if(isset($admin))
     <div style="width:60%;margin:auto;height:1200px;display:flex;">
        <div style="width:40%;">
            <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;"><img src="storage/{{$admin->picture}}"></div>
     </div>
     <div style="width:60%;">
       
</div>
</div>
    @endif
@endsection