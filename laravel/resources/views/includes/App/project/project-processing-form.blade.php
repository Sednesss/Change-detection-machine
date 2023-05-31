<div class="project-title">
    {{ $project->name }}
</div>
<div class="project-type">
    [{{ $project->type }}]
</div>
<div class="project-properties">
    <form method="POST" action="{{ route('api.projects.processing') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $project->id }}">

        <div class="properties-elements">
            <div class="properties-element">
                <div class="prop">
                    <label for="start_date">Начальная дата:</label>
                    <input type="date" id="start_date" name="start_date" min="{{ $global_value_project_data_min ?? '' }}" max="{{ $global_value_project_data_max ?? '' }}" {{ $global_value_project_status == 'creadted' ? 'disabled="disabled"' : '' }}>
                </div>

                <div class="prop">
                    <label for="end_date">Конечная дата:</label>
                    <input type="date" id="end_date" name="end_date" min="{{ $global_value_project_data_min ?? '' }}" max="{{ $global_value_project_data_max ?? '' }}" {{ $global_value_project_status == 'creadted' ? 'disabled="disabled"' : '' }}>
                </div>
            </div>
        </div>
        <div class="properties-elements">
            <div class="status">
                <div class="status-title">Статус:</div>
                <div class="status-value">{{ $project->status }}</div>
            </div>
            <div class="buttons">
                <button type="submit">Начать обработку</button>
            </div>
        </div>
    </form>
</div>