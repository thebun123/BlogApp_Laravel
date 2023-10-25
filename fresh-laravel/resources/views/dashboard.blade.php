

@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>You're logged in!</p>
                <br>
                <a href="/" class="btn btn-outline-primary">Manage Blog</a>
            </div>
        </div>
    </div>
@endsection
