<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // Validasi file yang diterima
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // max 2MB
        ]);

        // Simpan file ke storage/app/public/uploads
        $path = $request->file('image')->store('uploads', 'public');

        // Buat URL akses publik
        $url = Storage::url($path); // Hasil: /storage/uploads/namafile.jpg

        return response()->json([
            'url' => asset($url),
        ]);
    }
}
