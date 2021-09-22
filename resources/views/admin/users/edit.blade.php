@php
    /** @var  \App\Entities\User\UserEntity $user */
@endphp
@extends('app')

@section('content')
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            @include("partials.form_errors")
            <form method="POST" action="{{ route('admin.users.update', ["user_id" => $user->getId()]) }}">

                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" class="form-control" name="name" value="{{ $user->getName() }}">
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">E-Mail Address</label>
                    <input id="email" disabled type="email" class="form-control" name="email" value="{{ $user->getEmail() }}">
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="">
                </div>

                <div class="form-group">
                    <label for="is_admin" class="col-form-label">Is Admin</label>
                    <input id="is_admin" type="checkbox" name="is_admin" {{ $user->isIsAdmin()? 'checked' : "" }} value="1">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route("admin.users") }}" class="btn btn-success">Back to list</a>
                </div>
            </form>
            <form method="POST" action="{{ route('admin.users.delete', ["user_id" => $user->getId()]) }}">
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-danger">Delete user</button>
                </div>
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
@endsection
