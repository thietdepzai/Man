@extends('layouts.app')

@section('title', 'Đăng Nhập')

@section('content')

    <section class="container" style="padding-top:100px;padding-bottom:120px;display:flex;justify-content:center;">
        <div style="width:440px;max-width:100%;" data-aos="fade-up">
            <div style="text-align:center;margin-bottom:40px;">
                <a href="{{ route('home') }}" style="font-family:var(--font-heading);font-size:36px;font-weight:700;color:var(--text-primary);letter-spacing:-1px;">Mặn.</a>
                <h2 style="margin-top:24px;font-size:28px;letter-spacing:-0.5px;">Đăng Nhập</h2>
                <p style="color:var(--text-muted);margin-top:8px;font-size:14px;">Chào mừng bạn trở lại</p>
            </div>

            <div style="padding:40px;border:1px solid var(--border);border-radius:var(--radius-lg);background:var(--bg-card);backdrop-filter:blur(20px);">
                <form id="login-form" style="display:flex;flex-direction:column;gap:20px;">
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Email</label>
                        <input type="email" id="login-email" placeholder="you@example.com" required class="form-input">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Mật khẩu</label>
                        <input type="password" id="login-pass" placeholder="••••••••" required class="form-input">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;margin-top:8px;">Đăng Nhập</button>
                </form>
            </div>

            <p style="margin-top:28px;color:var(--text-muted);text-align:center;font-size:14px;">Chưa có tài khoản? <a href="{{ route('register') }}" style="color:var(--accent);font-weight:600;">Đăng ký ngay</a></p>
        </div>
    </section>

@endsection

@push('scripts')
<script>initLogin();</script>
@endpush
