
@extends('app')

@section('content')
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            @if (!empty($errors))
                <div style='margin-top: 10px' class="alert alert-danger" role="alert">
                    @foreach ($errors as $field => $field_errors)
                        @foreach ($field_errors as $error)
                            <p><strong>{{ $field }}</strong>: {{ $error }}</p>
                        @endforeach
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('admin.users.store') }}">

                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" class="form-control" name="name" value="">
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="" required>
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="" required>
                </div>

                <div class="form-group">
                    <label for="is_admin" class="col-form-label">Is Admin</label>
                    <input id="is_admin" type="checkbox" name="is_admin" value="1">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route("admin.users") }}" class="btn btn-success">Back to list</a>
                </div>
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
@endsection
