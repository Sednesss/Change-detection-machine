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
{{ $satellite_image['name'] }}
@endsection

@section('content')
<div>{{$satellite_image['name']}}</div>
<div>{{$satellite_image['slug']}}</div>
<div>{{$satellite_image['type']}}</div>

@endsection