@extends('layouts.app')

@section('title', 'Thanh Toán')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1>Thanh Toán</h1>
            <p style="opacity: 0.5; margin-top: 20px;">Hoàn thiện thông tin để nhận hàng trong thời gian sớm nhất.</p>
        </div>
    </header>

    <section class="container section" style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 80px; align-items: start;">
        <div class="checkout-form-container">
            <h3 style="font-family: var(--font-body); text-transform: uppercase; font-size: 13px; letter-spacing: 2px; margin-bottom: 40px; border-bottom: 1px solid var(--glass-border); padding-bottom: 10px;">Thông tin giao hàng</h3>
            <form id="checkout-form" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; margin-bottom: 8px;">Họ và tên</label>
                    <input type="text" id="chk-name" class="form-input" required>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; margin-bottom: 8px;">Email</label>
                    <input type="email" id="chk-email" class="form-input" required>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; margin-bottom: 8px;">Số điện thoại</label>
                    <input type="tel" id="chk-phone" class="form-input" required>
                </div>
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; margin-bottom: 8px;">Địa chỉ giao hàng</label>
                    <input type="text" id="chk-address" class="form-input" required>
                </div>
                <div style="grid-column: span 2; margin-top: 20px;">
                    <h3 style="font-family: var(--font-body); text-transform: uppercase; font-size: 13px; letter-spacing: 2px; margin-bottom: 30px; border-bottom: 1px solid var(--glass-border); padding-bottom: 10px;">Phương thức thanh toán</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <label class="glass" style="padding: 20px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; gap: 10px;">
                            <input type="radio" name="payment" value="cod" checked>
                            <span style="font-size: 14px;">Thanh toán khi nhận hàng (COD)</span>
                        </label>
                        <label class="glass" style="padding: 20px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; gap: 10px; opacity: 0.5;">
                            <input type="radio" name="payment" value="bank" disabled>
                            <span style="font-size: 14px;">Chuyển khoản ngân hàng (Sắp tới)</span>
                        </label>
                    </div>
                </div>
            </form>
        </div>

        <aside class="order-summary">
            <div class="glass" style="padding: 40px; border-radius: 4px; position: sticky; top: 120px;">
                <h3 style="font-family: var(--font-body); text-transform: uppercase; font-size: 13px; letter-spacing: 2px; margin-bottom: 30px;">Tóm tắt đơn hàng</h3>
                <div id="checkout-items" style="margin-bottom: 30px; border-bottom: 1px solid var(--glass-border); padding-bottom: 20px;">
                    <!-- Rendered by JS -->
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
                    <span style="font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Tổng cộng</span>
                    <span id="checkout-total" style="font-size: 24px; font-weight: 600; color: var(--accent);">0đ</span>
                </div>
                <button type="button" id="btn-checkout-submit" class="btn btn-primary" style="width: 100%;">Xác Nhận Đặt Hàng</button>
                <p style="font-size: 11px; opacity: 0.4; text-align: center; margin-top: 20px;">Bằng cách nhấp vào nút này, bạn đồng ý với Điều khoản dịch vụ của chúng tôi.</p>
            </div>
        </aside>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initCheckoutPage();
    });
</script>
@endpush
