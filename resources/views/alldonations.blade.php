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
            <div class="donation-item">
                <div class="d-flex flex-column flex-md-row gap-3 align-items-start">
                    @if ($donation->image)
                        <img src="{{ asset('storage/donationimages/' . $donation->image) }}" alt="Donation Image" class="img-thumbnail">
                    @endif
                    <div class="donation-details">
                        <h5 class="mb-1">{{ $donation->name }}</h5>
                        <p class="mb-1 small">{{ $donation->description }}</p>
                        <p class="mb-0">
                            <span><strong>Price:</strong> Rp. {{ number_format($donation->price) }}</span> |
                            <span><strong>Stock:</strong> {{ $donation->count }}</span> |
                            <span><strong>Restaurant:</strong> {{ $donation->restaurant->restaurantName ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
                <div class="ms-auto text-end">
                    <a href="{{route('viewdonation',['id'=>$donation->id])}}" class="btn btn-dark btn-sm d-block mb-2">View Donation</a> 
                    <a href="{{route('editdonationview',['id'=>$donation->id])}}" class="btn btn-info btn-sm mb-2 d-block">Edit Donation</a>
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
