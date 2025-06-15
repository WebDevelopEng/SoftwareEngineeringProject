@extends('templates.headandfoot')

@section('title', 'Ad Management')

@section('content')
<link href="{{ asset('viewcss/addashboard.css') }}" rel="stylesheet">

<body style="background-color: blanchedalmond">
    <div class="ad-card2">
        <h3 class="ad-title">Ad Management</h3>
        <div class="row gx-4">
            {{-- View Ads --}}
            <div class="col-md-7 mb-4">
                @if(isset($ads))
                    @foreach($ads as $ad)
                        @php $imagestring = "/storage/advertimages/" . $ad->image; @endphp
                        <div class="ad-card p-3 mb-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex" style="width: 100%;">
                                @if($ad->image)
                                <img src="{{ $imagestring }}" class="img-thumbnail me-3" style="object-fit:cover;height:100px;width:120px;border-radius:8px;">
                                @endif
                                <div class="flex-grow-1 title-desc">
                                    <strong>Title:</strong> {{ $ad->title }} <br>
                                    <strong>Description:</strong> {{ Str::limit($ad->description, 50) }}
                                </div>
                                <div class="d-flex flex-column justify-content-center gap-2 ms-3">
                                    <a href="{{ route('editad', ['id' => $ad->id]) }}" class="btn-submit small-btn">Edit</a>
                                </div>
                                <div class="d-flex flex-column justify-content-center gap-2 ms-3">
                                    <a href="{{ route('deletead', ['id' => $ad->id]) }}" class="btn-submit small-btn danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Pagination --}}
                <div class="pagination-wrapper mt-3">
                    {{ $ads->links() }}
                </div>
            </div>

            {{-- Create Ad Form --}}
            <div class="col-md-5 mb-4">
                <div class="create-card p-4">
                    <h5 class="ad-title">Create New Ad</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('createads') }}" enctype="multipart/form-data" class="ad-form mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>

                        <button type="submit" class="btn-submit mt-2">Create Ad</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection





