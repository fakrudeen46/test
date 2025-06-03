@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Testimonial Details
                </div>
                <div class="card-body">
                    @if(isset($testimonial))
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($testimonial->image_path) }}" alt="{{ $testimonial->name }}" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <h1>{{ $testimonial->name }}</h1>
                                <h2 class="text-muted">{{ $testimonial->title }}</h2>
                                <hr>
                                <p style="text-align: justify;">{{ $testimonial->testimonial_text }}</p>
                                <hr>
                                <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                    @else
                        <p class="text-center">Testimonial not found.</p>
                        <div class="text-center">
                             <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
