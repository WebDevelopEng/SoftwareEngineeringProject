@extends('templates.headandfoot')
@section('title')
    Recipe
@endsection
@section('content')
@if(isset($recipe))
    @php
        $imageurl='/storage/recipeimages/'.$recipe->image;
    @endphp
    @if($ad!==null)
    @php
        $adurl='/storage/advertimages/'.$ad->image;
    @endphp
    <script src="{{asset('viewjs/menupage.js')}}"></script>
    <div style="position:absolute;background-color:black;z-index:2;opacity:0.5;width:100%;height:100%;display:block;" id="background-fade">
        <button type="button" onclick="closewindow()"><i class="fa fa-times"></i></button>
    </div>
    <div style="position:absolute;width:fit-content;display:block;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;opacity:1;z-index:3;" id="ad" >
        <img src="{{$adurl}}" style="object-fit:fill;max-height:500px;">
    </div>
    @endif
    <div class="menuoverview" style="border-style:solid;border-color:black;border-width:2px;padding-top:1%;">
        <h3 class="title" style="margin-bottom:2%;"> {{$recipe->Name}}</h3>
        <div class="foodimagecontainer" style="border-width:2px;border-bottom:0px;border-top:0px;">
            <img style="position:absolute;object-fit:fill;width:inherit;height:inherit;filter:blur(10px)grayscale(100);" src="{{$imageurl}}"> 
        <img style="position:relative;vertical-align:middle;width:100%;height:100%;object-fit:contain;border-style:solid;border-left:0px;border-right:0px;" src="{{$imageurl}}"></div>
    <div class="tablerowcontainer" style="border-width:0px;">
        <div class="halfwidth">
        <h5 style="line-height:50px;margin:0;"> Restaurant Author </h5>
        
</div>
    <div class="halfwidth" style="border-left:solid;border-width:2px;border-color:black;">
    @if($restaurant->image==null)
        <img style="width:50px;height:50px;border-radius:25px;object-fit:fill" src="{{asset('profileimage/defaultimage.jpg')}}"> 
    @else
    @php
        $newimageurl='/storage/profileimages/'.$restaurant->image;
    @endphp
        <img style="width:50px;height:50px;border-radius:25px;object-fit:fill" src="{{$newimageurl}}"> 
    @endif
    {{$restaurant->restaurantName}}
</div>
<div class="btn btn-info">{{$recipe->category}}</div>
</div>
        <div class="tablerowcontainer" style="display:block;border-top:20px;border-style:solid;">
            <div style="text-align:left;width: 80%;margin:auto;">
            <h5> Ingredients: </h5></div>

            <div style="text-align:left;width:80%;margin:auto;">{{$recipe->Ingredients}}</div>
        </div>
        <div class="tablerowcontainer" style="display:block">
            <div style="text-align:left;width: 80%;margin:auto;"><h5> Description:</h5></div>
                <div style="text-align:left;width:80%;margin:auto;">{{$recipe->Description}}</div>
        </div>
        

</div>


@endif
@endsection