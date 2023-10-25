@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <a class="btn btn-secondary float-end mt-3 ml-1 pl-1" href="/blog">Back</a>
                    <h1 class="display-4">
                        @if($post)
                            Edit
                        @else
                            Create new post
                        @endif
                    </h1>

                    <form class="form-data" action="@if(isset($post)) /blog/{{$post->id}}/edit @else /blog/create/new @endif
                    " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input id="id" type="hidden" name="blog-id" value="{{$post->id ?? ''}}">
                            <div class="control-group col-12">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Post Title" required value="{{$post->title ?? ''}}">
                            </div>
                            <div class="control-group col-12 mt-4">
                                <label for="content">Content</label>
                                <textarea id="content" class="form-control" name="content" placeholder="Enter Post Content" cols="30" rows="10"
                                          required>{{$post->content ?? ''}}</textarea>
                            </div>
                            <div class="control-group col-8 mt-4">
                                <div class="preview" >
                                    <img class="preview img-thumbnail" src="{{$post->image??''}}" alt="">
                                </div>
                                <label for="image">Image</label>
                                <input class="upload-image form-control" type="file" name="image">
                            </div>
                            <div class="control-group col-5 mt-4">
                                <label for="status">Status</label>
                                <select class="form-select form-select-sm" id="status" name="status">
                                    <option @selected(old('selected', $post->status ?? true)) value=1>Enabled</option>
                                    <option @selected(!(old('selected', $post->status ?? false))) value=0>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary @if(isset($post)) bth-edit @else @endif">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
