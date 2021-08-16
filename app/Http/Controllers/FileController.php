<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
       $requestFile = $request->file('file');
       $extensionFile = $requestFile->getClientOriginalExtension();
       $fileName = time().'.'.$extensionFile;

       // dd($fileName);

        Storage::disk('s3')->put($fileName, fopen($requestFile, 'r+'), 'public');
    }
}
