@extends('layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')

    <div class="page-header" data-aos="fade-in">
        <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:12px;font-weight:500;position:relative;">Giỏ Hàng</p>
        <h1>Giỏ Hàng Của Bạn</h1>
    </div>

    <section class="container" style="padding-top:48px;padding-bottom:100px;">
        <div id="cart-container" data-aos="fade-up">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="padding:16px 0;">Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cart-items"></tbody>
            </table>
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-top:48px;border-top:1px solid var(--border);padding-top:40px;flex-wrap:wrap;gap:24px;">
                <a href="{{ route('danh-muc') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                </a>
                <div style="width:340px;max-width:100%;">
                    <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-md);padding:28px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:20px;font-size:14px;color:var(--text-muted);">
                            <span>Tạm tính</span>
                            <span id="cart-total" style="color:var(--text-primary);font-weight:600;">0đ</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:24px;font-size:14px;color:var(--text-muted);">
                            <span>Vận chuyển</span>
                            <span style="color:var(--accent);font-weight:500;">Miễn phí</span>
                        </div>
                        <div style="height:1px;background:var(--border);margin-bottom:20px;"></div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:28px;">
                            <span style="font-size:16px;font-weight:600;">Tổng cộng</span>
                            <span id="cart-total-final" style="font-size:22px;font-weight:700;color:var(--accent);"></span>
                        </div>
                        <a href="{{ route('thanh-toan') }}" class="btn btn-primary" style="width:100%;text-align:center;">Thanh Toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    renderCartPage();
    // Sync total to final
    const syncTotal = () => {
        const t = document.getElementById('cart-total');
        const f = document.getElementById('cart-total-final');
        if(t && f) f.innerText = t.innerText;
    };
    syncTotal();
    const obs = new MutationObserver(syncTotal);
    const target = document.getElementById('cart-total');
    if(target) obs.observe(target, {childList:true, characterData:true, subtree:true});
</script>
@endpush
