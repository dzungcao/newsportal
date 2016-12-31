<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FileController extends Controller
{
    /*
    * Handle file upload from ckeditor
    */
    public function postUpload(Request $request)
    {
        $CKEditor = Input::get('CKEditor');
    $funcNum = Input::get('CKEditorFuncNum');
    $message = $url = '';
    if (Input::hasFile('upload')) {
        $file = Input::file('upload');
        if ($file->isValid()) {
            $filename = $file->getClientOriginalName();
            $file->move(public_path().'/'.config('app.upload_dir'), $filename);
            $url = public_path().'/'.config('app.upload_dir').'/'. $filename;
        } else {
            $message = 'An error occured while uploading the file.';
        }
    } else {
        $message = 'No file uploaded.';
    }
    return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
