@extends('layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')

    <section class="container" style="padding-top:60px;padding-bottom:120px;">
        <div style="display:flex;gap:80px;flex-wrap:wrap;">
            <div style="flex:1;min-width:400px;" data-aos="fade-right">
                <div style="border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--border);background:var(--bg-secondary);">
                    <img id="detail-img" src="" alt="Product" style="width:100%;height:600px;object-fit:cover;transition:transform 0.6s var(--ease-out);" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
            <div style="flex:1;min-width:360px;padding-top:20px;" data-aos="fade-left">
                <p style="font-size:12px;text-transform:uppercase;letter-spacing:3px;color:var(--accent);margin-bottom:16px;font-weight:500;">Muối Cao Cấp</p>
                <h1 id="detail-title" style="font-size:clamp(32px,4vw,44px);margin-bottom:20px;letter-spacing:-1px;line-height:1.15;">Loading...</h1>
                <p id="detail-price" style="font-size:28px;color:var(--accent);font-weight:600;margin-bottom:28px;"></p>

                <div style="width:100%;height:1px;background:var(--border);margin-bottom:28px;"></div>

                <p id="detail-desc" style="color:var(--text-secondary);margin-bottom:40px;font-size:15px;line-height:1.9;"></p>

                <div style="display:flex;gap:16px;margin-bottom:40px;align-items:center;">
                    <input type="number" id="detail-qty" value="1" min="1" style="width:80px;padding:14px;border:1px solid var(--border);text-align:center;font-size:16px;background:var(--bg-secondary);color:var(--text-primary);border-radius:var(--radius-sm);outline:none;">
                    <button class="btn btn-primary" id="btn-add-cart" style="flex:1;">
                        <i class="fas fa-shopping-bag"></i> Thêm Vào Giỏ
                    </button>
                </div>

                <div style="border-top:1px solid var(--border);padding-top:24px;display:flex;flex-direction:column;gap:12px;">
                    <div style="display:flex;align-items:center;gap:12px;color:var(--text-muted);font-size:13px;">
                        <i class="fas fa-truck" style="color:var(--accent);width:20px;"></i> Miễn phí vận chuyển đơn từ 300.000đ
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;color:var(--text-muted);font-size:13px;">
                        <i class="fas fa-undo" style="color:var(--accent);width:20px;"></i> Đổi trả trong 7 ngày
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;color:var(--text-muted);font-size:13px;">
                        <i class="fas fa-shield-alt" style="color:var(--accent);width:20px;"></i> Cam kết chính hãng 100%
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>initProductDetail();</script>
@endpush
