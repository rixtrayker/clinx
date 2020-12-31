<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Request;
use DB;
use \Eventviva\ImageResize;
use Config;
use File;
use App\Libs\Misc;

class BaseModel extends Model
{
    public function makeSlug($text, $field, $object)
    {
        if (@$object->id) {
            $this->where("id", "!=", $object->id);
        }
        $count = $this->where($field, "=", $text)->count();
        if ($count > 1) {
            $slug = Misc::slug($text) . '-' . $count;
        } else {
            $slug = Misc::slug($text);
        }
        $object->slug = str_limit($slug, 50);
        $object->save();
    }

    public function uploadAndResize($field, $object, $imageSizes = [])
    {
        if (!$imageSizes) {
            $imageSizes = Config::get('settings.imageSizes');
        }
        $uploadPath = 'uploads/';
        if (Request::hasFile($field) && Request::file($field)->isValid()) {
            $image = Request::file($field);
            $fileName = str_random(10) . time() . '.' . $image->getClientOriginalExtension();
            Request::file($field)->move($uploadPath, $fileName);
            $filePath = $uploadPath . $fileName;
            if ($imageSizes) {
                foreach ($imageSizes as $key => $value) {
                    $value = explode(',', $value);
                    $type = $value[0];
                    $dimensions = explode('x', $value[1]);
                    if (!File::exists($uploadPath . $key)) {
                        mkdir($uploadPath . $key);
                    }
                    $thumbPath = $uploadPath . $key . '/' . $fileName;
                    $image = new ImageResize($filePath);
                    $image->quality_jpg = 90;
                    $image->quality_png = 9;
                    if ($type == 'resize') {
                        $type = 'resizeToBestFit';
                    }
                    $image->$type($dimensions[0], $dimensions[1]);
                    $image->save($thumbPath);
                }
                //@unlink($filePath);
            }
            if ($object->$field) {
                Misc::deleteImage($object->$field);
            }
            $object->$field = $fileName;
            $object->save();
        }
    }

    public function uploadAndResizeMultiple($file, $object, $field, $imageSizes = [])
    {
        if (!$imageSizes) {
            $imageSizes = Config::get('settings.imageSizes');
        }
        $uploadPath = 'uploads/';
        if ($file) {
            $fileName = str_random(10) . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
            $filePath = $uploadPath . $fileName;
            if ($imageSizes) {
                foreach ($imageSizes as $key => $value) {
                    $value = explode(',', $value);
                    $type = $value[0];
                    $dimensions = explode('x', $value[1]);
                    if (!File::exists($uploadPath . $key)) {
                        mkdir($uploadPath . $key);
                    }
                    $thumbPath = $uploadPath . $key . '/' . $fileName;
                    $image = new ImageResize($filePath);
                    $image->quality_jpg = 90;
                    if ($type == 'resize') {
                        $type = 'resizeToBestFit';
                    }
                    $image->$type($dimensions[0], $dimensions[1]);
                    $image->save($thumbPath);
                }
                @unlink($filePath);
            }
            if ($object->$field) {
                Misc::deleteImage($object->$field);
            }
            $object->$field = $fileName;
            $object->save();
        }
    }

    public function uploadFile($field, $object)
    {
        $uploadPath = 'uploads/';
        if (Request::hasFile($field) && Request::file($field)->isValid()) {
            $file = Request::file($field);
            $fileName = str_random(10) . time() . '.' . $file->getClientOriginalExtension();
            Request::file($field)->move($uploadPath, $fileName);
            $filePath = $uploadPath . $fileName;
            if ($object->$field) {
                Misc::deleteFile($object->$field);
            }
            $object->$field = $fileName;
            $object->save();
        }
    }

    public function scopePublished($query)
    {
        $query->where('published', '=', 1);
    }

    public function scopeUnpublished($query)
    {
        $query->where('published', '=', 0);
    }

//    public function getCreatedAtAttribute($date) {
//        return Carbon::parse($date)->format('d-m-Y H:i:s a');
//    }
    // public function getCreatedAtAttribute($date) {
    //     return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d g:i a');
    // }

    // public function getUpdatedAtAttribute($date) {
    //     return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d g:i a');
    // }
}
