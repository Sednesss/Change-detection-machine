<div class="properties">
    <div class="files">
        <div class="file">
            <div class="title">Зелёный видимый спектр</div>
            <div class="row">
                <div class="value">qwerty.png</div>
                <div><a href=""></a>Изменить файл</div>
            </div>
            <form method="POST" action="{{ route('api.projects.satellite_images.upload.single') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $satellite_image->id }}">

                <div class="input">
                    <div class="input-row">
                        <div class="input-data">
                            <label for="green">Зелёный видимый спектр (Green)</label>
                            <input type="file" id="green" name="green" required>
                        </div>
                        <div class="input-data">
                            <label for="nir">Ближний инфракрасный спектр (NIR)</label>
                            <input type="file" id="nir" name="nir" required>
                        </div>
                    </div>
                </div>
                <div class="send-button">
                    <button type="submit">Продолжить</button>
                </div>
            </form>
        </div>
    </div>
    <div class="coordinates">

    </div>
</div>
<div class="map">

</div>