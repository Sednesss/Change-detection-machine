<div class="form-title">Выберете файлы необходимых спектральных излучений спутникового снимка, для его дальнейшего машинного анализа и обнаружения водных объектов</div>
<form method="POST" action="{{ route('api.projects.satellite_images.upload.single') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $satellite_image->id }}">

    <div class="input">
        <div class="input-row">
            <div class="input-data">
                <label for="green">Выберите снимок в зелёном видимом спектре (Green)</label>
                <input type="file" id="green" name="green" required>
            </div>
            <div class="input-data">
                <label for="nir">Выберите снимок в ближнем инфракрасном спектре (NIR)</label>
                <input type="file" id="nir" name="nir" required>
            </div>
        </div>
    </div>
    <div class="send-button">
        <button type="submit">Продолжить</button>
    </div>
</form>