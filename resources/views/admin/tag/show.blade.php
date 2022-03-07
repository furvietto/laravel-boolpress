@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    All posts of tags: {{ $tag->name }}
                </h1>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tag->posts()->get() as $post)
                    <tr>
                       <th>{{$post->id}}</th> 
                       <th>{{$post->title}}</th> 
                       <th>{{$post->author}}</th> 
                       <th>{{$post->created_at}}</th> 
                       <th>{{$post->updated_at}}</th> 
                       <th><a class="btn btn-warning" href="{{route("admin.posts.show", $post)}}">View</a></th> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
