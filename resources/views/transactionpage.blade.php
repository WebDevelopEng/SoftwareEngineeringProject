@extends('templates.headandfoot')

@section('title', 'My Transaction')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">My Transaction</h2>

    @if(isset($transaction) && $transaction->items->count() > 0)
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Donation</th>
                    <th>Restaurant</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Available</th>
                    <th>Quantity</th>
                    <th>Cancel</th>
                    
                </tr>
            </thead>
            <tbody>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                @foreach($transaction->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/donationimages/' . $item->donation->image) }}" alt="Donation Image" width="80" class="me-3 rounded">
                                <div>
                                    <strong>{{ $item->donation->name }}</strong><br>
                                    <small>{{ Str::limit($item->donation->description,75) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($item->donation->restaurant->image==null)
                            @php
                                $imageurl=asset('profileimage/defaultimage.jpg');
                            @endphp
                            @else
                            @php
                                 $imageurl='storage/profileimages/'.$item->donation->restaurant->image;
                            @endphp

                            @endif
                            <div class="d-flex align-items-center">
                                <img src="{{ $imageurl }}" alt="Restaurant Image" width="50" class="rounded-circle me-2">
                                <div>
                                    <strong>{{ $item->donation->restaurant->restaurantName }}</strong><br>
                                    <small>{{ $item->donation->restaurant->location }}</small>
                                </div>
                            </div>
                        </td>
                        <td>${{ number_format($item->donation->price) }}</td>
                        <td>${{ number_format($item->donation->price * $item->quantity) }}</td>
                        <td>{{$item->donation->count}}
                        </td>
                        <td>
                            <form action="{{ route('edittransactionitem') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="transactionitemid" value="{{ $item->id }}">
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                    <input type="number" name="quantity" id="quantity-{{ $item->id }}" value="{{ $item->quantity }}" min="1" class="form-control text-center" style="width: 60px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                                    <button type="submit" class="btn btn-primary ms-2">Update</button>
                                </div>
                            </form>
                        </td>
                        
                        <td>
                            <form action="{{ route('deletetransactionitem') }}" method="POST">
                                @csrf
                                <input type="hidden" name="transactionitemid" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-end"><strong>Total</strong></td>
                    <td colspan="2"><strong>Rp. {{ number_format($totalcost, 2) }}</strong></td>
                </tr>
                @php
                        $currentfunds=(float) Session::get('user')->balance;
                    @endphp
                <tr>
                    <td colspan="5" class="text-end"><strong>Balance</strong></td>
                    <td colspan="2"><strong>Rp. {{ number_format($currentfunds) }} - Rp. {{number_format($totalcost)}}</strong></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end"><strong>Final Balance</strong></td>
                    <td colspan="2"><strong>Rp. {{ number_format($currentfunds-$totalcost) }}</strong></td>
                </tr>
                @if ($currentfunds < $totalcost)
                <tr>   
                    <td colspan="5"></td>
                    <td colspan="2"><strong>Insufficient Funds!</strong></td>
                </tr>
                
                @endif
            </tbody>
        </table>

        <div class="text-end">
            <form action="{{ route('confirmtransaction') }}" method="POST">
                <input type="hidden" value="{{$totalcost}}" name="totalcost">
                <input type="hidden" value="{{$transaction->id}}" name="transactionid">
                @csrf
                @if ($totalcost > $currentfunds)
                <button class="btn btn-success" disabled>Confirm Transaction</button>
                @else
                <button class="btn btn-success">Confirm Transaction</a>
                @endif
            </form>
        </div>
    @else
        <div>
            You have no active transaction items.
        </div>
    @endif
</div>

<script>
    function updateQuantity(id, change) {
        const input = document.getElementById(`quantity-${id}`);
        let current = parseInt(input.value);
        if (change < 0 && current > 1) {
            input.value = current - 1;
        } else if (change > 0) {
            input.value = current + 1;
        }
    }
</script>
@endsection