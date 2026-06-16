<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|max:5120',
        ]);

        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;

        $file->move(public_path('uploads/posts'), $filename);

        return response()->json(['url' => '/uploads/posts/' . $filename]);
    }
}
