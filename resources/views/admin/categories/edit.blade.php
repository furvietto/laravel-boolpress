@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PATCH')
                 
                    <div class="mb-3">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old("name", $category->name)}}">
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input class="btn btn-primary" type="submit" value="Salva">
                </form>
            </div>
        </div>
    </div>
@endsection