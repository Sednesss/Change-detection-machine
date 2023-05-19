<?php

namespace App\Http\Controllers\CDM;

use App\Helpers\App\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\ChannelEmission;
use App\Models\SatelliteImage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function satelliteImageMultiUpluad(Request $request)
    {
        $file_upload = $request->file('file');
        $file_upload_name = $file_upload->getClientOriginalName();

        $storage_helper = new StorageHelper();
        $file_upload_path = $storage_helper->uploadSatelliteImage($file_upload);

        // $file = Storage::disk('yandex_cloud')->get($file_upload_path);
        // dd($file);

        $satellite_image = SatelliteImage::find($request['id']);

        ChannelEmission::create([
            'satellite_image_id' => $satellite_image->id,
            'filename' => $file_upload_name,
            'path' => $file_upload_path
        ]);

        // return redirect()->route('projects.image', $content);
    }
    
    public function satelliteImagesSingleUpluad(Request $request)
    {
        $file_upload_green = $request->file('green');
        $file_upload_green_name = $file_upload_green->getClientOriginalName();

        $file_upload_nir = $request->file('nir');
        $file_upload_nir_name = $file_upload_nir->getClientOriginalName();

        $storage_helper = new StorageHelper();
        $file_upload_green_path = $storage_helper->uploadSatelliteImage($file_upload_green);
        $file_upload_nir_path = $storage_helper->uploadSatelliteImage($file_upload_nir);

        $satellite_image = SatelliteImage::find($request['id']);

        ChannelEmission::create([
            'satellite_image_id' => $satellite_image->id,
            'channel_number' => 'Green',
            'filename' => $file_upload_green_name,
            'path' => $file_upload_green_path
        ]);

        ChannelEmission::create([
            'satellite_image_id' => $satellite_image->id,
            'channel_number' => 'NIR',
            'filename' => $file_upload_nir_name,
            'path' => $file_upload_nir_path
        ]);

        // return redirect()->route('projects.image', $content);
    }
}
