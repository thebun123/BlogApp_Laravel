@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="titlebar">
            <a class="btn btn-secondary float-end mt-3" href="/blog" role="button">Back</a>
            <h1>Show</h1>
        </div>

        <div class="card p-3">
            <h5 class="card-title">{{$post->title ?? ''}}</h5>
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$post->image ?? ''}}" class="img-fluid rounded-start" alt="No Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text">{!! $post->content ?? '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
