<?php

namespace App\Helpers\FileHelper;

use League\Flysystem\FileSystem as FileSystem;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile as UploadFile;

class FileHelper {

    private static function getBasePath() {
        return url("/") . '/uploaded/';
    }

    public static function upload(UploadFile $file)
    {
        $baseURI = date('Y');
        $baseURI .= '/' . date('m');
        $baseURI .= '/' . date('d-m-Y-his') . '.' .  pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        Storage::put($baseURI,file_get_contents($file));
        return  self::getBasePath() . $baseURI;
    }

    public static function remove($filepath)
    {
        $baseURI = $filepath;
        $filearr = explode('/', $filepath);
        $filename = $filearr[count($filearr) -  3]. '/' .$filearr[count($filearr) -  2]. '/' .$filearr[count($filearr) -  1];
        return Storage::delete($filename);
    }
}