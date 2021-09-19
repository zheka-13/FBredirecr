@php
    /** @var  \App\Entities\Link\LinkEntity[] $links */
@endphp

@extends('app')

@section('content')
    <p style="margin: 10px"><a href="{{ route("user.links.add") }}" class="btn btn-success">Add Link</a></p>
    <table style="margin: 10px" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Links To</th>
            <th>FB Link</th>
            <th>Header</th>
            <th>Has Picture</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($links as $link)
            <tr>
                <td><a href="{{ route("user.links.edit", ["link_id" => $link->getId()]) }}">{{ empty($link->getName()) ? 'noname' : $link->getName() }}</a></td>
                <td><a href="{{ $link->getLink() }}">{{ $link->getLinkName() }}</a></td>
                <td><a href="{{ $link->getFBLink() }}">FB link</a></td>
                <td>{{ $link->getSubstrHeader() }}</td>
                <td>
                    @if ($link->hasPicture())
                        <span class="badge badge-success">Has picture</span>
                    @else
                        <span class="badge badge-danger">No picture</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection




