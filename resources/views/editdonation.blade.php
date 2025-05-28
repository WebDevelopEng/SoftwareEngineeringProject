@extends('templates.headandfoot')
@section('title')
    Edit Donation
@endsection
@section('content')
    <script src="{{asset('viewjs/createmenu.js')}}"></script>
<div>
<div style="width:80%;border-style:solid;border-color:black;border-width:1px;border-radius:5px;margin:auto;">
    <div style="padding:2%;">
    @php
        $imageurl='/storage/donationimages/'.$donation->image;
    @endphp
    <h3>Edit Donation</h3>
    
    <form method="post" action="{{route('editdonation',['id'=>$donation->id])}}" enctype="multipart/form-data">
        @csrf
        Name:<br>
        <input class="form-control" type="text" name="name" value="{{$donation->name}}">
        Description:<br>
        <textarea class="form-control" name="description" id="description" rows='4' cols='50'>{{$donation->description}}</textarea>
        Price:<br>
        <input class="form-control" type="number" name="price" value="{{$donation->price}}"><br>
         Stock:<br>
        <input class="form-control" type="number" name="count" value="{{$donation->count}}"><br>
        Image:<br>
        <input class="form-control" type="file" name="image" onchange="imagepreview(this,'previewimage')" >
        <br>
        @if($donation->image==null)
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

