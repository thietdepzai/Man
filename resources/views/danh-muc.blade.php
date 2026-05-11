@extends('layouts.app')

@section('title', 'Bộ Sưu Tập')

@section('content')

    <div class="page-header" data-aos="fade-in">
        <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:12px;font-weight:500;position:relative;">Bộ Sưu Tập</p>
        <h1>Tất Cả Sản Phẩm</h1>
        <p style="margin-top:8px;">Tuyển tập những loại muối tinh khiết nhất</p>
    </div>

    <section class="container" style="padding-top:48px;padding-bottom:100px;display:flex;gap:48px;">
        <aside style="width:240px;flex-shrink:0;" data-aos="fade-right">
            <div style="position:sticky;top:100px;">
                <h3 style="font-size:14px;text-transform:uppercase;letter-spacing:2px;margin-bottom:24px;color:var(--text-primary);">Danh mục</h3>
                <ul style="display:flex;flex-direction:column;gap:4px;">
                    <li><a href="#" style="display:block;padding:12px 16px;border-radius:var(--radius-sm);color:var(--text-secondary);transition:all 0.2s;font-size:14px;" onmouseover="this.style.background='var(--bg-glass-hover)';this.style.color='var(--text-primary)'" onmouseout="this.style.background='';this.style.color='var(--text-secondary)'">Muối Hồng Himalaya</a></li>
                    <li><a href="#" style="display:block;padding:12px 16px;border-radius:var(--radius-sm);color:var(--text-secondary);transition:all 0.2s;font-size:14px;" onmouseover="this.style.background='var(--bg-glass-hover)';this.style.color='var(--text-primary)'" onmouseout="this.style.background='';this.style.color='var(--text-secondary)'">Muối Biển Tinh Khiết</a></li>
                    <li><a href="#" style="display:block;padding:12px 16px;border-radius:var(--radius-sm);color:var(--text-secondary);transition:all 0.2s;font-size:14px;" onmouseover="this.style.background='var(--bg-glass-hover)';this.style.color='var(--text-primary)'" onmouseout="this.style.background='';this.style.color='var(--text-secondary)'">Muối Gia Vị</a></li>
                </ul>
            </div>
        </aside>
        <div style="flex:1;">
            <div class="grid-4" id="all-products" data-aos="fade-up"></div>
        </div>
    </section>

@endsection

@push('scripts')
<script>renderProducts('all-products');</script>
@endpush
