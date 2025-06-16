@extends('templates.headandfoot')
@section('title')
Create a Recipe
@endsection

@section('content')

<script src="{{ asset('viewjs/createmenu.js') }}"></script>
<link rel="stylesheet" href="{{ asset('viewcss/createmenu.css') }}">
<div class="form-container">
    <h3>Enter Recipe Information</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('recipecreation') }}" enctype="multipart/form-data">
        @csrf

        <label for="name">Recipe Name:</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Input the name of your recipe">

        <label for="category">Food Category:</label>
        <select name="category" id="category" class="form-select">
            <option value="Seafood">Seafood</option>
            <option value="Noodles">Noodles</option>
            <option value="Rice">Rice</option>
            <option value="Snacks">Snacks</option>
        </select>

        <label for="description">Description:</label>
        <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter your description"></textarea>

        <label for="ingredients">Ingredients:</label>
        <textarea id="ingredients" name="ingredients" class="form-control" rows="4" placeholder="Enter your ingredients"></textarea>

        <label for="premium">Premium Setup:</label>
        <div class="form-check-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="premium" id="radio1" value="1">
                <label class="form-check-label" for="radio1">Premium</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="premium" id="radio2" value="0">
                <label class="form-check-label" for="radio2">Non Premium</label>
            </div>
        </div>

        <label for="imageupload">Upload Image:</label>
        <input type="file" accept="image/*" onchange="imagepreview(this,'previewimage')" name="image" id="imageupload" class="form-control">
        <img class="preview" src="" id="previewimage">

        <button type="submit" class="btn-submit">Submit</button>
    </form>
</div>
@endsection
