<?php

namespace App\Helpers\FileHelper;

use League\Flysystem\FileSystem as FileSystem;
use Illuminate\Support\Facades\Storage;

class FileHelper {

    public static function hello($file)
    {
        Storage::put(getClientOriginalName($file, $file->getClientOriginalName()));
    }

}