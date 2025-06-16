@extends('templates.headandfoot')
@section('title')
    Edit Recipe
@endsection
@section('content')

<script src="{{ asset('viewjs/createmenu.js') }}"></script>
<link href="{{ asset('viewcss/editrecipe.css') }}" rel="stylesheet">

@php
    $imagelink = '/storage/recipeimages/' . $recipe->image;
@endphp

<div class="form-container">
    <div>
        <h3>Edit Recipe</h3>
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('updaterecipe', ['i' => $recipe->RecipeID]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Recipe Name:</label>
                <input type="text" id="name" name="name" placeholder="Input the name of your recipe" value="{{ $recipe->Name }}">
            </div>
            <div class="form-group">
                <label for="category">Food Category:</label>
                <select class="form-select" name="category" id="category">
                    <option value="Seafood" {{ $recipe->category == 'Seafood' ? 'selected' : '' }}>Seafood</option>
                    <option value="Noodles" {{ $recipe->category == 'Noodles' ? 'selected' : '' }}>Noodles</option>
                    <option value="Rice" {{ $recipe->category == 'Rice' ? 'selected' : '' }}>Rice</option>
                    <option value="Snacks" {{ $recipe->category == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter your description">{{ $recipe->Description }}</textarea>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients:</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="4" placeholder="Enter your ingredients">{{ $recipe->Ingredients }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Premium Setup:</label>
                <select class="form-select" name="premium" id="premium">
                    <option value="1" {{ $recipe->premium == 1 ? 'checked' : '' }}>Premium</option>
                    <option value="0" {{ $recipe->premium == 0 ? 'checked' : '' }}>Non Premium</option>
                </select>
            </div>
            <div class="form-group">
                <label for="imageupload">Upload Image:</label>
                <input type="file" accept="image/*" onchange="imagepreview(this,'previewimage')" name="image" id="imageupload">
                <img class="img-preview" src="{{ $imagelink }}" id="previewimage" alt="Recipe Image Preview">
            </div>
            <input type="hidden" name="restaurant_id" value="{{ $recipe->restaurant_id }}">
            <div class="form-group" style="text-align: center;">
                <button class="btn btn-success" type="submit">Submit</button>
                <a class="btn btn-danger" href="{{ route('deleterecipe', ['id' => $recipe->RecipeID]) }}">Delete Recipe</a>
            </div>
        </form>
    </div>
</div>
@endsection
