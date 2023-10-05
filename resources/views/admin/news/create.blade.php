@extends('layouts.admin')
@section('title')| Create a post @stop
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-admin.alert type="danger" :message="$error"/>
        @endforeach
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ route('admin.news.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Some article title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" id="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ ucfirst($category->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status') == $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Some author" value="{{ old('author') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Create</button>
        </div>
    </form>
@endsection
