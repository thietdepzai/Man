<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $base64Image = base64_encode(file_get_contents($image->getRealPath()));

                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => 'Client-ID 2955f110c73299b',
                ])->asForm()->post('https://api.imgur.com/3/image', [
                    'image' => $base64Image,
                ]);

                $result = $response->json();

                if ($response->successful() && isset($result['data']['link'])) {
                    return response()->json([
                        'success' => true,
                        'url' => $result['data']['link']
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi từ Imgur: ' . ($result['data']['error'] ?? 'Không xác định')
                ], 500);

            } catch (\Exception $e) {
                Log::error('Lỗi upload ảnh Imgur: ' . $e->getMessage());
                return response()->json([
                    'success' => false, 
                    'message' => 'Lỗi kết nối Imgur: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy file ảnh đính kèm'], 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ... (Logic validate và lưu các trường khác vào database) ...

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $filename);
                
                // Cập nhật đường dẫn file vào cơ sở dữ liệu
                $imagePath = 'uploads/products/' . $filename;
                
                // $product->image = $imagePath;
                // $product->save();
            } catch (\Exception $e) {
                Log::error('Lỗi store ảnh: ' . $e->getMessage());
            }
        }

        // ...
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ... (Logic validate và lưu các trường khác vào database) ...

        // Xử lý upload ảnh hoặc nhận link ảnh trực tiếp
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $filename);
                
                $imagePath = 'uploads/products/' . $filename;
                
                // $product->image = $imagePath;
                // $product->save();
            } catch (\Exception $e) {
                Log::error('Lỗi update ảnh: ' . $e->getMessage());
            }
        } elseif ($request->filled('image_url')) {
            // Nhận trực tiếp URL ảnh từ Imgur
            $imagePath = $request->input('image_url');
            // $product->image = $imagePath;
        }

        // ...
    }
        // ... (Logic validate và lưu các trường khác vào database) ...

        // Xử lý upload ảnh hoặc nhận link ảnh trực tiếp
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $filename);
                
                $imagePath = 'uploads/products/' . $filename;
                
                // $product->image = $imagePath;
                // $product->save();
            } catch (\Exception $e) {
                Log::error('Lỗi store ảnh: ' . $e->getMessage());
            }
        } elseif ($request->filled('image_url')) {
            // Nhận trực tiếp URL ảnh từ máy khách (ví dụ: imgur URL)
            $imagePath = $request->input('image_url');
            // $product->image = $imagePath;
        }

        // ...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
