@php
    /** @var  \App\Entities\Link\LinkEntity $link */
@endphp

@extends('app')

@section('content')
    <p style="margin: 10px"><a href="{{ route("user.links.add") }}" class="btn btn-success">{{ __("Add Link") }}</a></p>
    <div style="padding: 10px">
        {{ $links['data']->links() }}
    </div>
    <table style="margin: 10px" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#
            </th>
            <th>{{ __("Link Name") }} <i data-toggle="tooltip" data-placement="top" class="help-tip bi bi-question-circle-fill" title="{{ __("The name of the link") }}"></i></th>
            <th>{{ __("Links To") }} <i data-toggle="tooltip" data-placement="top" class="help-tip bi bi-question-circle-fill" title="{{ __("The link which will be openned when user clicks on the picture") }}"></i></th>
            <th>{{ __("FB Link") }} <i data-toggle="tooltip" data-placement="top" class="help-tip bi bi-question-circle-fill" title="{{ __("Generated link to copy and paste into Facebook") }}"></i> </th>
            <th>{{ __("Hits") }} <i data-toggle="tooltip" data-placement="top" class="help-tip bi bi-question-circle-fill" title="{{ __("How many times people clicked on this link") }}"></i> </th>
            <th>{{ __("Header") }} <i data-toggle="tooltip" data-placement="top" class="help-tip bi bi-question-circle-fill" title="{{ __("The header which will be below the picture") }}"></i></th>
            <th>{{ __("Picture") }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($links['links'] as $link)
            <tr>
                <td>{{ $link->getId() }}</td>
                <td><a href="{{ route("user.links.edit", ["link_id" => $link->getId()]) }}">{{ empty($link->getName()) ? __('noname') : $link->getName() }}</a></td>
                <td class="help-tip" title="{{ $link->getLink() }}"><a href="{{ $link->getLink() }}" target="_blank">{{ $link->getLinkName() }}</a></td>
                <td><a href="{{ $link->getFBLink() }}" target="_blank">{{ __("FB Link") }}</a></td>
                <td>{{ $link->getHits() }}</td>
                <td class="help-tip" title="{{ $link->getHeader() }}">{{ $link->getSubstrHeader() }}</td>
                <td>
                    @if ($link->hasPicture())
                        <span class="badge badge-success">{{ __("picture") }}</span>
                    @else
                        <span class="badge badge-danger">{{ __("no picture") }}</span>
                    @endif
                        <a href="{{ route("user.links.edit_picture", ["link_id" => $link->getId()]) }}" >[{{ __("edit") }}]</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div style="padding: 10px">
        {{ $links['data']->links() }}
    </div>
@endsection




