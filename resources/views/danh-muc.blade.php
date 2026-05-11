@extends('layouts.app')

@section('title', 'Bộ Sưu Tập Sản Phẩm')

@section('content')
    <header class="page-header">
        <div class="container">
            <span style="color: var(--accent); text-transform: uppercase; letter-spacing: 3px; font-size: 12px; font-weight: 700;">Tất Cả Sản Phẩm</span>
            <h1>The Salt Collection</h1>
            <p style="color: var(--on-surface-muted); margin-top: 20px; font-weight: 300; letter-spacing: 1px;">Khám phá tinh hoa gia vị từ khắp nơi trên thế giới, được chắt lọc và chế biến thủ công.</p>
        </div>
    </header>

    <section class="container section" style="display: grid; grid-template-columns: 280px 1fr; gap: 60px;">
        <aside class="sidebar">
            <div class="sidebar-section" style="margin-bottom: 40px;">
                <h3 style="font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 2px; margin-bottom: 20px; border-bottom: 1px solid var(--glass-border); padding-bottom: 10px;">Lọc theo loại</h3>
                <ul style="display: flex; flex-direction: column; gap: 15px;">
                    <li><a href="#" style="font-size: 14px; opacity: 0.6;">Tất cả sản phẩm</a></li>
                    <li><a href="#" style="font-size: 14px; opacity: 0.6;">Muối đặc sản</a></li>
                    <li><a href="#" style="font-size: 14px; opacity: 0.6;">Gia vị thảo mộc</a></li>
                    <li><a href="#" style="font-size: 14px; opacity: 0.6;">Quà tặng & Bộ sưu tập</a></li>
                </ul>
            </div>
            
            <div class="sidebar-section">
                <h3 style="font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 2px; margin-bottom: 20px; border-bottom: 1px solid var(--glass-border); padding-bottom: 10px;">Ưu đãi</h3>
                <div class="promo-card glass" style="padding: 20px; border-radius: 4px;">
                    <p style="font-size: 12px; color: var(--accent); font-weight: 700; text-transform: uppercase; margin-bottom: 10px;">Mùa hè rực rỡ</p>
                    <h4 style="font-size: 18px; margin-bottom: 10px;">Giảm 20% cho đơn hàng đầu tiên</h4>
                    <p style="font-size: 13px; opacity: 0.6; margin-bottom: 15px;">Nhập mã: MANSALT20</p>
                    <a href="#" class="btn btn-primary" style="padding: 10px 20px; font-size: 10px;">Lấy mã ngay</a>
                </div>
            </div>
        </aside>

        <div class="collection-main">
            <div class="collection-toolbar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
                <p style="font-size: 14px; opacity: 0.5;">Hiển thị 8 sản phẩm</p>
                <div class="sort-dropdown">
                    <select class="glass" style="padding: 8px 15px; border: 1px solid var(--glass-border); color: white; background: transparent; outline: none; font-family: var(--font-body); font-size: 13px;">
                        <option>Mới nhất</option>
                        <option>Giá: Thấp đến Cao</option>
                        <option>Giá: Cao đến Thấp</option>
                        <option>Phổ biến nhất</option>
                    </select>
                </div>
            </div>
            <div class="grid-4" id="all-products">
                <!-- Rendered by JS -->
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        renderProducts('all-products');
    });
</script>
@endpush
