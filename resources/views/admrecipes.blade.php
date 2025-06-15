@extends ('templates.headandfoot')

@section('title')
   Admin Recipes
@endsection

@section('content')
<link href="{{ asset('viewcss/admrecipes.css') }}" rel="stylesheet">
<body style="background-color: blanchedalmond">
    <div class="ad-card2">
        <h3 class="ad-title">Manage Recipes</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-3">
            @forelse ($recipes as $recipe)
                <div class="col-12">
                    <div class="ad-card p-3 d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-start gap-3" style="flex-grow: 1;">
                            @if ($recipe->image)
                                <img src="{{ asset('storage/recipeimages/' . $recipe->image) }}" alt="Recipe Image" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                            <div class="flex-grow-1">
                                <h5 class="mb-2 text-nama">{{ $recipe->Name }}</h5>
                                <p class="mb-2 text-muted">{{ $recipe->Description }}</p>
                                <p class="mb-0">
                                    <span class="text-dark text-desc">Premium:</span> {{ $recipe->premium }} |
                                    <span class="text-dark text-desc">Stock:</span> {{ $recipe->category }} |
                                    <span class="text-dark text-desc">Restaurant:</span> {{ $recipe->restaurant->restaurantName ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="text-end mt-3 mt-md-0">
                            <a href="{{ route('viewrecipe', ['recipeid' => $recipe->RecipeID]) }}" class="btn btn-dark btn-sm d-block mb-2 small-btn">View</a>
                            <a href="{{ route('editrecipe', ['i' => $recipe->RecipeID]) }}" class="btn btn-info btn-sm d-block mb-2 small-btn">Edit</a>
                            <a href="{{ route('deleterecipe', ['id' => $recipe->RecipeID]) }}" class="btn btn-danger btn-sm d-block small-btn">Delete</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted w-100">No recipes found.</div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($recipes->links())
        <div class="pagination-wrapper mt-4">
            {{ $recipes->links() }}
        </div>
        @endif
    </div>
</body>
@endsection

