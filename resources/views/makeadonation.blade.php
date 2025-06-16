@extends('templates.headandfoot')

@section('title', 'Available Donations')

@section('content')
<link rel="stylesheet" href="{{ asset('viewcss/makedonations.css') }}">
<div class="container my-4">
    <h3 class="mb-3">Available Donations</h3>
    <form action="{{ route('searchdonations') }}" method="post" class="mb-3">
        @csrf
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search donation by name">
            <button class="btn btn-dark" type="submit">Search</button>
        </div>
    </form>
    @if($donations->isEmpty())
        <p class="text-center">No donations available.</p>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($donations as $donation)
                @php
                    $imageUrl = $donation->image ? '/storage/donationimages/' . $donation->image : asset('EmptyImage.jpg');
                @endphp
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center justify-content-center p-2">
                                <img src="{{ $imageUrl }}" class="img-fluid rounded" alt="{{ $donation->name }}" style="max-height: 120px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1">{{ $donation->name }}</h5>
                                    <p class="card-text text-muted mb-2">By: {{ $donation->restaurant->restaurantName ?? 'N/A' }}</p>
                                    <p class="card-text text-muted mb-2"><strong>Price:</strong> Rp. {{ number_format($donation->price) }}</p>
                                    <p class="card-text mb-2">{{ Str::limit($donation->description, 70) }}</p>
                                    <p class="card-text mb-2">Stock: <span class="fw-bold">{{ $donation->count }}</span></p>
    
                                    <div class="mt-auto"> 
                                        @if($donation->count > 0)
                                            <a href="{{ route('viewdonation', $donation->id) }}" class="btn btn-dark">
                                                View Details
                                            </a>
                                        @else
                                            <button class="btn btn-dark" disabled>
                                                View Details
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
