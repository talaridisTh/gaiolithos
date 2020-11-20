<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Str;
use Validator;

class MediaUploader {

    //
    private $source;
    private $sourceImage;
    private $path;
    private $type;



    public function fromSource($source)
    {
        $this->source = $source;
        $this->sourceImage = $source["media-file"];

        return $this;
    }

    public function toDirectory($path)
    {
        $this->path = $path;

        return $this;
    }

    public function onDuplicateUpdate()
    {

        $media = Media::where('filename',$this->sourceImage->getClientOriginalName())->first();

        $media?$media->delete():$media;
        return $this;


    }

    public function isType($type = "image")
    {
        $this->type = $type;

        return $this;
    }

    public function upload()
    {

        $validImage = $this->validImage($this->source);

        $newMedia = Media::create([
            "path" => $this->path,
            "filename" => $this->sourceImage->getClientOriginalName(),
            "slug_name" => Str::slug(pathinfo($this->sourceImage->getClientOriginalName(), PATHINFO_FILENAME), '-'),
            "ext" => $this->sourceImage->getClientOriginalExtension(),
            "type" => $this->type,
            "mime_type" => $this->sourceImage->getClientMimeType(),
            "size" => $this->sourceImage->getSize()
        ]);


         $this->sourceImage->storeAs($this->path, $newMedia->slug_name, 'public');

         return $this;
    }

    private function validImage($source)
    {

        return $source->validate([
            'media-file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }



}
