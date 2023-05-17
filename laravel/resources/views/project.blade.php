@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/project.css') }}">
<link rel="stylesheet" href="../../../js/ol/ol.css">
<script src="{{ asset('js/CDM/App/pages/project.js') }}" type="module"></script>
<script>
    var global_value_project_map_center_x = "{{ $global_value_project_map_center_x }}";
    var global_value_project_map_center_y = "{{ $global_value_project_map_center_y }}";
</script>
@endpush


@section('title')
{{ $project['name'] }}
@endsection

@section('content')
<div class="project">
    <div class="project-title">
        {{ $project['name'] }}
    </div>
    <div class="project-type">
        [{{ $project['type'] }}]
    </div>
    <div class="project-properties">
        <div class="project-properties-element">
            <label for="start-date">Начальная дата:</label>
            <input type="date" id="start-date" name="start-date" 
            min="{{ $global_value_project_data_min ?? '' }}"
            max="{{ $global_value_project_data_max ?? '' }}"
            {{ $global_value_project_status == 'creadted' ? 'disabled="disabled"' : '' }}
            >

            <label for="end-date">Конечная дата:</label>
            <input type="date" id="end-date" name="end-date" 
            min="{{ $global_value_project_data_min ?? '' }}"
            max="{{ $global_value_project_data_max ?? '' }}"
            {{ $global_value_project_status == 'creadted' ? 'disabled="disabled"' : '' }}
            >
        </div>
    </div>
</div>

<div class="map-section">
    <div id="map"></div>
</div>

<div class="satellite-images">
    <div class="satellite-images-header">
        <div class="satellite-images-header-title">
            Список снимков
        </div>
        <div class="satellite-images-header-button">
            @foreach($table_images_buttons as $title => $link)
            <a href="{{ route($link, ['slug' => $project->slug]) }}">{{ $title }}</a>
            @endforeach
        </div>
    </div>

    <div class="satellite-images-table">
        <div>
            image
        </div>
        <div>
            image
        </div>
        <div>
            image
        </div>
    </div>
</div>


@endsection