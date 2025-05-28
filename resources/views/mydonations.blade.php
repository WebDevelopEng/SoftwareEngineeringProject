

@extends('templates.headandfoot')

@section('title', 'My Donations')

@section('content')

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">My Donations</h3>
        <a href="{{ route('createdonationview') }}" class="btn btn-dark">Create a Donation</a>
    </div>

    <hr>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Current Donations</h4>
        </div>
        <div class="card-body p-0">
            @forelse($donations as $donation)
                @php
                    $imageUrl = $donation->image ? '/storage/donationimages/' . $donation->image : asset('EmptyImage.jpg');
                @endphp
                <div class="d-flex align-items-center p-3 border-bottom">
                    <div class="flex-shrink-0 me-3">
                        <img class="img-thumbnail rounded" src="{{ $imageUrl }}" alt="{{ $donation->name }}" style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $donation->name }}</h5>
                        <p class="mb-1 text-muted"><strong>Price:</strong> Rp. {{ number_format($donation->price) }}</p>
                        <p class="mb-0">{{ Str::limit($donation->description, 100) }}</p>
                        @if(Session::get('admin'))

                        @endif
                    </div>
                    <div class="ms-auto text-end">
                        <a href="{{route('viewdonation',['id'=>$donation->id])}}" class="btn btn-dark btn-sm d-block mb-2"> View Donation</a> 
                        <a href="{{route('editdonationview',['id'=>$donation->id])}}" class="btn btn-info btn-sm mb-2 d-block">Edit Donation</a>
                        <a href="{{ route('deletedonation', ['id' => $donation->id]) }}" class="btn btn-danger btn-sm d-block">Delete Donation</a>
                        
                    </div>
                </div>
            @empty
                <p class="text-center p-4 mb-0">You haven't created any donations yet.</p>
            @endforelse
            @if($donations->links())
                {{$donations->links()}}
            @endif
        </div>
    </div>
</div>

@endsection