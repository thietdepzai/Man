<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            
            return response()->json([
                'success' => true,
                'url' => asset('uploads/products/' . $filename)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy file ảnh'], 400);
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
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            
            // Cập nhật đường dẫn file vào cơ sở dữ liệu
            $imagePath = 'uploads/products/' . $filename;
            
            // Ví dụ lưu vào DB: 
            // $product->image = $imagePath;
            // $product->save();
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
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            
            // Cập nhật đường dẫn file vào cơ sở dữ liệu
            $imagePath = 'uploads/products/' . $filename;
            
            // Ví dụ lưu vào DB:
            // $product->image = $imagePath;
            // $product->save();
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
