@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/projects.css') }}">
@endpush

@section('title')
Мои проекты
@endsection

@section('content')
<div class="table-header-section">
    <div class="table-header-title-section">
        Список проектов
    </div>
    <div class="table-header-button-section">
        @foreach($table_header_buttons as $title => $link)
        <a href="{{ route($link) }}">{{ $title }}</a>
        @endforeach
    </div>
</div>
<div class="table-content-section">

    @foreach($projects as $project)
    <div class="table-content-element-section">
        <div class="table-content-element-text-section">
            <a href="{{ route('project', ['slug' => $project->slug]) }}">{{ $project->name }}</a>

            <div class="table-content-element-text-property-section">
                <qwerty>Тип спутника:</qwerty>
                <qwerty-value>{{ $project->type }}</qwerty-value>
            </div>

            <div class="table-content-element-text-property-section">
                <qwerty>Количество снимков</qwerty>
                <qwerty-value>{{ count($project->SatelliteImage) }}</qwerty-value>
            </div>

            <div class="table-content-element-text-property-section">
                <qwerty>Создан:</qwerty>
                <qwerty-value>{{ $project->created_at }}</qwerty-value>
            </div>

            <div class="table-content-element-text-property-section">
                <qwerty>Изменён:</qwerty>
                <qwerty-value>{{ $project->updated_at }}</qwerty-value>
            </div>
        </div>
        <div class="table-content-element-image-section">
            <img src="{{ asset('img/CDM/App/intersect.png') }}" alt="">
        </div>
    </div>
    @endforeach

</div>
@endsection