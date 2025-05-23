@extends('templates.headandfoot')
@section('title')
    Subscription
@endsection

@section('content')
<script src="{{asset('viewjs/subscription.js')}}"></script>
    <h5>Subscribe to us</h5>
<form method="post" action="{{route('subscribe')}}">
    @csrf
@if(isset($error1))
<div class="alert alert-warning"> Insufficient balance! </div>
@endif
<label for="enddate" >Enter the end date of your subscription</label><br>
<input class="form-control" type="date" id="enddate" name="enddate">
<br>
<button class="btn btn-dark">Submit</button>
</form>
@endsection('content')