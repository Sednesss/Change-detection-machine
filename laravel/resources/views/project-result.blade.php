@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/CDM/App/pages/project-result.css') }}">
@endpush

@section('title')
Результат обработки {{ $project->name }}
@endsection

@section('content')
<div class="project">
    <div class="project-title">
        {{ $project->name }}
    </div>
    <div class="project-type">
        [{{ $project->type }}]
    </div>

    <div class="result">
        <div class="result-row">
            <div class="element-title">Дата</div>
            <div class="element-title">Ссылка на скачивание</div>
        </div>

        @foreach($project->resultProcessing as $result)
        <div class="result-row">
            <div class="element-value">{{ $result->created_at }}</div>
            <div class="element-value">
                <a href="{{ route('projects.download', ['slug' => $project->slug, 'result_id' => $result->id]) }}">Скачать</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection