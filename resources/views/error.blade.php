@extends('app')

@section('content')
    <h1>Error</h1>
    @if (!empty($error))
        <h3>{{ $error }}</h3>
    @endif
    <a href="/">Home</a>
@endsection

