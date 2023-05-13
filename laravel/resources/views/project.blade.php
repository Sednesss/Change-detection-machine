@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/project.css') }}">
@endpush

@section('title')
{{ $project['name'] }}
@endsection

@section('content')
<div>
    {{ $project['name'] }}
</div>
<div>
    {{ $project['slug'] }}
</div>

@endsection