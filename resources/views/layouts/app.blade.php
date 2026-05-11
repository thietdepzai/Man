<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Mặn Salt - Premium Collection</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-logo">Mặn.</div>
        <div class="preloader-bar">
            <div class="preloader-progress"></div>
        </div>
    </div>

    <!-- Custom Cursor -->
    <div class="custom-cursor"></div>

    <header class="header">
        <a href="{{ route('home') }}" class="logo">Mặn.</a>
        <nav class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
            <a href="{{ route('danh-muc') }}" class="{{ request()->routeIs('danh-muc') ? 'active' : '' }}">Bộ sưu tập</a>
            <a href="{{ route('tim-kiem') }}"><i class="fas fa-search"></i></a>
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

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <h2>Mặn.</h2>
                    <p style="opacity: 0.5; margin-top: 10px; font-weight: 300;">Essential Earthiness for Modern Kitchens.</p>
                </div>
                <div class="footer-nav">
                    <div class="footer-column">
                        <h4>Shop</h4>
                        <ul>
                            <li><a href="{{ route('danh-muc') }}">Tất cả sản phẩm</a></li>
                            <li><a href="#">Muối đặc sản</a></li>
                            <li><a href="#">Thảo mộc & Gia vị</a></li>
                            <li><a href="#">Quà tặng</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Thông tin</h4>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Hệ thống cửa hàng</a></li>
                            <li><a href="#">Liên hệ</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Hỗ trợ</h4>
                        <ul>
                            <li><a href="#">Chính sách giao hàng</a></li>
                            <li><a href="#">Đổi trả & Hoàn tiền</a></li>
                            <li><a href="#">Câu hỏi thường gặp</a></li>
                            <li><a href="#">Điều khoản dịch vụ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Mặn Salt. All rights reserved.</p>
                <div class="social-links" style="display: flex; gap: 20px;">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
                <p>Designed for Excellence</p>
            </div>
        </div>
    </footer>

    <script>
        window.routes = {
            home: "{{ route('home') }}",
            login: "{{ route('login') }}",
            san_pham: "{{ route('san-pham') }}",
            don_hang: "{{ route('don-hang') }}",
            admin: "{{ route('admin') }}",
            danh_muc: "{{ route('danh-muc') }}",
            gio_hang: "{{ route('gio-hang') }}"
        };
    </script>
    
    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
