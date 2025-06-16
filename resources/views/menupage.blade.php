@extends('templates.headandfoot')

@section('title')
    Recipe
@endsection

@section('content')
<link href="{{ asset('viewcss/menupage.css') }}"  rel="stylesheet">
<body style="background-color:blanchedalmond">
@if(isset($recipe))
    @php
        $imageurl = '/storage/recipeimages/' . $recipe->image;
    @endphp

    {{-- ADVERTISEMENT OVERLAY --}}
    @if($ad !== null)
        @php
            $adurl = '/storage/advertimages/' . $ad->image;
        @endphp
        <script src="{{ asset('viewjs/menupage.js') }}"></script>

        <div id="ad-overlay">
            <button type="button" onclick="closewindow()" class="btn btn-light position-absolute top-0 end-0 m-3">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div id="ad-modal">
            <img src="{{ $adurl }}" class="img-fluid">
        </div>
    @endif

    {{-- RECIPE CARD --}}
    <div class="container" id="recipe-container">
        <div id="translucent-card">
            <div class="text-center">
                <span class="recipe-title-btn">{{ $recipe->Name }}</span>
            </div>

            {{-- IMAGE SECTION --}}
            <div class="recipe-image-wrapper mb-4">
                <img src="{{ $imageurl }}" class="bg-blur">
                <img src="{{ $imageurl }}" class="main-image">
            </div>

            {{-- AUTHOR AND CATEGORY --}}
            <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap mb-3 restaurant-author-row">
            <div class="label-section">
                Restaurant Author:
            </div>
            <div class="author-section d-flex align-items-center gap-2">
                @if($restaurant->image == null)
                    <img src="{{ asset('profileimage/defaultimage.jpg') }}">
                @else
                    @php
                        $newimageurl = '/storage/profileimages/' . $restaurant->image;
                    @endphp
                    <img src="{{ $newimageurl }}">
                @endif
                <span>{{ $restaurant->restaurantName }}</span>
            </div>
        </div>



            <div class="text-center recipe-category">
                <h4>{{ $recipe->category }}</h4>
            </div>

            {{-- INGREDIENTS --}}
            <div class="recipe-section mb-4">
                <div class="text-start px-4">
                    <h5>Ingredients:</h5>
                    <p>{{ $recipe->Ingredients }}</p>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="recipe-section mb-4">
                <div class="text-start px-4">
                    <h5>Description:</h5>
                    <p>{{ $recipe->Description }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
