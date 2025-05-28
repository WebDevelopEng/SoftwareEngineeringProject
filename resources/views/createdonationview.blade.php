@extends('templates.headandfoot')
@section('title')
Create a Donation
@endsection

@section('content')

<script src="{{asset('viewjs/createmenu.js')}}"></script>
<div class="container" style="border-radius:5px;">
    <h3>Create Donation</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="post" action="{{route('createdonation')}}" enctype="multipart/form-data">
        @csrf
        <label for="name">Enter Donation Name:</label><br>
        <input class="form-control" type="text" name="name" id="name"><br>
        <label for="description">Enter Description:</label><br>
        <textarea class="form-control" name="description" id="description" rows="4" cols="50"></textarea><br>
        <label for="price"> Input Price per Unit: </label><br>
        <input class="form-control" type="number" name="price" id="price"><br>
        <label for="count"> Available Stock</label><br>
        <input class="form-control" type="number" name="count" id="count"><br>
        <label for="image"> Upload an image: </label>
        <input type="file" class="form-control" onchange="imagepreview(this,'previewimage')" name="image" id="imageupload">
        <img style="width:200px;height:200px;display:none" id="previewimage" src=""> 
        <button class="btn btn-dark">Create Donation</button>
</form>
</div>

@endsection