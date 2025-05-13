@extends('templates.headandfoot')
@section('title')
Create a recipe
@endsection
@section('content')
<script src="{{asset('viewjs/createmenu.js')}}"></script>
<link href="{{asset('viewcss/createmenu.css')}}" type="stylesheet">
    <div class="form-group" style="width:60%;margin:auto;border-style:solid;border-width:1px;border-color:black;">
    <div style="width:80%;margin:auto">

    <h3 style="padding-top:3%;padding-bottom:3%">Enter Recipe Information</h3>
    <form method="post" action="{{route('recipecreation')}}" enctype="multipart/form-data">
        @csrf
    <label for="name">Recipe Name:</label>
    <br>
    <input type="text" style="width:100%;" placeholder="Input the name of your recipe" id="name" name="name" >
    <br>
    <label for="description">Description:</label>
    <br>
    <textarea class="form-control" id="description" name="description" rows="4" cols="50" placeholder="Enter your description"></textarea>
    <label for="ingredients">Ingredients:</label>
    <textarea class="form-control" id="ingredients" name="ingredients" rows="4" cols="50" placeholder="Enter your ingredients"></textarea>
    <div>
        <input type="file" style="display:block;width:50%;" accept="image/*" onchange="imagepreview(this,'previewimage')" name="image" id="imageupload">
        <img style="width:50%;display:none;" class='preview' src="" id="previewimage">
    </div>
    <button class="btn btn-success" type="submit" style="margin-top:3%;margin-bottom:3%;">Submit</button>
</div>
</div>

</form>




</div>
@endsection