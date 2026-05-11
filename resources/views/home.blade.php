@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
    <!-- Hero Slider -->
    <section class="hero swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="hero-overlay"></div>
                <img src="https://images.unsplash.com/photo-1518110924446-24e5d8dce288?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Muối Hồng" style="width:100%; height:100%; object-fit:cover;">
                <div class="hero-content">
                    <h1 class="hero-title">Essential<br>Earthiness</h1>
                    <p class="hero-subtitle">Khám phá hương vị nguyên bản của muối biển thủ công cao cấp được chắt lọc từ những tinh hoa của đại dương.</p>
                    <div class="hero-btns" style="display: flex; gap: 20px;">
                        <a href="{{ route('danh-muc') }}" class="btn btn-primary">Khám Phá Bộ Sưu Tập</a>
                        <a href="#" class="btn btn-outline">Về Mặn Salt</a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="hero-overlay"></div>
                <img src="https://images.unsplash.com/photo-1621252178044-f254ee4bc710?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Muối Truffle" style="width:100%; height:100%; object-fit:cover;">
                <div class="hero-content">
                    <h1 class="hero-title">The Art of<br>Seasoning</h1>
                    <p class="hero-subtitle">Nâng tầm mọi món ăn với bộ gia vị thảo mộc cao cấp, được tuyển chọn từ những vùng nguyên liệu trứ danh.</p>
                    <div class="hero-btns" style="display: flex; gap: 20px;">
                        <a href="{{ route('danh-muc') }}" class="btn btn-primary">Mua Ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination" style="bottom: 40px !important;"></div>
    </section>

    <!-- Featured Products -->
    <section class="section container">
        <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
        <div class="grid-4" id="featured-products">
            <!-- Rendered by JS -->
        </div>
        <div style="text-align: center; margin-top: 60px;">
            <a href="{{ route('danh-muc') }}" class="btn btn-outline" style="color: white; border-color: rgba(255,255,255,0.2);">Xem Tất Cả Sản Phẩm</a>
        </div>
    </section>

    <!-- Brand Story Section -->
    <section class="section" style="background: var(--surface-bright);">
        <div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
            <div class="story-img" style="position: relative;">
                <img src="https://images.unsplash.com/photo-1596647248356-0798e945c115?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Mặn Salt Story" style="border-radius: 4px;">
                <div style="position: absolute; bottom: -30px; right: -30px; width: 200px; height: 200px; background: var(--accent); z-index: -1; border-radius: 4px; opacity: 0.2;"></div>
            </div>
            <div class="story-content">
                <span style="color: var(--accent); text-transform: uppercase; letter-spacing: 3px; font-size: 12px; font-weight: 700;">Câu Chuyện Thương Hiệu</span>
                <h2 style="font-size: 48px; margin: 20px 0 30px;">Từ Đại Dương Đến<br>Gian Bếp Hiện Đại</h2>
                <p style="font-size: 18px; color: var(--on-surface-muted); margin-bottom: 30px; font-weight: 300;">Mặn Salt ra đời với sứ mệnh gìn giữ và nâng tầm giá trị của muối biển truyền thống. Chúng tôi tin rằng muối không chỉ là gia vị, mà là linh hồn của món ăn, là kết tinh của nắng, gió và bàn tay tài hoa của con người.</p>
                <a href="#" class="btn btn-outline">Tìm Hiểu Thêm</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section container">
        <div class="grid-4" style="text-align: center;">
            <div class="feature-item">
                <i class="fas fa-leaf" style="font-size: 32px; color: var(--accent); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 15px; font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 2px;">100% Tự Nhiên</h3>
                <p style="font-size: 14px; color: var(--on-surface-muted);">Không chứa chất bảo quản và phụ gia độc hại.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-hand-holding-heart" style="font-size: 32px; color: var(--accent); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 15px; font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 2px;">Thủ Công</h3>
                <p style="font-size: 14px; color: var(--on-surface-muted);">Quy trình chế biến tỉ mỉ, giữ nguyên hương vị.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-truck" style="font-size: 32px; color: var(--accent); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 15px; font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 2px;">Giao Hàng Nhanh</h3>
                <p style="font-size: 14px; color: var(--on-surface-muted);">Đảm bảo sản phẩm đến tay bạn trong trạng thái tốt nhất.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-shield-alt" style="font-size: 32px; color: var(--accent); margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 15px; font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 2px;">Chất Lượng</h3>
                <p style="font-size: 14px; color: var(--on-surface-muted);">Cam kết chất lượng chuẩn quốc tế.</p>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="section" style="background: radial-gradient(circle at center, #2a2a2a 0%, #000000 100%);">
        <div class="container" style="max-width: 800px; text-align: center;">
            <h2 style="font-size: 48px; margin-bottom: 20px;">Stay Salty.</h2>
            <p style="color: var(--on-surface-muted); margin-bottom: 40px;">Đăng ký nhận bản tin để cập nhật những công thức nấu ăn mới nhất và ưu đãi độc quyền.</p>
            <form style="display: flex; gap: 10px;" onsubmit="event.preventDefault(); Swal.fire('Thành công', 'Cảm ơn bạn đã đăng ký!', 'success');">
                <input type="email" class="form-input" placeholder="Nhập email của bạn..." required>
                <button type="submit" class="btn btn-primary">Đăng Ký</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initHome();
    });
</script>
@endpush
