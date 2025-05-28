@extends('templates.headandfoot')
@section('title')
    Profile Page
@endsection
@section('content')
    <script src="{{asset('/viewjs/profilepage.js')}}"></script>
    <link href="{{asset('/viewcss/profilepage.css')}}" type="stylesheet">
    <div style="position:absolute;background-color:black;z-index:2;opacity:0.5;width:100%;height:100%;display:none;" id="background-fade"></div>
    @if (null!==Session::get('restaurant'))
    @php
    $restaurant=Session::get('restaurant');
    $imageurl=Session::get('restaurant')->image;
    if($imageurl==null){
    $imageurl=asset('profileimage/defaultimage.jpg');}
    else{
    $imageurl='storage/profileimages/'.$imageurl;}
    @endphp
    
    <div style="position:absolute;width:50%;display:none;margin:auto;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;opacity:1;z-index:3;padding-top:2%;padding-bottom:2%;padding-left:2%;padding-right:2%;" id="updateresto" >
                <span style="white-space:pre"><h3 style="display:inline">Update Profile</h3>              <button class="btn btn-dark" style="display:inline;" type="button" onclick="closepopup('updateresto')"><i class="fas fa-window-close"></i></button></span> 
                <form method="post" action="/restoprofile" enctype="multipart/form-data" >
                    @csrf
                    <label for="name">Name: </label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$restaurant->restaurantName}}">
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
                <button class="btn btn-dark" type="button" onclick="popupedit('updateresto')">Update Profile</button>
            </div>
        </div>
        <div style="width:60%;border-style:solid;border-width:2px;border-radius:5px;padding-left:2%;padding-right:2%;padding-top:5px;">
            <div><h3>Recent Recipes:</h3><br>
                <div style="display:flex;height:auto;max-height:800px;overflow:auto;">
                @foreach($collection as $recipe)
                    @php
                    $imageurl="/storage/recipeimages/".$recipe->image;
                    $recipeurl="/viewrecipe/".$recipe->RecipeID;
                    $editurl="/editrecipe/".$recipe->RecipeID;
                    @endphp
                <div class="card" style="width:12rem;">
                <div>
                <img style="width:100%;height:166px;object-fit:cover" src="{{$imageurl}}" alt="Card image cap"/>
                </div>
                <div class="card-body" style="font-size:0.8em">
                    <b>{{$recipe->Name}}</b><br>
                    <div class="btn btn-info" style="font-size:0.8em">{{$recipe->category}}</div>
                    <p class="card-text">{{Str::limit($recipe->Description,25)}}</p>
                </div>
                <div style="width:80%;text-align:center;font-size:0.8em">
                    <a class="btn btn-dark" style="font-size:0.8em"   href="{{$recipeurl}}" class="card-link"><i class="fa-solid fa-eye"></i> View </a>
                    <a class="btn btn-info" style="font-size:0.8em" href="{{$editurl}}" class="card-link"><i class="fas fa-edit"></i> Edit </a>
                </div>
                </div>
                @endforeach
                 </div>
            </div>
            <br><br>
            <h3>Edit Account</h3>
            <div style="min-height:200px;">
            <form method="post" action="{{route('uprestoacc')}}">
                @csrf
                <label for="email">Change Email: </label>
                <input class="form-control"  type="text" name="email" value="{{$restaurant->restaurantEmail}}" id="email">
                <label for="password">Change Password: </label> 
                <input class="form-control"  type="password" name="password" id="password"><br>
                <button class="btn btn-dark" style="margin-bottom:50px;">Update Account</button><br>
            </form>
            </div>
            <div><h3>Credit</h3>
            <b>Balance:</b> {{$restaurant->balance}}
            </div>
            <br><br>
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
    <div style="position:absolute;width:50%;display:none;margin:auto;top:50%;left:50%;transform:translate(-50%,-50%);background-color:white;opacity:1;z-index:3;padding-top:2%;padding-bottom:2%;padding-left:2%;padding-right:2%;" id="updateuser" >
                <span style="white-space:pre"><h3 style="display:inline">Update Profile</h3>              <button class="btn btn-dark" style="display:inline;" type="button" onclick="closepopup('updateuser')"><i class="fas fa-window-close"></i></button></span> 
                <form method="post" action="/userprofile" enctype="multipart/form-data" >
                    @csrf
                    <label for="name">Name: </label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$user->name}}">
                    <label for="location"> Date of Birth: </label>
                    <input class="form-control" type="date" id="location" name="dob" value="{{$user->dateofbirth}}">
                    <label for="profilepicture">Add a profile picture: </label>
                    <input class="form-control" type="file" id="image" name="image">
                    <button class="btn btn-dark">Update</button>
                </form>
            </div>
    <div style="width:80%;margin:auto;margin-top:2%;border-radius:2px;display:flex;">
        <div style="width:40%;border-style:solid;border-width:2px;border-radius:5px;">
            <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;text-align:center;"><img src="{{$imageurl}}" style="height:200px;width:200px;">
            </div>
            <div class="accountinformation" style="text-align:center;">
                <h5>{{$user->name}}</h5>
                <i class="fa-solid fa-envelope"></i>: {{$user->email}}<br>
                <i class="fa-solid fa-calendar"></i>: {{$user->dateofbirth}}<br>
                <button class="btn btn-dark" type="button" onclick="popupedit('updateuser')">Update Profile</button>
            </div>
        </div>
        <div style="width:60%;border-style:solid;border-width:2px;border-radius:5px;padding-left:2%;padding-right:2%;padding-top:5px;">
            <h3> Subscription </h3>
            
            <div style="min-height:200px;">
                @if($collection2==null)
                    <b>Subscription Status: Inactive </b>
                @else
                    <b>Subscription Status: Active</b>
                <h6>Subscription History</h6>
                @endif
                <div style="overflow:auto">
                <table class="table">
                    <thead>
                        <tr>
                        <th>Member Transaction ID</th>
                        <th>Purchase Date</th>
                        <th>Price</th>
                        <th>Due Date</th>
                        </tr>
                    </thead>
                @if(!$collection1->isEmpty())
                @foreach($collection1 as $subhistory)
                    <tr>
                    <th>{{$subhistory->memberId}}</th>
                    <th>{{$subhistory->membershipStart}}</th>
                    <th>{{$subhistory->price}}</th>
                    <th>{{$subhistory->membershipDueDate}}</th>
                    </tr>
                @endforeach
                @endif
                </table>
                </div>
            </div>
            <h3>Edit Account</h3>
            <div style="min-height:200px;">
            <form method="post" action="{{route('upuseracc')}}">
                @csrf
                <label for="email">Change Email: </label>
                <input class="form-control"  type="text" name="email" value="{{$user->email}}" id="email">
                <label for="password">Change Password: </label> 
                <input class="form-control"  type="password" name="password" id="password"><br>
                <button class="btn btn-dark" style="margin-bottom:50px;">Update Account</button><br>
            </form>
            </div>
            <div> <h3> Credit </h3>
            Balance: {{$user->balance}}
            <br><br>
            <h5>Refill balance</h5>
<form method="post" action="{{route('refillacc')}}">
<label for="refill">Refill your balance:</label><br>
@csrf
    <input class="form-control" type="number" name="balance" id="balance"><br>
    <button class="btn btn-dark" type="submit">Refill</button>
    
    
</form><br>
        </div>
        </div>
    @endif


    @if(null!==Session::get('admin')) 
    @php
        $imageurl=asset('profileimage/defaultimage.jpg');
    @endphp
     <div style="width:60%;margin:auto;margin-top:2%;border-radius:2px;display:flex;align-items:stretch;border-style:solid;border-width:1px;padding:1%;">
        <div style="width:80%;margin:auto;margin-top:2%;margin-bottom:2%;text-align:center;"><img src="{{$imageurl}}" style="height:200px;width:200px;">
            <div class="accountinformation" style="text-align:center;">
                <h5>{{$admin->username}}</h5>
                <i class="fa-solid fa-envelope"></i>: {{$admin->email}}<br><br>
                
                <div style="text-align:left;">
                <form method="post" action="{{route('upadminprofile')}}">
                    <h5>Update Profile:</h5>
                    @csrf
                    Name:<br>
                    <input class="form-control" type="text" method="post" name="name" value="{{$admin->name}}"><br>
                    <button class="btn btn-dark"> Update Profile</button>
                    <br><br>
                </form>
    </div>
                <div style="text-align:left;border-top:double;">
                <h5>Update Account:</h5>
                <form method="post" action="{{route('upadminacc')}}">
                    @csrf
                   
                    Email:<br>
                    <input class="form-control" type="text" method="post" name="email" value="{{$admin->email}}"><br>
                    Password:<br>
                    <input class="form-control" type="password" method="post" name="password"><br>
                    <button class="btn btn-dark">Update Account</button>
                    </div>
                </form>
            </div>
    <div>
    
    </div>
       
</div>
</div>
    @endif
@endsection