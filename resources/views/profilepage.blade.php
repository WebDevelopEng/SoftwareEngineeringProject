@extends('templates.headandfoot')
@section('title')
    Profile Page
@endsection
@section('content')
<body style="background-color: blanchedalmond;">
<script src="{{ asset('/viewjs/profilepage.js') }}"></script>
<link href="{{ asset('/viewcss/profilepage.css') }}" rel="stylesheet">

@if (null!==Session::get('restaurant'))
@php
$restaurant = Session::get('restaurant');
$imageurl = $restaurant->image ? 'storage/profileimages/'.$restaurant->image : asset('profileimage/defaultimage.jpg');
@endphp

<div id="updateresto" class="popup-card">
    <button class="btn btn-dark btn-close-top" type="button" onclick="closepopup('updateresto')">
    <i class="fas fa-window-close"></i>
    </button>
    <h3 class="d-inline">Update Profile</h3>
    <form method="post" action="/restoprofile" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" value="{{ $restaurant->restaurantName }}">
        <label for="location">Location:</label>
        <input class="form-control" type="text" id="location" name="location" value="{{ $restaurant->location }}">
        <label for="profilepicture">Add a profile picture:</label>
        <input class="form-control" type="file" id="image" name="image">
        <button class="btn btn-dark mt-3">Update</button>
    </form>
</div>

<div class="profile-layout">
    <div class="profile-left">
        <div class="profile-card">
            <img src="{{ $imageurl }}" class="profile-image">
            <div class="accountinformation">
                <h5>{{ $restaurant->restaurantName }}</h5>
                <p><i class="fa-solid fa-envelope"></i>: {{ $restaurant->restaurantEmail }}</p>
                <p><i class="fa-solid fa-location-dot"></i>: {{ $restaurant->location }}</p>
                <button class="btn btn-dark" type="button" onclick="popupedit('updateresto')">Update Profile</button>
            </div>
        </div>
    </div>

    <div class="profile-right">
        <div class="profile-card">
            <h3>Recent Recipes:</h3>
            <div class="recipe-scroll">
                @foreach($collection as $recipe)
                @php
                $imageurl = "/storage/recipeimages/" . $recipe->image;
                $recipeurl = "/viewrecipe/" . $recipe->RecipeID;
                $editurl = "/editrecipe/" . $recipe->RecipeID;
                @endphp
                <div class="card recipe-card">
                    <img src="{{ $imageurl }}" class="card-img-top">
                    <div class="card-body">
                        <b>{{ $recipe->Name }}</b><br>
                        <div class="btn btn-info">{{ $recipe->category }}</div>
                        <p class="card-text">{{ Str::limit($recipe->Description,25) }}</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-dark" href="{{ $recipeurl }}"><i class="fa-solid fa-eye"></i> View</a>
                        <a class="btn btn-info" href="{{ $editurl }}"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
                @endforeach
            </div>
            <h3>Edit Account</h3>
            <form method="post" action="{{ route('uprestoacc') }}">
                @csrf
                <label for="email">Change Email:</label>
                <input class="form-control" type="text" name="email" value="{{ $restaurant->restaurantEmail }}" id="email">
                <label for="password">Change Password:</label>
                <input class="form-control" type="password" name="password" id="password">
                <button class="btn btn-dark mt-3">Update Account</button>
            </form>
            <br>
            <h3>Credit</h3>
            <p><b>Balance:</b> {{ $restaurant->balance }}</p>
        </div>
    </div>
</div>
@endif

@if(null!==Session::get('user'))
@php
$user = Session::get('user');
$imageurl = $user->profilepicture ? 'storage/profileimages/'.$user->profilepicture : asset('profileimage/defaultimage.jpg');
@endphp

<div id="updateuser" class="popup-card">
    <button class="btn btn-dark btn-close-top" type="button" onclick="closepopup('updateuser')">
    <i class="fas fa-window-close"></i>
    </button>
    <h3 class="d-inline">Update Profile</h3>
    <form method="post" action="/userprofile" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}">
        <label for="dob">Date of Birth:</label>
        <input class="form-control" type="date" id="dob" name="dob" value="{{ $user->dateofbirth }}">
        <label for="profilepicture">Add a profile picture:</label>
        <input class="form-control" type="file" id="image" name="image">
        <button class="btn btn-dark mt-3">Update</button>
    </form>
</div>

<div class="profile-layout">
    <div class="profile-left">
        <div class="profile-card">
            <img src="{{ $imageurl }}" class="profile-image">
            <div class="accountinformation">
                <h5>{{ $user->name }}</h5>
                <p><i class="fa-solid fa-envelope"></i>: {{ $user->email }}</p>
                <p><i class="fa-solid fa-calendar"></i>: {{ $user->dateofbirth }}</p>
                <button class="btn btn-dark" type="button" onclick="popupedit('updateuser')">Update Profile</button>
            </div>
        </div>
    </div>

    <div class="profile-right">
        <div class="profile-card">
            <h3>Subscription</h3>
            @if($collection2 == null)
                <p><b>Subscription Status:</b> Inactive</p>
            @else
                <p><b>Subscription Status:</b> Active</p>
                <h6>Subscription History</h6>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Member Transaction ID</th>
                            <th>Purchase Date</th>
                            <th>Price</th>
                            <th>Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collection1 as $subhistory)
                        <tr>
                            <td>{{ $subhistory->memberId }}</td>
                            <td>{{ $subhistory->membershipStart }}</td>
                            <td>{{ $subhistory->price }}</td>
                            <td>{{ $subhistory->membershipDueDate }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3 class="mt-4">Edit Account</h3>
            <form method="post" action="{{ route('upuseracc') }}">
                @csrf
                <label for="email">Change Email:</label>
                <input class="form-control" type="text" name="email" value="{{ $user->email }}" id="email">
                <label for="password">Change Password:</label>
                <input class="form-control" type="password" name="password" id="password">
                <button class="btn btn-dark mt-3">Update Account</button>
            </form>

            <h3 class="mt-4">Credit</h3>
            <p><b>Balance:</b> {{ $user->balance }}</p>

            <h5 class="mt-3">Refill Balance</h5>
            <form method="post" action="{{ route('refillacc') }}">
                @csrf
                <label for="balance">Refill your balance:</label>
                <input class="form-control mb-2" type="number" name="balance" id="balance">
                <button class="btn btn-dark">Refill</button>
            </form>
        </div>
    </div>
</div>
@endif

@if(null!==Session::get('admin'))
@php
$admin = Session::get('admin');
$imageurl = asset('profileimage/defaultimage.jpg');
@endphp
<div class="admin-container">
    <div class="profile-card text-center">
        <img src="{{ $imageurl }}" class="profile-image">
        <div class="accountinformation">
            <h5>{{ $admin->username }}</h5>
            <p><i class="fa-solid fa-envelope"></i>: {{ $admin->email }}</p>
            <div style="text-align:left;">
                <form method="post" action="{{ route('upadminprofile') }}">
                    <h5>Update Profile:</h5>
                    @csrf
                    Name:<br>
                    <input class="form-control" type="text" name="name" value="{{ $admin->name }}"><br>
                    <button class="btn btn-dark">Update Profile</button>
                    <br><br>
                </form>
            </div>
            <div style="text-align:left;border-top:double;">
                <h5>Update Account:</h5>
                <form method="post" action="{{ route('upadminacc') }}">
                    @csrf
                    Email:<br>
                    <input class="form-control" type="text" name="email" value="{{ $admin->email }}"><br>
                    Password:<br>
                    <input class="form-control" type="password" name="password"><br>
                    <button class="btn btn-dark">Update Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
</body>
@endsection