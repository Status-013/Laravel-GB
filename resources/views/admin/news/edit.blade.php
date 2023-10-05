@extends('layouts.admin')
@section('title')| Edit the "{{ $post->title }}" post @stop
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-admin.alert type="danger" :message="$error"/>
        @endforeach
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ route('admin.news.update', $post) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Some article title" value="{{ old('title') ?? $post->title }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <img alt="post image" style="max-height: 300px; max-width: 100%" src="{{ $post->image_url ? asset($post->image_url) : asset('storage/placeholder.png') }}">
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ old('content') ?? $post->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="4" class="form-control">{{ old('description') ?? $post->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" id="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id || $post->category_id == $category->id)>{{ ucfirst($category->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status') == $status || $post->status == $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Some author" value="{{ old('author') ?? $post->author }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Edit</button>
        </div>
    </form>
@endsection
