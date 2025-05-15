@extends('templates.headandfoot')
@section('title')
    Menu Dashboard
@endsection
@section('content')
<script src="{{asset('viewjs/menudashboard.js')}}"></script>
<link href="{{asset('viewcss/recipepage.css')}}">
<div class="carousel">
</div>

@foreach($collection as $recipe)
    @php
    @endphp
    <div class="">
        <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap"/>
  <div class="card-body">
    <h5 class="card-title">$recipe->title</h5>
    <p class="card-text">$recipe->description</p>
  </div>
  <div class="card-body">
    <a href="viewrecipe/{{$recipe->id}}" class="card-link">Card link</a>
  </div>
</div>
</div>
@endforeach
{{ $collection -> links}}
@endsection