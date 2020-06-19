@extends('layouts.app')
<body style="background-color: #f2f2f2;">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2 style="color: #0059b3;">Reviews of {{ session('user')}}</h2>
            @foreach($comments as $comment)
            <div class="card mt-4 mb-4">
                <div class="card-header font-weight-bold" style="color: #000d1a;">{{ $comment->customer }}'s review</div>
                    <div class="card-body">
                            <div>{{ $comment->comment }}</div>
                            <div class="pt-4">This review was posted on {{ $comment->created_at }}</div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</div> 
@endsection
</body>