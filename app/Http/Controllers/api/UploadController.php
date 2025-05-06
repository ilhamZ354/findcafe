<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $path = $request->file('image')->store('uploads', 'public');
            $url = Storage::url($path);

            return response()->json([
                'url' => asset($url),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->validator->errors()->first(), // ambil 1 pesan error saja
            ], 422);
        }
    }
}
