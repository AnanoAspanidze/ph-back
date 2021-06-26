<?php

namespace App\Services\FileUpload;

use Carbon\Carbon;
use Storage;
use Image;

class FileUploadService
{
    private $sizes = [
        'medium' => ['x' => 600, 'y' => 300 ],
        'min' => ['x' => 300, 'y' => 200 ]
    ];

    public function run($file, $path, $isImage = true, $resize = null)
    {
        try{
            $resize = $resize ?? $this->sizes;
            $path = 'public/'.$path;
            $filenameWithExtension = $file->getClientOriginalName(); 
            $extension = $file->getClientOriginalExtension();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $filenametostore = str_replace(' ', '_',$filename).'_'.time().'.'.$extension;
            $file->storeAs($path, $filenametostore);
            if($isImage) {
                $this->saveImg($file, 'min_'.$filenametostore, $resize['min'], $path);
                $this->saveImg($file, 'medium_'.$filenametostore, $resize['medium'], $path);
            }
            return $filenametostore;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }

    private function saveImg($file, $fileName, $resize, $path) {
        $img = Image::make($file)->resize($resize['x'], $resize['y'], function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();
        Storage::put($path.'/'.$fileName, $img);
        return $fileName;
    }
}