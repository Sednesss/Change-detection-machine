<?php

namespace App\Helpers\App;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    public function uploadSatelliteImage($file_upload)
    {
        $file_upload_path = "satellite-images/initial";
        Storage::disk('yandex_cloud')->put($file_upload_path, $file_upload);
        $file_upload_name = $file_upload->hashName();

        return $file_upload_path . '/' . $file_upload_name;
    }
}
