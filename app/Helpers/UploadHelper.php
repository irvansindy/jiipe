<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadHelper
{
    public static function upload($file, $folder)
    {
        $path = $file->store($folder, 'uploads');
        return asset('uploads/' . $path);
    }
}
