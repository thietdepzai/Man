@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')

        <section class="hero swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background: url('{{ asset('images/hero-salt.png') }}') center/cover;">
                    <div class="hero-overlay"></div>
                    <div class="hero-content" data-aos="fade-up">
                        <h1 class="hero-title">Essential Earthiness</h1>
                        <p class="hero-subtitle">Khám phá hương vị nguyên bản của muối biển thủ công cao cấp.</p>
                        <a href="{{ route('danh-muc') }}" class="btn btn-primary">Khám Phá Ngay</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="container" style="padding-top: 80px; padding-bottom: 80px;">
            <h2 style="text-align: center; margin-bottom: 48px; font-size: 32px;" data-aos="fade-up">Sản Phẩm Nổi Bật</h2>
            <div class="grid-4" id="featured-products" data-aos="fade-up" data-aos-delay="200"></div>
        </section>
        
@endsection

@push('scripts')
<script>initHome();</script>
@endpush
