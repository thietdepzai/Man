@extends('layouts.app')

@section('title', 'Đăng Ký')

@section('content')

    <section class="container" style="padding-top:80px;padding-bottom:120px;display:flex;justify-content:center;">
        <div style="width:440px;max-width:100%;" data-aos="fade-up">
            <div style="text-align:center;margin-bottom:40px;">
                <a href="{{ route('home') }}" style="font-family:var(--font-heading);font-size:36px;font-weight:700;color:var(--text-primary);letter-spacing:-1px;">Mặn.</a>
                <h2 style="margin-top:24px;font-size:28px;letter-spacing:-0.5px;">Tạo Tài Khoản</h2>
                <p style="color:var(--text-muted);margin-top:8px;font-size:14px;">Tham gia cộng đồng Mặn Salt</p>
            </div>

            <div style="padding:40px;border:1px solid var(--border);border-radius:var(--radius-lg);background:var(--bg-card);backdrop-filter:blur(20px);">
                <form id="register-form" style="display:flex;flex-direction:column;gap:20px;">
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Họ và tên</label>
                        <input type="text" id="reg-name" placeholder="Nguyễn Văn A" required class="form-input">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Email</label>
                        <input type="email" id="reg-email" placeholder="you@example.com" required class="form-input">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Mật khẩu</label>
                        <input type="password" id="reg-pass" placeholder="••••••••" required class="form-input">
                    </div>
                    <div style="display:flex;gap:16px;">
                        <div style="flex:1;">
                            <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Giới tính</label>
                            <select id="reg-gender" required class="form-input" style="appearance:auto;">
                                <option value="" disabled selected>Chọn</option>
                                <option value="nam">Nam</option>
                                <option value="nu">Nữ</option>
                            </select>
                        </div>
                        <div style="flex:1;">
                            <label style="display:block;font-size:12px;text-transform:uppercase;letter-spacing:1.5px;color:var(--text-muted);margin-bottom:8px;font-weight:500;">Ngày sinh</label>
                            <input type="date" id="reg-dob" required class="form-input">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;margin-top:8px;">Đăng Ký</button>
                </form>
            </div>

            <p style="margin-top:28px;color:var(--text-muted);text-align:center;font-size:14px;">Đã có tài khoản? <a href="{{ route('login') }}" style="color:var(--accent);font-weight:600;">Đăng nhập</a></p>
        </div>
    </section>

@endsection

@push('scripts')
<script>initRegister();</script>
@endpush
