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
    <link href="{{asset('viewcss/aboutus.css')}}" rel="stylesheet">
    <link href="{{asset('viewcss/css/bootstrap.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9e788b7c72.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: blanchedalmond">
    <div class="container my-5">
        <div class="card about-card mx-auto shadow">
            <img src="{{ asset('photo/aboutus.jpg') }}" class="card-img-top img-fluid" alt="AboutUs">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">About DonaCook</h3>
                <p class="card-text">
                    As of October 2024, the Food and Agriculture Organization (FAO) ranks Indonesia third in Southeast Asia for hunger levels, with a Global Hunger Index score of 16.9. Hunger remains a serious issue, with only Laos and Timor-Leste scoring higher.
                </p>
                <p class="card-text">
                    Contributing factors include poverty and limited access to essential resources. While the government has launched various initiatives to combat hunger, community support remains vital.
                </p>
                <p class="card-text">
                    At the same time, Indonesia is one of the world's largest producers of unsold food waste — much of it coming from restaurants and hotels.
                </p>
                <p class="card-text">
                    That’s why we created this platform. By donating leftover food, individuals and businesses can help those in need and reduce food waste. Our app also provides simple, affordable recipes so everyone can prepare healthy meals with easily accessible ingredients.
                </p>
                <p class="card-text fw-semibold">
                    Together, we can reduce hunger and waste — one meal at a time.
                </p>
                <div class="text-center mt-4">
                    <a href="{{ url('/donate') }}" class="btn btn-primary px-4 py-2">Join the Cause</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
@endsection