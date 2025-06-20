@extends('templates.headandfoot')
@section('title')
    Menu Dashboard
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('viewcss/menudashboard.css') }}">
<script src="{{ asset('viewjs/menudashboard.js') }}"></script>

<section class="search-section">
  <h3 class="search-title">Recipe Search</h3>

  <div class="search-bar-wrapper">
    <form action="{{ route('searchrecipe') }}" method="post" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search recipes...">
            <button class="btn btn-dark" type="submit">Search</button>
        </div>
    </form>
  </div>
</section>

<div class="dashboard-section mt-4">
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
                    <div class="card-text"><strong>{{ $recipe->category }}</strong></div>
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
