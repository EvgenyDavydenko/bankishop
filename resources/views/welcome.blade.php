@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($images as $image)
        <div class="col-md-4 col-12 mb-3">

            <div class="card h-100">
                <img src="{{ Storage::url('images/'.$image->filename) }}" alt="{{ $image->filename }}"class="card-img-top" style=" height: auto;">

                <div class="card-body">
                  <h5 class="card-title"><a href="{{ Storage::url('images/'.$image->filename) }}">{{ $image->filename }}</a></h5>
                  <p class="card-text">Uploaded at: {{ $image->created_at }}</p>
                  <a href="{{ route('images.download.zip', $image->id) }}" class="btn btn-primary">Download ZIP</a>
                </div>
              </div>
        </div>
    @endforeach
    </div>
</div>
@endsection