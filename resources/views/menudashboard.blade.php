@extends('templates.headandfoot')
@section('title')
    Menu Dashboard
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('viewcss/menudashboard.css') }}">
<script src="{{ asset('viewjs/menudashboard.js') }}"></script>

<div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel" style="margin: 30px auto 50px; max-width: 80%;">
    <div class="carousel-inner">
        <div class="carousel-item active">
                    <div class="profile-card">
                        <img
                            src="{{ asset('photo/salmonbeurreblanc.jpg') }}"
                            alt="Salmon Beurre Blanc"
                            class="carousel-img"
                        >
                    </div>
                </div>
        @php $carouselRecipes = $collection->take(3); @endphp
        @foreach($carouselRecipes as $index => $recipe)
            @php
                $imageurl = "/storage/recipeimages/" . $recipe->image;
                $recipeurl = "/viewrecipe/" . $recipe->RecipeID;
            @endphp
            <div class="carousel-item @if($index == 0) active @endif">
                <img src="{{ $imageurl }}" class="d-block w-100" style="height: 350px; object-fit: cover; border-radius:10px;" alt="Recipe image">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                    <h5>{{ $recipe->Name }}</h5>
                    <p>{{ Str::limit($recipe->Description, 100) }}</p>
                    <a href="{{ $recipeurl }}" class="btn btn-warning text-dark fw-bold">View Recipe</a>
                </div>
            </div>
        @endforeach
    </div>
</div>


<section class="search-section">
  <h3 class="search-title">Recipe Search</h3>

  <div class="search-bar-wrapper">
    <form method="POST" action="/menudashboard" class="input-group">
      @csrf
      <input 
        type="text" 
        name="search" 
        id="searchbar" 
        class="form-control" 
        placeholder="Search recipes…"
      >
      <button class="btn btn-dark" type="submit">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </div>
</section>

<div class="dashboard-section mt-4">
    <h2>{{ isset($state) ? 'Search' : 'Top Picks' }}</h2>
    <div class="cards-wrapper d-flex flex-wrap gap-4 justify-content-center mt-3">
        @foreach($collection as $recipe)
            @php
                $imageurl = "/storage/recipeimages/" . $recipe->image;
                $recipeurl = "/viewrecipe/" . $recipe->RecipeID;
            @endphp
            <div class="card" style="width: 18rem; min-height: 300px;">
                <img src="{{ $imageurl }}" alt="{{ $recipe->Name }}" style="width:100%; height:150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $recipe->Name }}</h5>
                    <div class="btn btn-info mb-2">{{ $recipe->category }}</div>
                    <p class="card-text">{{ Str::limit($recipe->Description, 25) }}</p>
                </div>
                <div class="px-3 pb-3">
                    @php
                        $isLocked = ($membership == 0 && $recipe->premium == 1 && null == Session::get('restaurant')) ||
                                    (null !== Session::get('restaurant') && Session::get('restaurant')->id !== $recipe->restaurant_id);
                    @endphp
                    @if($isLocked)
                        <a class="btn btn-secondary disabled card-link" href="{{ $recipeurl }}">
                            <i class="fa-solid fa-lock"></i> Recipe locked
                        </a>
                    @else
                        <a class="btn btn-dark card-link" href="{{ $recipeurl }}">
                            View recipe <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>


<div class="d-flex justify-content-center mt-4">
    {{ $collection->links() }}
</div>
@endsection
