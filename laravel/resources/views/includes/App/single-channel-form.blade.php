<form method="POST" action="{{ route('api.projects.satellite_images.create') }}">
    @csrf
    <input type="hidden" name="project_id" value="{{ $project->id }}">
    <div class="input-data-form-input-field-section">
        <label for="name">Название</label>
        <input type="text" id="name" name="name" autocomplete="name" required>
    </div>

    <div class="input-data-form-input-field-section">
        <label for="type">Тип снимка</label>
        <select id="type" name="type">
            <option value="single-channel">Одноканальный</option>
            <option value="multichannel">Многоканальный</option>

        </select>
    </div>

    <div class="input-data-form-button-section">
        <button type="submit">Продолжить</button>
    </div>
</form>