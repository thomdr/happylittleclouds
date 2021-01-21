<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exhibition;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function browse()
    {
        return view('browse', [
            'images' => Storage::files('uploads/ckeditor')
        ]);
    }

    /**
     * Upload an image
     *
     * @param Request $request
     * @return string
     */
    public function upload(Request $request):string
    {
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('uploads/ckeditor');
            return json_encode([
                'uploaded' => 1,
                'fileName' => substr($path, 16),
                'url' => asset($path)
            ]);
        } else {
            return json_encode([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Internal server error.'
                ]
            ]);
        }
    }

    /**
     * Delete an image
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Storage::delete(request()->image);
        return redirect()->route('ckeditor.browse', [
            'CKEditor' => request()->CKEditor,
            'CKEditorFuncNum' => request()->CKEditorFuncNum,
            'langCode' => request()->langCode
        ]);
    }
}
