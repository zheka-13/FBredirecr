@php
    /** @var  \App\Entities\Link\LinkEntity $link */
@endphp
@extends('app')

@section('content')
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            @include("partials.form_errors")
            <form enctype="multipart/form-data"  method="POST" action="{{ route('user.links.store_picture', ["link_id" => $link->getId()]) }}">
                <div class="form-group">
                    <label for="name" class="col-form-label">{{ __("Link Name") }}</label>
                    <input id="name" class="form-control" name="name" value="{{ $link->getName() }}" disabled>
                </div>

                <div class="form-group">
                    <label for="link" class="col-form-label">{{ __("Links To") }}</label>
                    <input id="link" type="text" class="form-control" name="link" value="{{ $link->getLink() }}" disabled>
                </div>

                <div class="form-group">
                    <label for="header" class="col-form-label">{{ __("Header") }}</label>
                    <input id="header" type="text" class="form-control" name="header" value="{{ $link->getHeader() }}" disabled>
                </div>
                <div class="form-group">
                    <img style='width: 400px' src="{{ route('image', ["hash" => $link->getHash()]) }}">
                </div>
                <div class="form-group">
                    <label for="picture" class="col-form-label">{{ __("Picture") }}</label>
                    <input id="picture" class="form-control" name="picture" type="file">
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ "Maximum file size - 1mb" }}.</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __("Upload") }}</button>
                    <a href="{{ route("user.links") }}" class="btn btn-success">{{ __("Back to list") }}</a>
                </div>
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
@endsection
