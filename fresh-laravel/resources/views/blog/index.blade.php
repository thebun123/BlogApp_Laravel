@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="titlebar">
                @guest
                    <a class="btn btn-primary float-end mt-3" href="/login" role="button">Log In</a>
                @endguest
                @auth
                    <h4 class="text-center">Hi {{Auth::user()->name}}</h4>
                    <form method="POST" action="{{ route('logout') }}">
                        <button class="btn btn-secondary float-end mt-3"  role="button">Log Out</button>
                    </form>
                    <a class="btn btn-primary float-end mt-3" href="/blog/create/new" role="button">Add a new post</a>
                @endauth
            </div>
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">All Blogs!</h1>
                    </div>
                </div>
                @if ($posts)
                    <table class="table table-bordered text-center" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="col-2">Image</th>
                                <th>Title</th>
                                @auth
                                <th>Status</th>
                                <th>Action</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td class="col-2"><img width="200px" height="200px" class="img-thumbnail align-items-center" src="{{$post->image}}" alt=""></td>
                                    <td><a href="/blog/{{$post->id}}">{{$post->title}}</a></td>
                                    @auth
                                    <td>
                                        @if($post->status)
                                            Enable
                                        @else
                                            Disable
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row-2">
                                            <a href="/blog/{{$post->id}}">Show</a>
                                            <a href="/blog/{{$post->id}}/edit">Edit</a>
                                            <a href="/blog/{{$post->id}}/delete">Delete</a>
                                        </div>
                                    </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-warning">No Posts available</p>
                @endif
            </div>
        </div>
        <div class="row content-center">
            <div class="input-group mb-3 col-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Nums</label>
                </div>
                <select class="product-per-page custom-select num-page-title" id="inputGroupSelect01">
                    <option @selected(old('selected', $perPage == 5)) id="5" value=5>5</option>
                    <option @selected(old('selected', $perPage == 10)) id="10" value=10>10</option>
                    <option @selected(old('selected', $perPage == 20)) id="20" value=20>20</option>
                    <option @selected(old('selected', $perPage == -1)) id="-1" value=-1>All</option>
                </select>

                <ul class="pagination pagination-sm">
                    @foreach($pages as $page)
                        <li class="page-item"><a class="page-link
                        @if($page == $currentPage)
                         active
                        @endif
                        " href="blog?page={{$page}}&limit={{$perPage}}">{{$page}}</a></li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>
@endsection
