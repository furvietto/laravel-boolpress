@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">Titolo: {{$post->title}}</h5>
                      <h5 class="card-title">Content: {{$post->content}}</h5>
                      <h5 class="card-title">Category: {{$post->category()->first()->name}}</h5>
                      <h5 class="card-title">Tags: </h5>
                      @if (count($post->tags()->get()) != 0) 
                      @foreach ($post->tags()->get() as $tag)
                         <a href="{{route("admin.tags.show",$tag)}}">{{$tag->name}}</a> 
                      @endforeach
                      @else
                          Nessun Tag
                      @endif
                      <p class="card-text">Author: {{$post->author}}</p>
                      <a href="{{route("admin.posts.index")}}" class="btn btn-primary">go indietro</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
