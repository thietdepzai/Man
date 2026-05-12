<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Upload ảnh - ưu tiên imgBB, fallback lưu local
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if (!$request->hasFile('image')) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy file ảnh'], 400);
        }

        $image = $request->file('image');
        $apiKey = env('IMGBB_API_KEY');

        // --- Nếu có imgBB API key → upload lên cloud ---
        if ($apiKey) {
            try {
                $base64Image = base64_encode(file_get_contents($image->getRealPath()));

                $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
                    'key'   => $apiKey,
                    'image' => $base64Image,
                    'name'  => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME),
                ]);

                $result = $response->json();

                if ($response->successful() && isset($result['data']['url'])) {
                    return response()->json([
                        'success' => true,
                        'name'    => $result['data']['title'] ?? $image->getClientOriginalName(),
                        'url'     => $result['data']['display_url'],
                    ]);
                }
            } catch (\Exception $e) {
                // imgBB fail → fallback xuống local
            }
        }

        // --- Fallback: Lưu ảnh vào local storage ---
        try {
            $filename = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME))
                        . '.' . $image->getClientOriginalExtension();

            // Tạo thư mục uploads nếu chưa có
            $uploadPath = public_path('uploads');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Di chuyển file vào public/uploads
            $image->move($uploadPath, $filename);

            $url = asset('uploads/' . $filename);

            return response()->json([
                'success' => true,
                'name'    => $image->getClientOriginalName(),
                'url'     => $url,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi lưu ảnh: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Liệt kê ảnh đã upload (giữ lại cho tương thích)
     */
    public function index()
    {
        return response()->json([]);
    }

    /**
     * Xóa ảnh
     */
    public function destroy($filename)
    {
        $path = public_path('uploads/' . $filename);
        if (File::exists($path)) {
            File::delete($path);
            return response()->json(['success' => true, 'message' => 'Đã xóa ảnh']);
        }
        return response()->json(['success' => true, 'message' => 'Ảnh không tồn tại hoặc trên cloud']);
    }
}
