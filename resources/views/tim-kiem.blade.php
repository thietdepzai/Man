@extends('layouts.app')

@section('title', 'Tìm Kiếm')

@section('content')

    <div class="page-header" data-aos="fade-in">
        <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:12px;font-weight:500;position:relative;">Khám Phá</p>
        <h1>Tìm Kiếm Sản Phẩm</h1>
    </div>

    <section class="container" style="padding-top:48px;padding-bottom:100px;">
        <div style="max-width:600px;margin:0 auto 56px;position:relative;" data-aos="fade-up">
            <i class="fas fa-search" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:16px;"></i>
            <input type="text" id="search-input" placeholder="Nhập tên sản phẩm muối..." class="form-input" style="padding-left:52px;font-size:16px;border-radius:var(--radius-xl);background:var(--bg-secondary);">
        </div>
        <div class="grid-4" id="search-results" data-aos="fade-up" data-aos-delay="200"></div>
    </section>

@endsection

@push('scripts')
<script>initSearch();</script>
@endpush
