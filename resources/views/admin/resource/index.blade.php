@extends('layouts.admin')
@section('title')| List of resources @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List of resources</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.resources.create') }}" class="btn btn-sm btn-outline-secondary">Create</a>
            </div>
        </div>
    </div>
    <h2>Resources</h2>
    <div class="table-responsive small col-md-12">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">URL</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($resources as $resource)
                <tr>
                    <td>{{ $resource->id }}</td>
                    <td>{{ $resource->url }}</td>
                    <td>{{ $resource->category->name }}</td>
                    <td><form method="post" class="d-inline" action="{{ route('admin.resources.delete', $resource) }}">@csrf @method('DELETE')<input type="submit" value="🗑" class="bg-transparent border-0"></form></td>
                    {{-- TODO add route to delete --}}
                </tr>
            @empty
                <p>There are no resources</p>
            @endforelse
            </tbody>
        </table>
        {{ $resources->links() }}
    </div>
@endsection
