@extends('templates.headandfoot')
@section('title')
    Menu Dashboard
@endsection
@section('content')
<script src="{{asset('viewjs/menudashboard.js')}}"></script>
<link href="{{asset('viewcss/recipepage.css')}}">
<div class="carousel">
</div>
<div style="text-align:center;width:80%;margin:auto;">
<label for="searchbar"><h3>Recipe Search</h3>
</label>
<div class="input-group-mb3" style="width:60%;margin:auto;">
<form method="post" action="/menudashboard">
  @csrf
<input type="text" style="width:80%;display:inline-block;" class="form-control" id="searchbar" name="search"><button class="btn btn-dark"><i class="fa fa-search"></i></button>
</form>
</div>
</div>
<div style="border-width:2%;width:80%;margin:auto;">
@if(!isset($state))
<h2> Top Picks </h2>
@else
<h2> Search </h2>
@endif

<div style="display:flex;width:100%;margin:auto;margin-top:2%;">
@foreach($collection as $recipe)
    @php
      $imageurl="/storage/recipeimages/".$recipe->image;
      $recipeurl="/viewrecipe/".$recipe->RecipeID;
    @endphp
  <div class="card" style="width: 18rem;min-height:300px;">
  <img style="width:100%;height:150px;object-fit:fill" src="{{$imageurl}}" alt="Card image cap"/>
  <div class="card-body">
    <h5 class="card-title">{{$recipe->Name}}</h5>
    <p class="card-text">{{Str::limit($recipe->Description,25)}}</p>
  </div>
  <div style="width:fit-content">
  @if($membership==0 and $recipe->premium==1)
    <a class="btn btn-secondary disabled" href="{{$recipeurl}}" class="card-link"><i class="fa-solid fa-lock"></i>  Recipe locked</a>
  @else
    <a class="btn btn-dark"  href="{{$recipeurl}}" class="card-link">View recipe  <i class="fa-solid fa-arrow-right"></i></a>
  @endif
</div>
</div>
@endforeach
</div>
</div>
{{ $collection -> links()}}
@endsection