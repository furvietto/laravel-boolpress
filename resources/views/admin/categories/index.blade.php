@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
        </div>
        <div class="row align-items-center justify-content-between">
            <div class="col-5">
                <h1 class="h1">Categories - All Categories</h1>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add new Categories</a>
            </div>
        </div>
        </div>
        @if (session("status"))
            <div class="alert alert-success">
                {{session("status")}}
            </div>
        @endif
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th colspan="3" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td><a class="btn btn-primary"
                                    href="{{ route('admin.categories.show', $category->slug) }}">View</a>
                            </td>
                            <td><a class="btn btn-warning"
                                    href="{{ route('admin.categories.edit', $category->slug) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{route("admin.categories.destroy",$category)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger"> Delete </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">{{ $categories->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
