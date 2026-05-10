@extends('layouts.app')

@section('title', 'Tìm Kiếm')

@section('content')

        <div class="page-header" data-aos="fade-in">
            <h1>Tìm Kiếm Sản Phẩm</h1>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; text-align: center;">
            <input type="text" id="search-input" placeholder="Nhập tên sản phẩm muối..." class="form-input" style="width: 50%; max-width: 500px; padding: 16px; font-size: 18px; margin-bottom: 40px;">
            <div class="grid-4" id="search-results"></div>
        </section>
        
@endsection

@push('scripts')
<script>initSearch();</script>
@endpush
