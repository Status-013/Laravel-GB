@extends('layouts.app')
@section('title')| {{ $categoryName }} @stop
@section('content')
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-6 fst-italic">{{ ucfirst($categoryName) }}</h1>
        </div>
    </div>
    <div class="row mb-2">
        @forelse($news as $post)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">{{ ucfirst($categoryName) }}</strong>
                        <img alt="post image" src="{{ $post->image_url ? asset($post->image_url) : asset('storage/placeholder.png') }}">
                        <h3 class="mb-0">{{ $post->title }}</h3>
                        <p class="card-text mb-auto">{{ $post->description }}</p>
                        <a href="{{ route('news.show', ['categoryId' => $post->category_id, 'postId' => $post->id]) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                            Read more
                            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>There are no news</p>
        @endforelse
    </div>
    {{ $news->links() }}
@endsection
