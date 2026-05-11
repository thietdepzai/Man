@extends('layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')

        <div class="page-header" data-aos="fade-in">
            <h1>Giỏ Hàng Của Bạn</h1>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px;">
            <div id="cart-container" data-aos="fade-up">
                <table class="cart-table" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <th style="padding: 16px 0;">Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cart-items"></tbody>
                </table>
                <div style="display: flex; justify-content: space-between; margin-top: 40px; border-top: 1px solid var(--border); padding-top: 32px;">
                    <a href="{{ route('danh-muc') }}" class="btn btn-outline">Tiếp tục mua sắm</a>
                    <div style="text-align: right; width: 300px;">
                        <h3 style="display: flex; justify-content: space-between; margin-bottom: 24px;"><span>Tổng cộng:</span> <span id="cart-total" style="color: var(--accent);">0đ</span></h3>
                        <a href="{{ route('thanh-toan') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Tiến Hành Thanh Toán</a>
                    </div>
                </div>
            </div>
        </section>
        
@endsection

@push('scripts')
<script>renderCartPage();</script>
@endpush
