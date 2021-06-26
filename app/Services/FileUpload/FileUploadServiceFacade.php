<?php

namespace App\Services\FileUpload;

use Illuminate\Support\Facades\Facade;

class FileUploadServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FileUploadService';
    }
}