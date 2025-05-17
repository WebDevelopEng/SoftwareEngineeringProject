@extends('templates.headandfoot')
@section('title')
    Profile Page
@endsection
@section('content')
    <script src="{{asset('/viewjs/profilepage.js')}}"></script>
    <link href="{{asset('/viewcss/profilepage.css')}}" type="stylesheet">
    @if (null!==Session::get('restaurant'))
    @php
    $restaurant=Session::get('restaurant');
    $imageurl=Session::get('restaurant')->image;
    if($imageurl==null){
    $imageurl=asset('profileimage/defaultimage.jpg');}
    else{
    $imageurl='storage/profileimages/'.$imageurl;}
    @endphp
    <div style="position:absolute;background-color:black;z-index:2;opacity:0.5;width:100%;height:100%;display:none;" id="background-fade"></div>
    <div style="position:absolute;width:50%;display:none;margin:auto;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;opacity:1;z-index:3;padding-top:2%;padding-bottom:2%;padding-left:2%;padding-right:2%;" id="updateform" >
                <span style="white-space:pre"><h3 style="display:inline">Edit Profile</h3>              <button class="btn btn-dark" style="display:inline;" type="button" onclick="closepopup()"><i class="fas fa-window-close"></i></button></span> 
                <form method="post" action="/restoprofile" enctype="multipart/form-data" >
                    @csrf
                    <label for="name">Name: </label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$restaurant->restaurantName}}">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" id="password" name="password" value="{{$restaurant->password}}">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" id="email" name="email" value="{{$restaurant->restaurantEmail}}">
                    <label for="location"> Location: </label>
                    <input class="form-control" type="text" id="location" name="location" value="{{$restaurant->location}}">
                    <label for="profilepicture">Add a profile picture: </label>
                    <input class="form-control" type="file" id="image" name="image">
                    <button class="btn btn-dark">Update</button>
                </form>
            </div>
    
    <div style="width:80%;margin:auto;margin-top:2%;border-radius:2px;display:flex;align-items:stretch;">
        <div style="width:40%;border-style:solid;border-width:2px;border-radius:5px;">
            <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;text-align:center;"><img src="{{$imageurl}}" style="height:200px;width:200px;">
            </div>
            <div class="accountinformation" style="text-align:center;">
                <h5>{{$restaurant->restaurantName}}</h5>
                <i class="fa-solid fa-envelope"></i>: {{$restaurant->restaurantEmail}}<br>
                <i class="fa-solid fa-location-dot"></i>: {{$restaurant->location}}<br>
                <i class="fas fa-newspaper"></i>: {{$restaurant->description}}<br>
                <button class="btn btn-dark" type="button" onclick="popupedit()">Update Profile</button>
            </div>
        </div>
        <div style="width:60%;border-style:solid;border-width:2px;border-radius:5px;padding-left:2%;padding-right:2%;padding-top:5px;">
            <div><h3>Recipe Collection:</h3>
                <div style="display:flex;height:auto;">
                @foreach($collection as $recipe)
                    @php
                    $imageurl="/storage/recipeimages/".$recipe->image;
                    $recipeurl="/viewrecipe/".$recipe->RecipeID;
                    @endphp
                <div class="card" style="width:12rem;">
                <div>
                <img style="width:100%;height:166px;object-fit:cover" src="{{$imageurl}}" alt="Card image cap"/>
                </div>
                <div class="card-body" style="font-size:0.8em">
                    <b>{{$recipe->Name}}</b>
                    <p class="card-text">{{Str::limit($recipe->Description,25)}}</p>
                </div>
                <div style="width:80%;text-align:center;font-size:0.8em">
                    <a class="btn btn-dark" style="font-size:0.8em"   href="{{$recipeurl}}" class="card-link">View and Edit  <i class="fa-solid fa-arrow-right"></i></a>
                
                </div>
                </div>
                @endforeach
                 </div>
            </div>
            
        </div>
    </div>
    @endif
    
    @if (null!==Session::get('user'))
    @php
    $imageurl=Session::get('user')->profilepicture;
    if($imageurl==null){
    $imageurl=asset('profileimage/defaultimage.jpg');}
    else{
    $imageurl='storage/profileimages/'.$imageurl;}
    @endphp
    <div style="width:60%;margin:auto;height:1200px;">
        <div style="width:40%;">
        <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;"><img src='{{$imageurl}}' style="height:200px;width:200px;"></div>
        </div>
     <div style="width:60%;">
        <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;">
            <b>Username</b>: $user->name
            <b>Email</b> : $user->email
            <b>Date of Birth</b>: $user->dob
            <b>Balance</b>: $user->balance
</div>
</div>
    </div>
    @endif
    @if(null!==Session::get('admin'))
     <div style="width:60%;margin:auto;height:1200px;display:flex;">
        <div style="width:40%;">
            <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;"></div>
     </div>
     <div style="width:60%;">
       
</div>
</div>
    @endif
@endsection