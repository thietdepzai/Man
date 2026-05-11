@extends('layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
    <section class="container" style="padding-top: 180px; padding-bottom: 120px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: start;">
            <!-- Product Gallery -->
            <div class="product-gallery" style="position: sticky; top: 120px;">
                <div class="glass" style="padding: 10px; border-radius: 4px;">
                    <img id="detail-img" src="" alt="Product" style="width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 2px;">
                </div>
                <div class="gallery-thumbs" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-top: 20px;">
                    <div class="glass" style="aspect-ratio: 1/1; opacity: 0.5; cursor: pointer;"><img src="" class="thumb-img" style="width:100%; height:100%; object-fit:cover;"></div>
                    <div class="glass" style="aspect-ratio: 1/1; opacity: 0.5; cursor: pointer;"><img src="" class="thumb-img" style="width:100%; height:100%; object-fit:cover;"></div>
                    <div class="glass" style="aspect-ratio: 1/1; opacity: 0.5; cursor: pointer;"><img src="" class="thumb-img" style="width:100%; height:100%; object-fit:cover;"></div>
                    <div class="glass" style="aspect-ratio: 1/1; opacity: 0.5; cursor: pointer;"><img src="" class="thumb-img" style="width:100%; height:100%; object-fit:cover;"></div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <nav style="margin-bottom: 20px; font-size: 12px; opacity: 0.4; text-transform: uppercase; letter-spacing: 2px;">
                    <a href="{{ route('home') }}">Home</a> / <a href="{{ route('danh-muc') }}">Collection</a> / <span id="breadcrumb-title">Product</span>
                </nav>
                
                <h1 id="detail-title" style="font-size: 64px; margin-bottom: 20px; line-height: 1.1;">Loading...</h1>
                <p id="detail-price" style="font-size: 28px; color: var(--accent); font-weight: 600; margin-bottom: 30px;"></p>
                
                <div class="product-description" style="border-top: 1px solid var(--glass-border); padding-top: 30px; margin-bottom: 40px;">
                    <h3 style="font-family: var(--font-body); text-transform: uppercase; font-size: 13px; letter-spacing: 2px; margin-bottom: 15px; color: var(--on-surface-muted);">Thông tin sản phẩm</h3>
                    <p id="detail-desc" style="color: var(--on-surface-muted); font-size: 16px; line-height: 1.8; font-weight: 300;"></p>
                </div>

                <div class="product-actions" style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div class="qty-selector glass" style="display: flex; align-items: center; padding: 5px 15px; border-radius: 4px;">
                            <button onclick="document.getElementById('detail-qty').stepDown()" style="background:none; border:none; color:white; padding:10px; cursor:pointer;">-</button>
                            <input type="number" id="detail-qty" value="1" min="1" style="width: 40px; background:none; border:none; color:white; text-align:center; font-family:var(--font-body); font-weight:600; outline:none;">
                            <button onclick="document.getElementById('detail-qty').stepUp()" style="background:none; border:none; color:white; padding:10px; cursor:pointer;">+</button>
                        </div>
                        <button class="btn btn-primary" id="btn-add-cart" style="flex: 1;">Thêm Vào Giỏ Hàng</button>
                    </div>
                    <button class="btn btn-outline" style="width: 100%;">Mua Ngay</button>
                </div>

                <div class="product-meta" style="margin-top: 50px; border-top: 1px solid var(--glass-border); padding-top: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <h4 style="font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Khối lượng</h4>
                        <p style="font-size: 14px;">250g / 500g</p>
                    </div>
                    <div>
                        <h4 style="font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Hạn sử dụng</h4>
                        <p style="font-size: 14px;">24 tháng</p>
                    </div>
                    <div>
                        <h4 style="font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Mã sản phẩm</h4>
                        <p style="font-size: 14px;">MS-00{{ request()->get('id') }}</p>
                    </div>
                    <div>
                        <h4 style="font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Vận chuyển</h4>
                        <p style="font-size: 14px;">Toàn quốc (2-4 ngày)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="section container" style="border-top: 1px solid var(--glass-border);">
        <h2 class="section-title">Bạn Có Thể Thích</h2>
        <div class="grid-4" id="related-products">
            <!-- Rendered by JS -->
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initProductDetail();
        renderProducts('related-products', 4);
    });
</script>
@endpush
