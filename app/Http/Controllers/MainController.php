<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function switch(Request  $request)
    {

        $nameSpace = "App\Models\\".ucfirst($request->model);
        $modelClass= new $nameSpace ;

        $model = $modelClass->findOrFail($request->id);
        $model->status==1?$model->status=0:$model->status=1;
        $model->save();

        return response()->json($model->status);

    }

    public function delete($data ,Request $request)
    {
        $nameSpace = "App\Models\\".ucfirst($request->model);
        $modelClass= new $nameSpace ;

        $modelClass->findOrFail($request->id)->delete();

    }

}
