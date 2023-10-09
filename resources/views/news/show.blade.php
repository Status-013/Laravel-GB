@extends('layouts.app')
@section('title')| {{ $categoryName }}: {{ $post->title }} @stop
@section('content')
    <div class="col-md-12">
        @if($post)
            <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
                <div class="col-lg-6 px-0">
                    <h1 class="display-6 fst-italic">{{ $post->title }}</h1>
                </div>
            </div>
            <p class="blog-post-meta">Author: {{ $post->author }}</p>
            <p class="blog-post-meta">Category: {{ ucfirst($categoryName) }}</p>
            <img alt="post image" style="max-height: 300px; max-width: 100%" src="{{ $post->image_url ? asset($post->image_url) : asset('storage/placeholder.png') }}">
            <div class="p-4 mb-3 bg-body-tertiary rounded">
                <h4 class="fst-italic">About</h4>
                <p class="mb-0">{{ $post->description }}</p>
            </div>
            <p>{!!$post->content !!}</p>
        @endif
        @empty($post)
            There is no such post available
        @endempty
    </div>
@endsection
