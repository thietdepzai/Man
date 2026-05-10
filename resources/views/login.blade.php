@extends('layouts.app')

@section('title', 'Đăng Nhập')

@section('content')

        <section class="container" style="padding-top: 100px; padding-bottom: 100px; display: flex; justify-content: center;">
            <div style="width: 400px; padding: 40px; border: 1px solid var(--border); text-align: center;" data-aos="fade-up">
                <h2 style="margin-bottom: 32px;">Đăng Nhập</h2>
                <form id="login-form" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="email" id="login-email" placeholder="Email" required class="form-input">
                    <input type="password" id="login-pass" placeholder="Mật khẩu" required class="form-input">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng Nhập</button>
                </form>
                <p style="margin-top: 24px; color: var(--text-muted);">Chưa có tài khoản? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600;">Đăng ký ngay</a></p>
            </div>
        </section>
        
@endsection

@push('scripts')
<script>initLogin();</script>
@endpush
