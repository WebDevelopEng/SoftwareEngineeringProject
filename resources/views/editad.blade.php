@extends('templates.headandfoot')

@section('title','Edit Ad')

@section('content')
<script src="{{asset('viewjs/createmenu.js')}}"></script>
<link href="{{ asset('viewcss/editad.css') }}" rel="stylesheet">
<body style="background-color: blanchedalmond">
    <div class="ad-card">
        <h3 class="ad-title">Edit Ad</h3>

        @php
            $imageurl = '/storage/advertimages/' . $ad->image;
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('editad', ['id' => $ad->id]) }}" enctype="multipart/form-data" class="login-form mt-3">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ $ad->title }}">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="4" cols="50">{{ $ad->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input class="form-control" type="file" name="image" id="image" onchange="imagepreview(this, 'previewimage')">
            </div>

            <div class="text-center mt-3">
                @if ($ad->image == null)
                    <img src="" style="display:none;width:300px;height:300px;" id="previewimage">
                @else
                    <img src="{{ $imageurl }}" style="display:block;width:300px;height:300px;" id="previewimage">
                @endif
            </div>

            <button type="submit" class="btn-submit mt-4">Save Changes</button>
        </form>
    </div>
</body>
@endsection
