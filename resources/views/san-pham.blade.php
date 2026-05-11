@extends('layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')

        <section class="container product-detail-section" style="padding-top: 60px; padding-bottom: 80px; display: flex; gap: 64px;">
            <div class="product-gallery" style="flex: 1;" data-aos="fade-right">
                <img id="detail-img" src="" alt="Product" style="width: 100%; height: 600px; object-fit: cover;">
            </div>
            <div class="product-info" style="flex: 1; padding-top: 32px;" data-aos="fade-left">
                <h1 id="detail-title" style="font-size: 40px; margin-bottom: 16px;">Loading...</h1>
                <p id="detail-price" style="font-size: 24px; color: var(--accent); font-weight: 600; margin-bottom: 24px;"></p>
                <p id="detail-desc" style="color: var(--text-muted); margin-bottom: 32px; font-size: 16px; line-height: 1.8;"></p>
                <div style="display: flex; gap: 16px; margin-bottom: 32px; align-items: center;">
                    <input type="number" id="detail-qty" value="1" min="1" style="width: 80px; padding: 12px; border: 1px solid var(--border); text-align: center; font-size: 16px;">
                    <button class="btn btn-primary" id="btn-add-cart" style="flex: 1; padding: 14px;">Thêm Vào Giỏ</button>
                </div>
                <div style="border-top: 1px solid var(--border); padding-top: 24px;">
                    <p><strong>Danh mục:</strong> Muối Cao Cấp</p>
                </div>
            </div>
        </section>
        
@endsection

@push('scripts')
<script>initProductDetail();</script>
@endpush
