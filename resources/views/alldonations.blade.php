@extends ('templates.headandfoot')

@section('title')
    Admin Donations Board
@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('viewcss/alldonations.css') }}">
<div class="container">
    <br>
    <h3 class="mb-4">Manage Donations</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="list-group">
        @forelse ($donations as $donation)
            <div class="donation-item d-flex align-items-center justify-content-between p-3 border rounded mb-3" style="background-color: white;">
                
                @if ($donation->image)
                    <div class="flex-shrink-0 me-3">
                        <img src="{{ asset('storage/donationimages/' . $donation->image) }}" alt="Donation Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                @endif

                <div class="flex-grow-1 text-center">
                    <h5 class="mb-1">{{ $donation->name }}</h5>
                    <p class="mb-1 small">{{ $donation->description }}</p>
                    <p class="mb-0">
                        <span><strong>Price:</strong> Rp. {{ number_format($donation->price) }}</span> |
                        <span><strong>Stock:</strong> {{ $donation->count }}</span> |
                        <span><strong>Restaurant:</strong> {{ $donation->restaurant->restaurantName ?? 'N/A' }}</span>
                    </p>
                </div>

                <div class="flex-shrink-0 ms-3 text-end">
                    <a href="{{route('viewdonation',['id'=>$donation->id])}}" class="btn btn-dark btn-sm d-block mb-2">View Donation</a> 
                    <a href="{{route('editdonationview',['id'=>$donation->id])}}" class="btn btn-warning btn-sm d-block mb-2">Edit Donation</a>
                    <a href="{{ route('deletedonation', ['id' => $donation->id]) }}" class="btn btn-danger btn-sm d-block">Delete Donation</a>
                </div>

            </div>
        @empty
            <div class="list-group-item text-center text-muted">No donations found.</div>
        @endforelse

        @if($donations->links())
            {{$donations->links()}}
        @endif
    </div>
</div>
@endsection
