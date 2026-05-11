@extends('layouts.app')

@section('title', 'Thanh Toán')

@section('content')

    <div class="page-header" data-aos="fade-in">
        <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:12px;font-weight:500;position:relative;">Checkout</p>
        <h1>Thanh Toán</h1>
    </div>

    <section class="container" style="padding-top:48px;padding-bottom:100px;">
        <div style="display:flex;gap:64px;flex-wrap:wrap;">
            <div style="flex:2;min-width:340px;" data-aos="fade-right">
                <h3 style="font-size:16px;text-transform:uppercase;letter-spacing:2px;margin-bottom:28px;font-weight:600;">Thông tin giao hàng</h3>
                <form id="checkout-form" style="display:flex;flex-direction:column;gap:20px;">
                    <div style="display:flex;gap:20px;">
                        <div style="flex:1;">
                            <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Họ và tên</label>
                            <input type="text" id="chk-name" placeholder="Nguyễn Văn A" required class="form-input">
                        </div>
                        <div style="flex:1;">
                            <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Số điện thoại</label>
                            <input type="text" id="chk-phone" placeholder="0912 345 678" required class="form-input">
                        </div>
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Email</label>
                        <input type="email" id="chk-email" placeholder="you@example.com" required class="form-input">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Địa chỉ giao hàng</label>
                        <input type="text" id="chk-address" placeholder="123 Đường ABC, Quận 1, TP.HCM" required class="form-input">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Ghi chú</label>
                        <textarea placeholder="Ghi chú cho đơn hàng (tuỳ chọn)" class="form-input" style="height:100px;resize:vertical;"></textarea>
                    </div>

                    <div style="margin-top:12px;">
                        <h3 style="font-size:16px;text-transform:uppercase;letter-spacing:2px;margin-bottom:16px;font-weight:600;">Phương thức thanh toán</h3>
                        <div style="border:1px solid var(--border);padding:20px;border-radius:var(--radius-sm);background:var(--bg-card);">
                            <label style="display:flex;align-items:center;gap:12px;cursor:pointer;color:var(--text-primary);font-size:14px;">
                                <input type="radio" name="payment" checked style="accent-color:var(--accent);"> Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div style="flex:1;min-width:320px;" data-aos="fade-left">
                <div style="position:sticky;top:100px;background:var(--bg-card);padding:32px;border:1px solid var(--border);border-radius:var(--radius-lg);backdrop-filter:blur(20px);">
                    <h3 style="font-size:16px;text-transform:uppercase;letter-spacing:2px;margin-bottom:24px;font-weight:600;">Đơn hàng</h3>
                    <div id="checkout-items" style="margin-bottom:20px;border-bottom:1px solid var(--border);padding-bottom:16px;"></div>
                    <div style="display:flex;justify-content:space-between;font-size:14px;color:var(--text-muted);margin-bottom:12px;">
                        <span>Vận chuyển</span>
                        <span style="color:var(--accent);">Miễn phí</span>
                    </div>
                    <div style="height:1px;background:var(--border);margin-bottom:16px;"></div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:32px;">
                        <span style="font-size:16px;font-weight:600;">Tổng cộng</span>
                        <span id="checkout-total" style="font-size:24px;font-weight:700;color:var(--accent);">0đ</span>
                    </div>
                    <button class="btn btn-primary" id="btn-checkout-submit" style="width:100%;">
                        <i class="fas fa-lock" style="font-size:12px;"></i> Đặt Hàng
                    </button>
                    <p style="text-align:center;margin-top:16px;font-size:12px;color:var(--text-muted);">
                        <i class="fas fa-shield-alt" style="margin-right:4px;"></i> Thông tin được bảo mật an toàn
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>initCheckoutPage();</script>
@endpush
