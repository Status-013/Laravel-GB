@extends('layouts.admin')
@section('title')| List of categories @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List of categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
            </div>
        </div>
    </div>
    <h2>Categories</h2>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ ucfirst($category->name) }}</td>
                    <td><a class="text-decoration-none" href="{{ route('admin.categories.edit', ['category' => $category]) }}">✏️</a>️ | <form method="post" class="d-inline" action="{{ route('admin.categories.delete', $category) }}">@csrf @method('DELETE')<input type="submit" value="🗑" class="bg-transparent border-0"></form></td>
                </tr>
            @empty
                <p>There are no categories</p>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
@endsection
