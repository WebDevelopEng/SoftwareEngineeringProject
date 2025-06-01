@extends('templates.headandfoot')
@section('title')
Ad Management
@endsection
@section('content')
<h3 style="padding-left:5%;padding-top:1%;padding-bottom:1%;">Ad Management</h3>
<div style="width:80%;margin:auto;display:flex;">
<div style="width:60%;">
@if(isset($ads))
@foreach($ads as $ad)
@php
    $imagestring="/storage/advertimages/".$ad->image;
@endphp
<div style="border-style:solid;border-color:black;border-width:1px;">
<div style="width:20%;display:inline-block;">
@if($ad->image !==null)
<img src="{{$imagestring}}"  style="object-fit:cover;height:100px;width:100%;">
@endif
</div>
<div style="width:50%;height:100%;display:inline-block;">
<b>Title:</b>
{{$ad->title}}<br>
<b>Description:</b>
    {{Str::limit($ad->description,50)}}
</div>
<a class="btn btn-info" href="{{route('editad',['id'=>$ad->id])}}">Edit</a>
<a class="btn btn-warning" href="{{route('deletead',['id'=>$ad->id])}}">Delete</a>
</div>
@endforeach

@endif

</div>
<div style="width:40%;border-style:solid;border-color:black;border-width:1px;padding-top:1%;padding-bottom:1%;">
<div style="width:80%;margin:auto;">
<h5>Create New Ad</h5>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{route('createads')}}" enctype="multipart/form-data">
@csrf
<label for="title">Title:</label>
<input class="form-control" type="text" name="title" id="title">
<label for="description">Description:</label>
<textarea class="form-control" name="description" id="description" ></textarea>
<label for="image">Image: </label>
<input class="form-control" type="file" name="image" id="image">
<br>
<button class="btn btn-dark" type="submit">Create Ad</button>

</form>
</div>
</div>
</div>
<div style="width:fit-content;margin:auto;" >
{{$ads->links()}}
</div>

@endsection
