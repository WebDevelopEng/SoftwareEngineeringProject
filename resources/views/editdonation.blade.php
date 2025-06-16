@extends('templates.headandfoot')

@section('title')
    Edit Donation
@endsection

@section('content')
    <script src="{{ asset('viewjs/createmenu.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('viewcss/editdonations.css') }}">
    <div class="donation-container">
        <div class="inner">
            @php
                $imageurl = '/storage/donationimages/' . $donation->image;
            @endphp
            <h3>Edit Donation</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('editdonation', ['id' => $donation->id]) }}" enctype="multipart/form-data">
                @csrf
                <label for="name">Name:</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ $donation->name }}">
                
                <label for="description">Description:</label>
                <textarea id="description" class="form-control" name="description" rows="4" cols="50">{{ $donation->description }}</textarea>
                
                <label for="price">Price:</label>
                <input id="price" class="form-control" type="number" name="price" value="{{ $donation->price }}">
                
                <label for="count">Stock:</label>
                <input id="count" class="form-control" type="number" name="count" value="{{ $donation->count }}">
                
                <label for="image">Image:</label>
                <input id="image" class="form-control" type="file" name="image" onchange="imagepreview(this, 'previewimage')">
                
                <br>
                @if($donation->image == null)
                    <img src="" style="display:none;" id="previewimage">
                @else
                    <img src="{{ $imageurl }}" id="previewimage">
                @endif
                <br>
                <input type="submit" class="btn btn-success" value="Save Changes">
            </form>
        </div>
    </div>
@endsection
