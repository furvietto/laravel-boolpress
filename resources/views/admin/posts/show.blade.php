@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title">{{$post->title}}</h5>
                      <h5 class="card-title">{{$post->content}}</h5>
                      <p class="card-text">{{$post->author}}</p>
                      <a href="{{route("admin.posts.index")}}" class="btn btn-primary">go indietro</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection