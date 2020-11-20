<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory,HasMedia;

    private $imagePath = "storage";

    protected $fillable = [
        "path",
        "filename",
        "slug_name",
        "ext",
        "mime_type",
        "size",
    ];

    public function getPathAttribute($path)
    {


        return "$this->imagePath/$path/";


    }


}
