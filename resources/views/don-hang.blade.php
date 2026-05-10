@extends('layouts.app')

@section('title', 'Đơn Hàng Của Tôi')

@section('content')

        <div class="page-header" data-aos="fade-in">
            <h1>Đơn Hàng Đã Đặt</h1>
            <p>Lịch sử mua sắm của bạn</p>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; min-height: 50vh;">
            <div id="orders-container" data-aos="fade-up">
                <!-- Orders will be rendered here -->
            </div>
        </section>
        
@endsection

@push('scripts')
<script>renderOrdersPage();</script>
@endpush
