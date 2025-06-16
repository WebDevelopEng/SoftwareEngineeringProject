@extends('templates.headandfoot')
@section('title')
DonaCook
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('viewcss/home.css')}}" rel="stylesheet">
    <link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: blanchedalmond">
    {{--headlines--}}
    <div class="container-fluid mb-5" id="headlines" style="background-image: url('{{ asset('photo/headline.jpg') }}'); background-size: cover; background-position: center;">
        <div class="row">
            <div class="col">
                <div class="card mx-auto border-0" id="translucent-card">
                <div class="card-body">
                    <h2>DonaCook</h2>
                    <br>
                    <p style="margin-bottom: 25px;">
                    DonaCook fights hunger and reduces waste by redistributing excess food to communities in need. 
                    We also empower home cooks with delicious recipes using low-cost ingredients, making great meals accessible to all.
                    </p>
                    <button class="btn btn-explore">
                        Donate <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>

    {{--recipes--}}
    <div class="container-fluid" id="recipes">
        <div class="row">
            <div class="col">
                <h3 class="container-title">Our Top 3 Most Iconic Recipes</h3>
                <div id="recipeCarousel" class="carousel slide w-50 mx-auto" data-bs-ride="false">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="card profile-card" style="background-color: rgba(255, 255, 255, 0.7);">
                                <img src="{{ asset('photo/satetempe.jpg') }}" class="card-img-top" alt="Recipe 1">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Recipe 1</h5>
                                    <p class="card-text">Description for recipe 1.</p>
                                    <a href="#" class="btn btn-explore">Explore Recipe</a>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card profile-card" style="background-color: rgba(255, 255, 255, 0.7);">
                                <img src="{{ asset('photo/nasitempe.jpg') }}" class="card-img-top" alt="Recipe 2">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Recipe 2</h5>
                                    <p class="card-text">Description for recipe 2.</p>
                                    <a href="#" class="btn btn-explore">Explore Recipe</a>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card profile-card" style="background-color: rgba(255, 255, 255, 0.7);">
                                <img src="{{ asset('photo/food3.jpg') }}" class="card-img-top" alt="Recipe 3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Tempeh Bread</h5>
                                    <p class="card-text">Tempeh Bread is a savory and nutritious dish made from fermented soybeans (tempeh) grilled or baked on skewers. It's rich in protein, has a firm texture, and is often coated in a flavorful sauce, making it a delicious plant-based option.</p>
                                    <a href="#" class="btn btn-explore">Explore Recipe</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#recipeCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#recipeCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <br>


    {{--facts--}}
    <div class="container my-5" id="impact-stats">
        <h3 class="text-center mb-5 fw-bold" style="color:#2c3e50">
            WE FIGHT HUNGER<br>FOR THOSE IN NEED
        </h3>
        <div class="row text-center justify-content-center">
            <div class="col-md-3 col-6 mb-4">
                <img src="{{ asset('icons/food.png') }}" class="stats-icon mb-3" alt="Hot Meals">
                <div class="stat-number">300.000</div>
                <div class="stat-label">Food Waste Saved</div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <img src="{{ asset('icons/volun.png') }}" class="stats-icon mb-3" alt="Volunteers">
                <div class="stat-number">1.000</div>
                <div class="stat-label">Volunteers</div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <img src="{{ asset('icons/people.png') }}" class="stats-icon mb-3" alt="Recipients">
                <div class="stat-number">70.000</div>
                <div class="stat-label">Recipients</div>
            </div>
        </div>
    </div>
    <div class="impact-side-card-container">
        <div class="impact-side-card p-4">
            <h5 class="mb-3">Why It Matters</h5>
            <p>Every year, millions go hungry while tons of food are wasted. DonaCook bridges that gap, helping both people and the planet.</p>
            <a href="{{ route('aboutus') }}" class="btn btn-explore mt-3">About DonaCook</a>
        </div>
    </div>

    {{--join membership button--}}
    <div class="membership-banner" style="background-image: url('{{ asset('photo/donation-banner.png') }}');">
        <div class="overlay">
            <h2>Join Our Membership Now!</h2>
            <p>Enjoy more freedom, inspiration, and support with DonaCook Membership.</p>
            <a href="{{ route('subscription') }}" class="btn btn-explore mt-3">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>


    {{--team profile--}}
    <div class="container my-7">
        <h3 class="container-title">DonaCook's Team</h3>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4 card-spacing">
                <div class="card profile-card h-100">
                    <img src="{{ asset('photo/owen.jpg') }}" class="card-img-top" alt="Profile 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Owen Kartolo</h5>
                        <p class="card-text">2602140345</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4 card-spacing">
                <div class="card profile-card h-100">
                    <img src="{{ asset('photo/avel.jpg') }}" class="card-img-top" alt="Profile 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Dionisius Avelino</h5>
                        <p class="card-text">2602117033</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4 card-spacing">
                <div class="card profile-card h-100">
                    <img src="{{ asset('photo/chris.jpg') }}" class="card-img-top" alt="Profile 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Christopher Parulian Marpaung</h5>
                        <p class="card-text">2602231993</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4 card-spacing">
                <div class="card profile-card h-100">
                    <img src="{{ asset('photo/profile.png') }}" class="card-img-top" alt="Profile 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tria Farissa Tsas</h5>
                        <p class="card-text">2502037145</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
@endsection
