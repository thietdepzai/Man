@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')

    <!-- Hero Section -->
    <section class="hero swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background: url('{{ asset('images/hero-salt.png') }}') center/cover;">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div data-aos="fade-up" data-aos-duration="1200">
                        <p style="font-size:13px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:16px;font-weight:500;">Bộ Sưu Tập 2026</p>
                        <h1 class="hero-title">Essential Earthiness</h1>
                        <p class="hero-subtitle">Khám phá hương vị nguyên bản của muối biển thủ công cao cấp — tinh khiết từ thiên nhiên Việt Nam.</p>
                        <a href="{{ route('danh-muc') }}" class="btn btn-primary">Khám Phá Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="container" style="padding-top:120px;padding-bottom:120px;">
        <div style="text-align:center;margin-bottom:64px;" data-aos="fade-up">
            <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:12px;font-weight:500;">Được Yêu Thích</p>
            <h2 style="font-size:clamp(32px,5vw,48px);letter-spacing:-1px;">Sản Phẩm Nổi Bật</h2>
            <div style="width:60px;height:2px;background:var(--accent);margin:20px auto 0;border-radius:2px;"></div>
        </div>
        <div class="grid-4" id="featured-products" data-aos="fade-up" data-aos-delay="200"></div>
        <div style="text-align:center;margin-top:64px;" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('danh-muc') }}" class="btn btn-outline">Xem Tất Cả Sản Phẩm</a>
        </div>
    </section>

    <!-- Story Banner -->
    <section style="background:var(--bg-secondary);padding:100px 0;border-top:1px solid var(--border);border-bottom:1px solid var(--border);" data-aos="fade-up">
        <div class="container" style="display:flex;align-items:center;gap:80px;flex-wrap:wrap;">
            <div style="flex:1;min-width:300px;">
                <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:16px;font-weight:500;">Câu Chuyện</p>
                <h2 style="font-size:clamp(28px,4vw,42px);margin-bottom:24px;letter-spacing:-1px;line-height:1.2;">Tinh Hoa Từ<br>Biển Cả Việt Nam</h2>
                <p style="color:var(--text-secondary);line-height:1.9;margin-bottom:32px;">Mỗi hạt muối Mặn là kết tinh của nắng gió, sóng biển và bàn tay khéo léo của những người thợ thủ công lâu đời. Chúng tôi cam kết mang đến hương vị tinh khiết nhất.</p>
                <a href="#" class="btn btn-outline btn-sm">Tìm Hiểu Thêm</a>
            </div>
            <div style="flex:1;min-width:300px;height:400px;border-radius:var(--radius-lg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                <img src="https://images.unsplash.com/photo-1615486511484-90f772ba00bb?auto=format&fit=crop&q=80&w=800" alt="Sea Salt Artisan" style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;z-index:1;">
                <div style="position:relative;z-index:2;background:rgba(18, 18, 18, 0.4);border-radius:50%;width:120px;height:120px;display:flex;flex-direction:column;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
                    <i class="fas fa-water" style="font-size:32px;margin-bottom:8px;color:#fff;opacity:0.9;"></i>
                    <p style="font-size:10px;text-transform:uppercase;letter-spacing:2px;color:#fff;margin:0;text-align:center;">Artisan</p>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>initHome();</script>
@endpush
