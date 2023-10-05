@extends('layouts.admin')
@section('title')| List of users @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List of users</h1>
    </div>
    <h2>Users</h2>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Admin rights</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            Yes <label for="update-is-admin-form__{{ $user->id }}__submit" class="btn btn-danger">Revoke admin rights</label>
                        @else
                            No <label for="update-is-admin-form__{{ $user->id }}__submit" class="btn btn-success">Grant admin rights</label>
                        @endif
                        <form class="d-none" action="{{ route('admin.users.updateIsAdmin', $user) }}" method="post">@csrf @method('PUT')
                            <input id="update-is-admin-form__{{ $user->id }}__submit" type="submit">
                        </form>
                    </td>
                </tr>
            @empty
                <p>There are no users</p>
            @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
