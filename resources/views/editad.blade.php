@extends('templates.headandfoot')

@section('title')
 Edit Ad
@endsection

@section('content')
<script src="{{asset('viewjs/createmenu.js')}}"></script>
<div>
<div style="width:80%;border-style:solid;border-color:black;border-width:1px;border-radius:5px;margin:auto;">
    <div style="padding:2%;">
    @php
        $imageurl='/storage/advertimages/'.$ad->image;
    @endphp
    <h3>Edit Ad</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    <form method="post" action="{{route('editad',['id'=>$ad->id])}}" enctype="multipart/form-data">
        @csrf
        Title:<br>
        <input class="form-control" type="text" name="title" value="{{$ad->title}}">
        Description:<br>
        <textarea class="form-control" name="description" id="description" rows='4' cols='50'>{{$ad->description}}</textarea>
        Image:<br>
        <input class="form-control" type="file" name="image" onchange="imagepreview(this,'previewimage')" >
        <br>
        @if($ad->image==null)
        <img src="" style="display:none;width:300px;height:300px;" id="previewimage" >
        @else
        <img src="{{$imageurl}}" style="display:block;width:300px;height:300px;" id="previewimage">
        @endif
        <br>
        <input type="submit" class="btn btn-success">
    </form>
</div>
</div>
</div>

@endsection