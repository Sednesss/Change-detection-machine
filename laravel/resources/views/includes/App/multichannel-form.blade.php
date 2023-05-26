<form method="POST" action="{{ route('api.projects.satellite_images.upload.multi') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $satellite_image->id }}">
    <div class="input-data">
        <label for="name">Многоканальный спутниковый снимок</label>
        <input type="file" id="file" name="file" required>
    </div>

    <div class="send-button">
        <button type="submit">Продолжить</button>
    </div>
</form>