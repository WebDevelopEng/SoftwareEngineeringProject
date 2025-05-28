@extends ('templates.headandfoot')

@section('title')
    Admin Donations Board
@endsection


@section('content')
    
    <div class="container">
        <br>
        <h3 class="mb-4">Manage Donations</h3>
    

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="list-group">
            @forelse ($donations as $donation)
                <div class=" py-3">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column flex-md-row gap-3 align-items-start">
                            @if ($donation->image)
                                <img src="{{ asset('storage/donationimages/' . $donation->image) }}" alt="Donation Image" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                            <div>
                                <h5 class="mb-1">{{ $donation->name }}</h5>
                                <p class="mb-1 small text-muted">{{ $donation->description }}</p>
                                <p class="mb-0">
                                    <span class="text-dark">Price:</span> Rp. {{ number_format($donation->price) }} |
                                    <span class="text-dark">Stock:</span> {{ $donation->count }} |
                                    <span class="text-dark">Restaurant:</span> {{ $donation->restaurant->restaurantName ?? 'N/A' }}
                                </p>
                            </div>
                        </div>

                        
                            <div class="ms-auto text-end">
                        <a href="{{route('viewdonation',['id'=>$donation->id])}}" class="btn btn-dark btn-sm d-block mb-2"> View Donation</a> 
                        <a href="{{route('editdonationview',['id'=>$donation->id])}}" class="btn btn-info btn-sm mb-2 d-block">Edit Donation</a>
                        <a href="{{ route('deletedonation', ['id' => $donation->id]) }}" class="btn btn-danger btn-sm d-block">Delete Donation</a>
                        
                    </div>

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