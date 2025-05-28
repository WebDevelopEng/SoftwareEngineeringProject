

@extends('templates.headandfoot')

@section('title', 'View Donation')

@section('content')
<script src="{{asset('viewjs/viewdonation.js')}}"></script>
<div class="container mt-5">
    <h2>Donation Overview</h2><br>
    @if($donation)
        @php
                    $imageUrl = $donation->image ? '/storage/donationimages/' . $donation->image : asset('EmptyImage.jpg');
                    $restaurantImage=$donation->Restaurant->image ? '/storage/profileimages/'.$donation->Restaurant->image : asset('EmptyImage.jpg');
        @endphp
        <div class="row">
            <div class="col-md-6">
                <img src="{{$imageUrl}}" alt="Donation Image" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">{{ $donation->name }}</h2>
                <p><strong>Price:</strong> Rp. {{ number_format($donation->price) }}</p>
                <p><strong>Available Count:</strong> {{ $donation->count }}</p>
                <p><strong>Description:</strong><br>{{ $donation->description }}</p>

                <hr>

                <h4 class="mt-4">Created by:</h4>
                @if($donation->Restaurant)
                    <div class="d-flex align-items-center mt-2">
                        <img src="{{ $restaurantImage }}" alt="Restaurant Image" class="rounded-circle" width="80" height="80">
                        <div class="ms-3">
                            <h5 class="mb-1">{{ $donation->Restaurant->restaurantName }}</h5>
                            <p class="mb-0"><strong>Location:</strong> {{ $donation->Restaurant->location }}</p>
                        </div>
                    </div>
                @else
                    <p>Restaurant information not available.</p>
                @endif
                @if(Session::get('user'))
                <span style="display:none" id="productprice">{{($donation->price)}}</span>
                <h4>Cost:  </h4><b><span id="totalcost"> {{$donation->price}} </span> </b>
                
                <form method="post" action="{{route('addtransaction',['id'=> $donation->id])}}">
                    @csrf
                <div style="display:flex;width:200px;float:right;justify-content:center;">
                <button type="button" class="btn btn-dark" onclick="decreasequantity()">-</button>
                <input type="number" id="quantity" name="quantity" name="count" class="form-control" style="width:30%;text-align:center;" value="1" min="1">
                <button type="button" class="btn btn-dark" onclick="addquantity()">+</button>
                
                
</div>
<br>
<br>        
<div style="display:flex;width:200px;float:right;justify-content:center;">
                <button type="submit" class="btn btn-dark">Add to Order</button>
</div>
</form>
@endif
            </div>
        </div>
    @endif
</div>


@endsection