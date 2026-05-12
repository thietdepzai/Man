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
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/products');

                // Kiểm tra và tạo thư mục nếu chưa tồn tại, cấp quyền 0775
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true, true);
                }

                $file->move($destinationPath, $filename);
                
                return response()->json([
                    'success' => true,
                    'url' => asset('uploads/products/' . $filename)
                ]);
            } catch (\Exception $e) {
                Log::error('Lỗi upload ảnh: ' . $e->getMessage());
                return response()->json([
                    'success' => false, 
                    'message' => 'Lỗi lưu file: ' . $e->getMessage()
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
                $destinationPath = public_path('uploads/products');

                // Tự động tạo thư mục nếu chưa có
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true, true);
                }

                $file->move($destinationPath, $filename);
                
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

        // Xử lý upload ảnh khi update
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/products');

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true, true);
                }

                $file->move($destinationPath, $filename);
                
                $imagePath = 'uploads/products/' . $filename;
                
                // $product->image = $imagePath;
                // $product->save();
            } catch (\Exception $e) {
                Log::error('Lỗi update ảnh: ' . $e->getMessage());
            }
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
