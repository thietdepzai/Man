@extends('layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1>Giỏ Hàng Của Bạn</h1>
            <p style="opacity: 0.5; margin-top: 20px;">Kiểm tra kỹ các sản phẩm trước khi tiến hành thanh toán.</p>
        </div>
    </header>

    <section class="container section">
        <div style="margin-bottom: 60px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border); text-align: left;">
                        <th style="padding: 20px 0; font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Sản phẩm</th>
                        <th style="padding: 20px 0; font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Đơn giá</th>
                        <th style="padding: 20px 0; font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Số lượng</th>
                        <th style="padding: 20px 0; font-family: var(--font-body); text-transform: uppercase; font-size: 11px; letter-spacing: 2px; color: var(--on-surface-muted);">Tổng cộng</th>
                        <th style="padding: 20px 0;"></th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Rendered by JS -->
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: flex-end;">
            <div class="glass" style="width: 400px; padding: 40px; border-radius: 4px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 14px; opacity: 0.6;">
                    <span>Tạm tính</span>
                    <span id="cart-subtotal">0đ</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 30px; padding-top: 20px; border-top: 1px solid var(--glass-border);">
                    <span style="font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Tổng cộng</span>
                    <span id="cart-total" style="font-size: 24px; font-weight: 600; color: var(--accent);">0đ</span>
                </div>
                <a href="{{ route('thanh-toan') }}" class="btn btn-primary" style="width: 100%;">Tiến Hành Thanh Toán</a>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ route('danh-muc') }}" style="font-size: 12px; opacity: 0.4; text-transform: uppercase; letter-spacing: 1px; text-decoration: underline;">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        renderCartPage();
        // Update subtotal too
        const total = document.getElementById('cart-total').innerText;
        document.getElementById('cart-subtotal').innerText = total;
    });
</script>
@endpush
