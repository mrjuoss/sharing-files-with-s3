<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request, File $file)
    {
       $requestFile = $request->file('file');
       $extensionFile = $requestFile->getClientOriginalExtension();
       $fileName = time().'.'.$extensionFile;

       // dd($fileName);
       // Upload file to S3
        Storage::disk('s3')->put($fileName, fopen($requestFile, 'r+'), 'public');

        // Save fileName to database
        $file->file_name = $fileName;
        $file->views = 0;
        $file->downloads = 0;
        $file->save();

        return redirect()->route('files', [$file->id]);
    }

    public function files(File $file)
    {
        dd($file);
    }
}
