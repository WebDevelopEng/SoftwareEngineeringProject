@extends('templates.headandfoot')
@section('title')
    Membership
@endsection

@section('content')
@php
$user = Session::get('user');
@endphp
<script src="{{asset('viewjs/subscription.js')}}"></script>
<link href="{{asset('viewcss/subscription.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

{{--content--}}
<body style="background-color: blanchedalmond">
    
</body>
<div class="card" id="title-card">
    <div class="card-body text-center">
        <h3 id="title-text">DonaCook Membership</h3>
    </div>
</div>

{{--benefit--}}
<div class="card my-5 shadow animate__animated animate__fadeInUp" id="benefit-card">
    <div class="card-body">
        <h4 class="card-title text-center fw-bold mb-4">WHY JOIN DONACOOK MEMBERSHIP</h4>
        <div class="text-center mb-4">
            <span class="badge fs-6 px-3 py-2">For only Rp 2,000 / day</span>
        </div>
        <ul class="list-unstyled">
            <li class="mb-3" id="benefit-item">
                <i class="bi bi-check-circle-fill me-2"></i>
                No ads – Enjoy a seamless, distraction-free experience.
            </li>
            <li class="mb-3" id="benefit-item">
                <i class="bi bi-check-circle-fill me-2"></i>
                Access exclusive member-only, nutritious recipes made from simple, affordable ingredients.
            </li>
            <li class="mb-3" id="benefit-item">
                <i class="bi bi-check-circle-fill me-2"></i>
                Priority support and early access to events and workshops.
            </li>
        </ul>
    </div>
</div>

{{--other card--}}
<div class="row justify-content-center g-4">
    {{-- Balance Card --}}
    <div class="col-md-6">
        <div class="card shadow animate__animated animate__fadeInUp" id="benefit-card">
            <div class="card-body text-center">
                <h5 class="card-title fw-bold mb-3">Your Balance</h5>
                <p class="fs-4 text-success">Rp {{ $user->balance }}</p>
            </div>
        </div>
    </div>

    {{-- Subscription Form Card --}}
    <div class="col-md-6">
        <div class="card shadow animate__animated animate__fadeInUp" id="benefit-card">
            <div class="card-body">
                <h5 class="card-title fw-bold mb-3 text-center">Join the Membership</h5>

                {{-- Membership Price --}}

                <form method="post" action="{{ route('subscribe') }}">
                    @csrf
                    @if(isset($error1))
                    <div class="alert alert-warning text-center">Insufficient balance!</div>
                    @endif
                    <label for="enddate" class="form-label">Enter the end date of your subscription</label>
                    <input class="form-control mb-3" type="date" id="enddate" name="enddate">

                    <div class="d-grid">
                        <button class="btn btn-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')