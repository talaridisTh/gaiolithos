<?php


namespace App\Traits;

use App\Models\Media;

trait HasMedia {

    public function showImage(Media $media)
    {

        dd($media);

    }
}
