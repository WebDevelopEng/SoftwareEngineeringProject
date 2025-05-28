@extends ('templates.headandfoot')

@section('title')
   Admin Recipes
@endsection


@section('content')
    
    <div class="container">
        <br>
        <h3 class="mb-4">Manage Recipes</h3>
    

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="list-group">
            @forelse ($recipes as $recipe)
                <div class=" py-3">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column flex-md-row gap-3 align-items-start">
                            @if ($recipe->image)
                                <img src="{{ asset('storage/recipeimages/' . $recipe->image) }}" alt="Recipe Image" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                            <div>
                                <h5 class="mb-1">{{ $recipe->Name }}</h5>
                                <p class="mb-1 small text-muted">{{ $recipe->Description }}</p>
                                <p class="mb-0">
                                    <span class="text-dark">Premium: </span>  {{ $recipe->premium }} |
                                    <span class="text-dark">Stock:</span> {{ $recipe->category }} |
                                    <span class="text-dark">Restaurant:</span> {{ $recipe->restaurant->restaurantName ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        
                            <div class="ms-auto text-end">
                        <a href="{{route('viewrecipe',['recipeid'=>$recipe->RecipeID])}}" class="btn btn-dark btn-sm d-block mb-2"> View Recipe</a> 
                        <a href="{{route('editrecipe',['i'=>$recipe->RecipeID])}}" class="btn btn-info btn-sm mb-2 d-block">Edit Recipe</a>
                        <a href="{{ route('deleterecipe', ['id' => $recipe->RecipeID]) }}" class="btn btn-danger btn-sm d-block">Delete Recipe</a>
                        
                    </div>

                    </div>
                </div>
            @empty
                <div class="list-group-item text-center text-muted">No recipes found.</div>
            @endforelse
            @if($recipes->links())
                {{$recipes->links()}}
            @endif
        </div>
    </div>


@endsection