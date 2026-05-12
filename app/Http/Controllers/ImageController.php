<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Upload ảnh lên imgBB (cloud) - hoạt động trên Render
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if (!$request->hasFile('image')) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy file ảnh'], 400);
        }

        $apiKey = env('IMGBB_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Chưa cấu hình IMGBB_API_KEY trong file .env'
            ], 500);
        }

        try {
            $image = $request->file('image');
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

            return response()->json([
                'success' => false,
                'message' => $result['error']['message'] ?? 'Upload lên imgBB thất bại',
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi kết nối imgBB: ' . $e->getMessage(),
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
     * Xóa ảnh (không cần thiết khi dùng imgBB free)
     */
    public function destroy($filename)
    {
        return response()->json(['success' => true, 'message' => 'Ảnh trên cloud không thể xóa từ đây']);
    }
}
