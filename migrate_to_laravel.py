import os
import shutil

PAGES = {
    "home": {
        "title": "Trang Chủ",
        "route": "/",
        "content": """
        <section class="hero swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background: url('https://images.unsplash.com/photo-1610447814238-a15dcc3779e5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') center/cover;">
                    <div class="hero-overlay"></div>
                    <div class="hero-content" data-aos="fade-up">
                        <h1 class="hero-title">Essential Earthiness</h1>
                        <p class="hero-subtitle">Khám phá hương vị nguyên bản của muối biển thủ công cao cấp.</p>
                        <a href="{{ route('danh-muc') }}" class="btn btn-primary">Khám Phá Ngay</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="container" style="padding-top: 80px; padding-bottom: 80px;">
            <h2 style="text-align: center; margin-bottom: 48px; font-size: 32px;" data-aos="fade-up">Sản Phẩm Nổi Bật</h2>
            <div class="grid-4" id="featured-products" data-aos="fade-up" data-aos-delay="200"></div>
        </section>
        """,
        "extra": "<script>initHome();</script>"
    },
    "danh-muc": {
        "title": "Danh Mục Sản Phẩm",
        "route": "/danh-muc",
        "content": """
        <div class="page-header" data-aos="fade-in">
            <h1>Tất Cả Sản Phẩm</h1>
            <p>Tuyển tập những loại muối tinh khiết nhất</p>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; display: flex; gap: 40px;">
            <aside class="sidebar" style="width: 250px;" data-aos="fade-right">
                <h3>Danh mục</h3>
                <ul style="margin-top: 16px; display: flex; flex-direction: column; gap: 12px; color: var(--text-muted);">
                    <li><a href="#">Muối Hồng Himalaya</a></li>
                    <li><a href="#">Muối Biển Tinh Khiết</a></li>
                    <li><a href="#">Muối Gia Vị</a></li>
                </ul>
            </aside>
            <div style="flex: 1;">
                <div class="grid-4" id="all-products" data-aos="fade-up"></div>
            </div>
        </section>
        """,
        "extra": "<script>renderProducts('all-products');</script>"
    },
    "san-pham": {
        "title": "Chi Tiết Sản Phẩm",
        "route": "/san-pham",
        "content": """
        <section class="container product-detail-section" style="padding-top: 60px; padding-bottom: 80px; display: flex; gap: 64px;">
            <div class="product-gallery" style="flex: 1;" data-aos="fade-right">
                <img id="detail-img" src="" alt="Product" style="width: 100%; height: 600px; object-fit: cover;">
            </div>
            <div class="product-info" style="flex: 1; padding-top: 32px;" data-aos="fade-left">
                <h1 id="detail-title" style="font-size: 40px; margin-bottom: 16px;">Loading...</h1>
                <p id="detail-price" style="font-size: 24px; color: var(--accent); font-weight: 600; margin-bottom: 24px;"></p>
                <p id="detail-desc" style="color: var(--text-muted); margin-bottom: 32px; font-size: 16px; line-height: 1.8;"></p>
                <div style="display: flex; gap: 16px; margin-bottom: 32px; align-items: center;">
                    <input type="number" id="detail-qty" value="1" min="1" style="width: 80px; padding: 12px; border: 1px solid var(--border); text-align: center; font-size: 16px;">
                    <button class="btn btn-primary" id="btn-add-cart" style="flex: 1; padding: 14px;">Thêm Vào Giỏ</button>
                </div>
                <div style="border-top: 1px solid var(--border); padding-top: 24px;">
                    <p><strong>Danh mục:</strong> Muối Cao Cấp</p>
                </div>
            </div>
        </section>
        """,
        "extra": "<script>initProductDetail();</script>"
    },
    "gio-hang": {
        "title": "Giỏ Hàng",
        "route": "/gio-hang",
        "content": """
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
        """,
        "extra": "<script>renderCartPage();</script>"
    },
    "thanh-toan": {
        "title": "Thanh Toán",
        "route": "/thanh-toan",
        "content": """
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
        """,
        "extra": "<script>initCheckoutPage();</script>"
    },
    "tim-kiem": {
        "title": "Tìm Kiếm",
        "route": "/tim-kiem",
        "content": """
        <div class="page-header" data-aos="fade-in">
            <h1>Tìm Kiếm Sản Phẩm</h1>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; text-align: center;">
            <input type="text" id="search-input" placeholder="Nhập tên sản phẩm muối..." class="form-input" style="width: 50%; max-width: 500px; padding: 16px; font-size: 18px; margin-bottom: 40px;">
            <div class="grid-4" id="search-results"></div>
        </section>
        """,
        "extra": "<script>initSearch();</script>"
    },
    "login": {
        "title": "Đăng Nhập",
        "route": "/login",
        "content": """
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
        """,
        "extra": "<script>initLogin();</script>"
    },
    "register": {
        "title": "Đăng Ký",
        "route": "/register",
        "content": """
        <section class="container" style="padding-top: 100px; padding-bottom: 100px; display: flex; justify-content: center;">
            <div style="width: 400px; padding: 40px; border: 1px solid var(--border); text-align: center;" data-aos="fade-up">
                <h2 style="margin-bottom: 32px;">Đăng Ký</h2>
                <form id="register-form" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="text" id="reg-name" placeholder="Họ và tên" required class="form-input">
                    <input type="email" id="reg-email" placeholder="Email" required class="form-input">
                    <input type="password" id="reg-pass" placeholder="Mật khẩu" required class="form-input">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng Ký</button>
                </form>
                <p style="margin-top: 24px; color: var(--text-muted);">Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600;">Đăng nhập</a></p>
            </div>
        </section>
        """,
        "extra": "<script>initRegister();</script>"
    },
    "don-hang": {
        "title": "Đơn Hàng Của Tôi",
        "route": "/don-hang",
        "content": """
        <div class="page-header" data-aos="fade-in">
            <h1>Đơn Hàng Đã Đặt</h1>
            <p>Lịch sử mua sắm của bạn</p>
        </div>
        <section class="container" style="padding-top: 40px; padding-bottom: 80px; min-height: 50vh;">
            <div id="orders-container" data-aos="fade-up">
                <!-- Orders will be rendered here -->
            </div>
        </section>
        """,
        "extra": "<script>renderOrdersPage();</script>"
    }
}

APP_LAYOUT = """<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Mặn Salt</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <a href="{{ route('home') }}" class="logo">Mặn.</a>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('danh-muc') }}">Sản phẩm</a>
            <a href="{{ route('tim-kiem') }}"><i class="fas fa-search"></i> Tìm kiếm</a>
        </nav>
        <div class="header-actions">
            <div id="user-menu-container">
                <!-- Rendered by JS -->
            </div>
            <a href="{{ route('gio-hang') }}" class="cart-icon">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" id="cart-count">0</span>
            </a>
        </div>
    </header>

    @yield('content')

    <footer class="footer">
        <h2 class="logo" style="margin-bottom: 16px;">Mặn.</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Tinh hoa muối Việt. Tinh khiết từ thiên nhiên.</p>
    </footer>

    <!-- Pass routes to JS if needed -->
    <script>
        window.routes = {
            home: "{{ route('home') }}",
            login: "{{ route('login') }}",
            san_pham: "{{ route('san-pham') }}",
            don_hang: "{{ route('don-hang') }}"
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
"""

def migrate():
    base_dir = 'c:/Users/thiet/Man-Store'
    os.chdir(base_dir)

    # Move style and js to public
    os.makedirs('public/css', exist_ok=True)
    os.makedirs('public/js', exist_ok=True)
    
    if os.path.exists('style.css'):
        shutil.copy('style.css', 'public/css/style.css')
    if os.path.exists('app.js'):
        # We need to replace some .html links in app.js with laravel routes or window.routes
        with open('app.js', 'r', encoding='utf-8') as f:
            js_content = f.read()
        
        js_content = js_content.replace('"san-pham.html?id=${p.id}"', '`${window.routes.san_pham}?id=${p.id}`')
        js_content = js_content.replace("'index.html'", "window.routes.home")
        js_content = js_content.replace("'login.html'", "window.routes.login")
        js_content = js_content.replace("'don-hang.html'", "window.routes.don_hang")
        
        with open('public/js/app.js', 'w', encoding='utf-8') as f:
            f.write(js_content)

    # Create layouts
    os.makedirs('resources/views/layouts', exist_ok=True)
    with open('resources/views/layouts/app.blade.php', 'w', encoding='utf-8') as f:
        f.write(APP_LAYOUT)

    # Create blade pages
    routes_php = "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n"
    
    for name, data in PAGES.items():
        # Create blade file
        blade_path = f"resources/views/{name}.blade.php"
        blade_content = f"@extends('layouts.app')\n\n@section('title', '{data['title']}')\n\n@section('content')\n{data['content']}\n@endsection\n\n@push('scripts')\n{data['extra']}\n@endpush\n"
        with open(blade_path, 'w', encoding='utf-8') as f:
            f.write(blade_content)
        
        # Add to routes
        routes_php += f"Route::get('{data['route']}', function () {{\n    return view('{name}');\n}})->name('{name}');\n\n"
        
    with open('routes/web.php', 'w', encoding='utf-8') as f:
        f.write(routes_php)

if __name__ == "__main__":
    migrate()
    print("Migration to Laravel completed successfully.")
