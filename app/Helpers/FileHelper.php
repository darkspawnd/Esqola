<?php

namespace App\Helpers\FileHelper;

use League\Flysystem\FileSystem as FileSystem;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile as UploadFile;

class FileHelper {

    public static function upload(UploadFile $file)
    {
        $baseURI = date('Y');
        $baseURI .= '/' . date('m');
        $baseURI .= '/' . date('d-m-Y-his') . '.' .  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        Storage::put($baseURI,file_get_contents($file));
        return url("/") . Storage::url($baseURI);
    }

}