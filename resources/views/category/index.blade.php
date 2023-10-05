@extends('layouts.app')
@section('title')| Categories @stop
@section('content')
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-6 fst-italic">Categories</h1>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="btn-group">
            @forelse($categories as $category)
                <a href="{{ route('news.index', ['categoryId' => $category->id]) }}" class="btn btn-primary border-dark" aria-current="page">{{ ucfirst($category->name) }}</a>
            @empty
                <p>There are no categories</p>
            @endforelse
        </div>
    </div>
    {{ $categories->links() }}
@endsection
