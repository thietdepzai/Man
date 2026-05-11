@extends('layouts.app')

@section('title', 'Đơn Hàng Của Tôi')

@section('content')

    <div class="page-header" data-aos="fade-in">
        <p style="font-size:12px;text-transform:uppercase;letter-spacing:4px;color:var(--accent);margin-bottom:12px;font-weight:500;position:relative;">Lịch Sử</p>
        <h1>Đơn Hàng Đã Đặt</h1>
        <p style="margin-top:8px;">Theo dõi trạng thái đơn hàng của bạn</p>
    </div>

    <section class="container" style="padding-top:48px;padding-bottom:100px;min-height:50vh;">
        <div id="orders-container" data-aos="fade-up"></div>
    </section>

@endsection

@push('scripts')
<script>renderOrdersPage();</script>
@endpush
