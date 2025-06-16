@extends('templates.headandfoot')

@section('title')
Create a Donation
@endsection

@section('content')

<script src="{{ asset('viewjs/createmenu.js') }}"></script>
<link href="{{ asset('viewcss/createdonationview.css') }}" rel="stylesheet">

<div class="container-centered">
    <div class="card-box">
        <h2>Create Donation</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('createdonation') }}" enctype="multipart/form-data">
            @csrf

            <label for="name">Donation Name</label>
            <input type="text" name="name" id="name" placeholder="Enter donation name">

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" placeholder="Enter donation description"></textarea>

            <label for="price">Price per Unit</label>
            <input type="number" name="price" id="price" placeholder="Enter price per unit">

            <label for="count">Available Stock</label>
            <input type="number" name="count" id="count" placeholder="Enter available stock">

            <label for="image">Upload an Image</label>
            <input type="file" name="image" id="imageupload" onchange="imagepreview(this,'previewimage')">

            <img id="previewimage" src="#" alt="Preview Image">

            <button type="submit">Create Donation</button>
        </form>
    </div>
</div>

@endsection
