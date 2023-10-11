@extends('layouts.admin')
@section('title')| Create a resource @stop
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-admin.alert type="danger" :message="$error"/>
        @endforeach
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ route('admin.resources.store') }}">
        @csrf
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control" id="url" name="url" placeholder="Some RSS resource url" value="{{ old('url') }}">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" id="category">
                <option value="" selected>Optional</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ ucfirst($category->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="alert alert-info" role="alert">
            If no category is selected, the resource will be assigned to the "Off-topic" category (<a class="link-opacity-75-hover" href="{{ route('admin.categories.create') }}">Create a category</a>)
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Create</button>
        </div>
    </form>
@endsection
