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
            <form method="POST" action="{{ route('user.links.update', ["link_id" => $link->getId()]) }}">

                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" class="form-control" name="name" value="{{ $link->getName() }}">
                </div>

                <div class="form-group">
                    <label for="link" class="col-form-label">Link To</label>
                    <input id="link" type="text" class="form-control" name="link" value="{{ $link->getLink() }}" required>
                </div>

                <div class="form-group">
                    <label for="header" class="col-form-label">Header</label>
                    <input id="header" type="text" class="form-control" name="header" value="{{ $link->getHeader() }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route("user.links") }}" class="btn btn-success">Back to list</a>
                </div>
            </form>
            <form method="POST" action="{{ route('user.links.delete', ["link_id" => $link->getId()]) }}">
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-danger">Delete link</button>
                </div>
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
@endsection
