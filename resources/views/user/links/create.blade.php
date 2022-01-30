
@extends('app')

@section('content')
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            @include("partials.form_errors")
            <form method="POST" action="{{ route('user.links.store') }}">

                <div class="form-group">
                    <label for="name" class="col-form-label"> {{ __("Link Name") }}</label>
                    <input id="name" class="form-control" name="name" value="">
                </div>

                <div class="form-group">
                    <label for="link" class="col-form-label">{{ __("Links To") }}</label>
                    <input id="link" type="text" class="form-control" name="link" value="" required>
                </div>

                <div class="form-group">
                    <label for="header" class="col-form-label">{{ __("Header") }}</label>
                    <input id="header" type="text" class="form-control" name="header" value="">
                </div>

                <div class="form-group">
                    <label class="col-form-label">{{ __("You will be able to add picture after adding link") }}.</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __("Add") }}</button>
                    <a href="{{ route("user.links") }}" class="btn btn-success">{{ __("Back to list") }}</a>
                </div>
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
@endsection
