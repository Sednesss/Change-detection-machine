@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/project.css') }}">
@vite(['resources/js/components/map.js'])
@vite(['resources/css/components/map.css'])
<script>
    var global_value_project_map_center_x = "{{ $global_value_project_map_center_x }}";
    var global_value_project_map_center_y = "{{ $global_value_project_map_center_y }}";

    var global_value_images_coordinates = "{{ $map }}";
    var global_value_images_colors = "{{ $colors }}";
</script>
@endpush


@section('title')
{{ $project->name }}
@endsection

@section('content')
<div class="project">
    <div class="project-title">
        {{ $project->name }}
    </div>
    <div class="project-type">
        [{{ $project->type }}]
    </div>
    <div class="project-properties">
        <div class="properties-elements">
            <div class="properties-element">
                <div class="prop">
                    <label for="start-date">Начальная дата:</label>
                    <input type="date" id="start-date" name="start-date" min="{{ $global_value_project_data_min ?? '' }}" max="{{ $global_value_project_data_max ?? '' }}" {{ $global_value_project_status == 'creadted' ? 'disabled="disabled"' : '' }}>
                </div>

                <div class="prop">
                    <label for="end-date">Конечная дата:</label>
                    <input type="date" id="end-date" name="end-date" min="{{ $global_value_project_data_min ?? '' }}" max="{{ $global_value_project_data_max ?? '' }}" {{ $global_value_project_status == 'creadted' ? 'disabled="disabled"' : '' }}>
                </div>
            </div>
            <div class="properties-element">
            </div>
        </div>
        <div class="properties-elements">
            <div class="status">
                <div class="status-title">Статус:</div>
                <div class="status-value">{{ $project->status }}</div>
            </div>
            <div class="buttons">
                <a href="">Начать обработку</a>
            </div>
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
        @if (count($project->satelliteImage)==0)
        <div class="satellite-images-table-empty">Добавьте спутниковые снимки, для обработки</div>
        @else
        <div class="satellite-images-table-section">
            @foreach($project->satelliteImage as $satellite_image)
            <div class="satellite-images-table-element">
                <div class="title">
                    <a href="{{ route('projects.image', ['project_slug' => $project->slug, 'slug' => $satellite_image->slug]) }}">{{ $satellite_image->name }}</a>
                </div>
                <div class="properties">
                    <div class="properties-one">
                        <div class="date">
                            <div class="title">Дата изменения</div>
                            <div class="value">{{ $satellite_image->updated_at }}</div>
                        </div>
                        <div class="colour">
                            <div class="title">Цвет</div>
                            <div class="value" style="background-color:{{ $satellite_image->colour }}"></div>
                        </div>
                    </div>
                    <div class="properties-two">
                        <div class="title">Координаты</div>
                        @if (isset(json_decode($map, true)[$satellite_image->id]))
                        @foreach(range(1, 4) as $position)
                        <div class="value">Long: {{ json_decode($map, true)[$satellite_image->id][$position]['x'] }}; Lat: {{ json_decode($map, true)[$satellite_image->id][$position]['y'] }}</div>
                        @endforeach
                        @else

                        @foreach(range(1, 4) as $position)
                        <div class="value">Long: __.__; Lat: __.__</div>
                        @endforeach
                        @endif
                    </div>
                    <div class="buttons">
                        <div class="status">
                            <div class="title">Статус</div>
                            <div class="value">{{ $satellite_image->status }}</div>
                        </div>
                        <div class="update">
                            <a href="{{ route('projects.image', ['project_slug' => $project->slug, 'slug' => $satellite_image->slug]) }}">
                                <div class="q">Изменить</div>
                            </a>
                        </div>

                        <div class="delete">
                            @foreach($table_images_buttons_element_delete as $title => $link)
                            <form method="POST" action="{{ route($link) }}">
                                @csrf
                                <input type="hidden" name="slug" value="{{ $satellite_image->slug }}">
                                <button type="submit">{{ $title }}</button>
                            </form>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
        @endif

    </div>
</div>


@endsection