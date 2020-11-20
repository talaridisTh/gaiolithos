<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MediaController extends Controller {

    //
    public function upload(Request $request)
    {
        $model = $request->model;
        $month = now()->month;
        $media = new MediaUploader();

        $media->fromSource($request)
            ->toDirectory("$model/$month")
            ->isType("cover")
            ->onDuplicateUpdate()
            ->upload();
    }

    public function uploadModel(Request $request)
    {

        $media = Media::whereId($request->imageId)->first();
        auth()->user()->syncMedia($media, 'thump');

        return response()->json(auth()->user()->getMedia('thump')->first());
    }

    public function searchMedia(Request $request)
    {

        return view("components.uploader", [
            'media' => Media::where("filename", 'like', '%' . $request->searchTerm . '%')->where("variant_name", "thump")->paginate(10)
        ]);
    }

}
