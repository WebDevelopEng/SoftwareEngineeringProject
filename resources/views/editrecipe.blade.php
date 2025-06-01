@extends('templates.headandfoot')
@section('title')
    Edit Recipe
@endsection
@section('content')
@php
    $imagelink='/storage/recipeimages/'.$recipe->image;
@endphp
<script src="{{asset('viewjs/createmenu.js')}}"></script>
<link href="{{asset('viewcss/createmenu.css')}}" type="stylesheet">
    <div class="form-group" style="width:60%;margin:auto;border-style:solid;border-width:1px;border-color:black;">
    <div style="width:80%;margin:auto">

    <h3 style="padding-top:3%;padding-bottom:3%">Edit Recipe</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="post" action="{{route('updaterecipe',['i' => $recipe->RecipeID])}}" enctype="multipart/form-data">
        @csrf
    <label for="name">Recipe Name:</label>
    <br>
    <input type="text" style="width:100%;" id="name" placeholder="Input the name of your recipe" name="name" value="{{$recipe->Name}}" >
    <br>
    <label for="category">Food Category</label>
    <select class="form-select" name="category" id="category">
        <option value="Seafood">Seafood</option>
        <option value="Noodles">Noodles</option>
        <option value="Rice">Rice</option>
        <option value="Snacks">Snacks</option>
    </select>
    <br>
    <label for="description">Description:</label>
    <br>
    <textarea class="form-control" id="description" name="description" rows="4" cols="50" placeholder="Enter your description"> {{$recipe->Description}}</textarea>
    <label for="ingredients">Ingredients:</label>
    <textarea class="form-control" id="ingredients" name="ingredients" rows="4" cols="50" placeholder="Enter your ingredients" >{{$recipe->Ingredients}}</textarea>
    Premium Setup:
    <div class="form-check">
    
    <input class="form-check-input" type="radio"  name="premium" id="radio1" value='1'>  <label class="form-check-label" for="radio1">Premium</label></div><div class="form-check"><input class="form-check-input" type="radio"  name="premium" id="radio1" value='0'>
    <label class="form-check-label" for="radio2">Non Premium</label> </div>
    <div>
        <input type="file" style="display:block;width:50%;" accept="image/*" onchange="imagepreview(this,'previewimage')" name="image" id="imageupload">
        <img style="width:50%;display:block;" class='preview' src="{{$imagelink}}" id="previewimage">
    </div>
    <input type="string" style="display:none" value="{{$recipe->restaurant_id}}" name="restaurant_id">
    <button class="btn btn-success" type="submit" style="margin-top:3%;margin-bottom:3%;">Submit</button>
    <a class="btn btn-danger" href="{{route('deleterecipe',['id'=>$recipe->RecipeID])}}">Delete Recipe</a>
</div>
</div>

</form>
<br>

</div>
@endsection