@extends('layouts.app')

@section('title', 'Thanh Toán')

@section('content')

        <div class="page-header" data-aos="fade-in">
            <h1>Thanh Toán</h1>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; display: flex; gap: 64px;">
            <div style="flex: 2;" data-aos="fade-right">
                <h3 style="margin-bottom: 24px;">Thông tin giao hàng</h3>
                <form id="checkout-form" style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 20px;">
                        <input type="text" id="chk-name" placeholder="Họ và tên *" required class="form-input" style="flex: 1;">
                        <input type="text" id="chk-phone" placeholder="Số điện thoại *" required class="form-input" style="flex: 1;">
                    </div>
                    <input type="email" id="chk-email" placeholder="Email" required class="form-input">
                    <input type="text" id="chk-address" placeholder="Địa chỉ giao hàng *" required class="form-input">
                    <textarea placeholder="Ghi chú đơn hàng" class="form-input" style="height: 100px;"></textarea>
                    
                    <h3 style="margin-top: 24px; margin-bottom: 16px;">Phương thức thanh toán</h3>
                    <div style="border: 1px solid var(--border); padding: 16px;">
                        <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                            <input type="radio" name="payment" checked> Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                </form>
            </div>
            <div style="flex: 1; background: var(--surface-dim); padding: 32px; border: 1px solid var(--border);" data-aos="fade-left">
                <h3 style="margin-bottom: 24px;">Đơn hàng của bạn</h3>
                <div id="checkout-items" style="margin-bottom: 24px; border-bottom: 1px solid var(--border); padding-bottom: 16px;"></div>
                <div style="display: flex; justify-content: space-between; font-size: 20px; font-weight: 600; margin-bottom: 32px;">
                    <span>Tổng:</span>
                    <span id="checkout-total" style="color: var(--accent);">0đ</span>
                </div>
                <button class="btn btn-primary" id="btn-checkout-submit" style="width: 100%;">Đặt Hàng</button>
            </div>
        </section>
        
@endsection

@push('scripts')
<script>initCheckoutPage();</script>
@endpush
