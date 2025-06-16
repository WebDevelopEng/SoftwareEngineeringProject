@extends('templates.headandfoot')
@section('title')
    My Recipes
@endsection
@section('content')
<script src="{{asset('viewjs/menudashboard.js')}}"></script>
<link href="{{asset('viewcss/recipepage.css')}}" rel="stylesheet">
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
<h2> My Recipes </h2>
@else
<h2> Search </h2>
@endif

<div style="display:flex;width:100%;margin:auto;margin-top:2%;">
@foreach($collection as $recipe)
    @php
      $imageurl="/storage/recipeimages/".$recipe->image;
      $recipeurl="/viewrecipe/".$recipe->RecipeID;
      $editurl="/editrecipe/".$recipe->RecipeID;
    @endphp
  <div class="card" style="width: 18rem;min-height:300px;">
  <img style="width:100%;height:150px;object-fit:fill" src="{{$imageurl}}" alt="Card image cap"/>
  <div class="card-body">
    <h5 class="card-title">{{$recipe->Name}}</h5>
    <div class="btn btn-info">{{$recipe->category}}</div>
    <p class="card-text">{{Str::limit($recipe->Description,25)}}</p>
  </div>
  <div style="width:fit-content">
    <div style="width:80%;text-align:center;font-size:0.8em;display:flex; padding">
                    <a class="btn btn-dark" style="font-size:1em" href="{{$recipeurl}}" ><i class="fa-solid fa-eye"></i> View </a>
                    <a class="btn btn-info" style="font-size:1em" href="{{$editurl}}" ><i class="fas fa-edit"></i> Edit </a>
                    <a class="btn btn-danger" style="font-size:1em" href="{{route('deleterecipe',['id'=>$recipe->RecipeID])}}">Delete</a>
        </div>
</div>
</div>
@endforeach
</div>
</div>
{{ $collection -> links()}}
@endsection