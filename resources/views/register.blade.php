@extends('layouts.app')

@section('title', 'Đăng Ký')

@section('content')

        <section class="container" style="padding-top: 100px; padding-bottom: 100px; display: flex; justify-content: center;">
            <div style="width: 400px; padding: 40px; border: 1px solid var(--border); text-align: center;" data-aos="fade-up">
                <h2 style="margin-bottom: 32px;">Đăng Ký</h2>
                <form id="register-form" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="text" id="reg-name" placeholder="Họ và tên" required class="form-input">
                    <input type="email" id="reg-email" placeholder="Email" required class="form-input">
                    <input type="password" id="reg-pass" placeholder="Mật khẩu" required class="form-input">
                    <select id="reg-gender" required class="form-input" style="appearance: auto;">
                        <option value="" disabled selected>Chọn giới tính</option>
                        <option value="nam">Nam</option>
                        <option value="nu">Nữ</option>
                    </select>
                    <input type="date" id="reg-dob" required class="form-input" placeholder="Ngày sinh">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng Ký</button>
                </form>
                <p style="margin-top: 24px; color: var(--text-muted);">Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600;">Đăng nhập</a></p>
            </div>
        </section>
        
@endsection

@push('scripts')
<script>initRegister();</script>
@endpush
