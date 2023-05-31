<div class="project-title">
    {{ $project->name }}
</div>
<div class="project-type">
    [{{ $project->type }}]
</div>
<div class="project-properties">
    <div class="properties-elements">
        <div class="status">
            <div class="status-title">Статус:</div>
            <div class="status-value">{{ $project->status }}</div>
        </div>
        <div class="buttons">
            <a href="{{ route('projects.result', ['slug' => $project->slug]) }}" target="_blank">Скачать результат обработки</a>
        </div>
    </div>
</div>