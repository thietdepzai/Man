<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        $path = public_path('uploads');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $files = File::files($path);
        $images = [];
        foreach ($files as $file) {
            $images[] = [
                'name' => $file->getFilename(),
                'url' => asset('uploads/' . $file->getFilename())
            ];
        }

        return response()->json($images);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);

            return response()->json([
                'success' => true,
                'name' => $name,
                'url' => asset('uploads/' . $name)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Upload thất bại'], 400);
    }

    public function destroy($filename)
    {
        $path = public_path('uploads/' . $filename);
        if (File::exists($path)) {
            File::delete($path);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy file'], 404);
    }
}
