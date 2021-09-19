@php
    /** @var  \App\Entities\User\UserEntity[] $users */
@endphp

@extends('app')

@section('content')
        <p style="margin: 10px"><a href="{{ route("admin.users.add") }}" class="btn btn-success">Add User</a></p>
    <table style="margin: 10px" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Is admin</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->getId() }}</td>
                <td><a href="{{ route("admin.users.edit", ["user_id" => $user->getId()]) }}">{{ empty($user->getName()) ? 'noname' : $user->getName() }}</a></td>
                <td>{{ $user->getEmail() }}</td>
                <td>
                    @if ($user->isIsAdmin())
                        <span class="badge badge-danger">Admin</span>
                    @else
                        <span class="badge badge-secondary">User</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection




