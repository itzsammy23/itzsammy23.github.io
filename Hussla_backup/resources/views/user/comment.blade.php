@extends('layouts.app')
<body style="background-color: #f2f2f2;">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2 style="color: #0059b3;">Reviews on {{ session('user')}}</h2>
        @if(count($comments) > 0)
            @foreach($comments as $comment)
            <div class="card mt-4 mb-4">
                <div class="card-header font-weight-bold" style="color: #000d1a;">{{ $comment->customer }}'s review</div>
                    <div class="card-body">
                            <div class="user-review">{{ $comment->comment }}</div>
                            <div class="pt-4 created-at">This review was posted on {{ $comment->created_at->format('Y-m-d') }}</div>
                    </div>
            </div>
            @endforeach
            @else 
            <div align="center" class="pt-4" style="font-size: 22px">No reviews for this service provider.</div>
            @endif

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{$comments->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
</body>