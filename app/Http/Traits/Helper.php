<?php

namespace App\Http\Traits;
use Carbon\Carbon;

trait Helper
{
    private $sizes = ['min', 'medium'];

    public function modifyDateFormat($data, $names, $format = 'Y-m-d') {
        foreach($names as $name) {
            if(isset($data[$name]) && $data[$name]) {
                $data[$name] = Carbon::parse($data[$name])->format($format);
            }
        }
        return $data;
    }

    public function deleteFile($path, $fileName) {
        $this->unlinkImg($path.$fileName);
        foreach($this->sizes as $size) {
            $this->unlinkImg($path.$size.'_'.$fileName);
        }
    }

    private function unlinkImg($path) {
        if(file_exists($path)) {
            unlink($path);
        }
        return true;
    }
}