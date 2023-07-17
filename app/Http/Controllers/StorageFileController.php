<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StorageFileController extends Controller{

    public function getPubliclyStorgeFile($filename)
    {
        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        $path = storage_path('storage/app/public/'. $filename);

        // if (!Storage::disk('s3')->exists($path)) {
        //     abort(404);
        // }

        // $file = Storage::get($path);
        // $type = Storage::mimeType($path);

        // $response = Response::make($file, 200);

        // $response->header("Content-Type", $type);

        // return $response;
        return Storage::url($filename);
        // echo asset($filename);

    }	

}
