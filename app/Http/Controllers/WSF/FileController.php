<?php

namespace App\Http\Controllers\WSF;

use App\Http\Controllers\Controller;
use App\Models\WSF\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
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

        return redirect()->route('file.sharing.files', [$file->id]);
    }

    public function files(File $file)
    {
        // dd($file);
        $file->incrementView();

        $file["path"] = env("AWS_ENDPOINT")."/".env("AWS_BUCKET");

        return view('wsf.files')->with(['file' => $file]);
    }

    public function downloadFile(File $file)
    {
        $headers = ['Content-Disposition' => 'attachment; filename="'.$file->file_name.'"'];

        if(!session()->exists("_$file->file_name"))
        {
            $file->incrementDownload();
            Session::put("_$file->file_name", true);
        }

        return Response::make(Storage::disk('s3')->get($file->file_name), 200, $headers);
    }

    public function deleteFile(File $file)
    {
        // Remove File from Cloud Storage S3
        Storage::disk('s3')->delete($file, $file->file_name);
        // Delete record from database
        $file->delete();

        return redirect()->route("file.sharing.home")->with(["message" => "Berhasil menghapus data"]);
    }
}
