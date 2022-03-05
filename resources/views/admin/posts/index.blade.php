@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        
    </div>
    <div class="row align-items-center justify-content-between">
        <div class="col-4">
            <h1 class="h1">Posts - All Posts</h1>
        </div>
        <div class="col-2">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add new Post</a>
        </div>
    </div>
    
    @if (session("status"))
        <div class="alert alert-success">
            {{session("status")}}
        </div>
    @endif
    <div class="row">
        <div class="col">
             <table class="table table-primary">
                <thead>
                    <tr class="table-primary">
                        <th>Title</th>
                        <th>Author</th>
                        <th>Content</th>
                        <th>Tags</th>
                        <th colspan="3">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            @foreach ($post->tags()->get() as $tag)
                               <a href="">{{$tag->name}}</a> 
                            @endforeach
                        </td>
                        <td><a href="{{route("admin.posts.show", $post->slug)}}" class="btn btn-warning">View</a></td>
                        <td>
                            @if (Auth::user()->id === $post->user_id)
                            <a href="{{route("admin.posts.edit", $post->slug)}}" class="btn btn-primary">Edit</a>
                            @endif
                        </td>
                        
                        <td>
                            @if (Auth::user()->id === $post->user_id)
                            <form action="{{route("admin.posts.destroy", $post)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection