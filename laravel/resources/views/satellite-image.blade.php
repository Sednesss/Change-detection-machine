@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/satellite-image.css') }}">
<link rel="stylesheet" href="../../../js/ol/ol.css">
<script src="{{ asset('js/CDM/App/pages/project.js') }}" type="module"></script>

<script>
    var global_value_satellite_image_map_center_x = "{{ $global_value_satellite_image_map_center_x }}";
    var global_value_satellite_image_map_center_y = "{{ $global_value_satellite_image_map_center_y }}";
</script>
@endpush

@section('title')
{{ $satellite_image->name }}
@endsection

@section('content')
<div class="image">
    <div class="header">
        <div class="title">{{ $satellite_image->name }}</div>
        <div class="properties">
            <div class="type">[{{ $satellite_image->type }}]</div>
            <div class="status">
                <div class="title">Статус:</div>
                <div class="value">{{ $satellite_image->status }}</div>
            </div>
        </div>
    </div>
    @if (count($satellite_image->channelEmission)==0)
    <div class="form">
        @if ($satellite_image->type=='single-channel')
        @include('includes.App.single-channel-form')
        @else
        @include('includes.App.multichannel-form')
        @endif
    </div>
    @else
    <div class="view">
        @if ($satellite_image->type=='single-channel')
        @include('includes.App.single-channel-view')
        @else
        @include('includes.App.multichannel-view')
        @endif
        @endif
    </div>
</div>
@endsection