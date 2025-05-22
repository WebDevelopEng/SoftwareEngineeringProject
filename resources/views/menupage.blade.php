@extends('templates.headandfoot')
@section('title')
    Recipe
@endsection
@section('content')
@if(isset($recipe))
    @php
        $imageurl='/storage/recipeimages/'.$recipe->image;
    @endphp
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