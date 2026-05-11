@extends('layouts.app')

@section('title', 'Danh Mục Sản Phẩm')

@section('content')

        <div class="page-header" data-aos="fade-in">
            <h1>Tất Cả Sản Phẩm</h1>
            <p>Tuyển tập những loại muối tinh khiết nhất</p>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; display: flex; gap: 40px;">
            <aside class="sidebar" style="width: 250px;" data-aos="fade-right">
                <h3>Danh mục</h3>
                <ul style="margin-top: 16px; display: flex; flex-direction: column; gap: 12px; color: var(--text-muted);">
                    <li><a href="#">Muối Hồng Himalaya</a></li>
                    <li><a href="#">Muối Biển Tinh Khiết</a></li>
                    <li><a href="#">Muối Gia Vị</a></li>
                </ul>
            </aside>
            <div style="flex: 1;">
                <div class="grid-4" id="all-products" data-aos="fade-up"></div>
            </div>
        </section>
        
@endsection

@push('scripts')
<script>renderProducts('all-products');</script>
@endpush
