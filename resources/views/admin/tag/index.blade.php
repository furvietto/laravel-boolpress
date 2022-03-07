@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        
    </div>
    <div class="row align-items-center justify-content-between">
        <div class="col-4">
            <h1 class="h1">Tags - All Tags</h1>
        </div>
        <div class="col-2">
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Add new Tags</a>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col">
             <table class="table table-primary">
                <thead>
                    <tr class="table-primary">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th colspan="3">Actions</th>    
                    </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td>{{ $tag->updated_at }}</td>
                        <td><a href="{{route("admin.tags.show", $tag->slug)}}" class="btn btn-warning">View</a></td>
                        <td>     
                            <a href="{{route("admin.tags.edit", $tag->slug)}}" class="btn btn-primary">Edit</a>
                        </td>
                        
                        <td>    
                            <form action="{{route("admin.tags.destroy", $tag)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection