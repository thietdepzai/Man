<!DOCTYPE html>
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
        <div class="footer-top">
            <p>CONNECT WITH US<br><span class="social-handle">@MANSALT</span></p>
        </div>
        
        <div class="footer-main">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo">Mặn.</a>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="footer-links-container">
                <div class="footer-links">
                    <ul>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Câu hỏi thường gặp</a></li>
                        <li><a href="#">Chính sách Đổi/Trả</a></li>
                        <li><a href="#">Điều khoản dịch vụ</a></li>
                        <li><a href="#">Thẻ quà tặng</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <ul>
                        <li><a href="#" style="color: #ffffff;">Tiền tệ: <strong style="text-decoration: underline;">VND</strong> <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 4px;"></i></a></li>
                        <li><a href="#">Tài khoản</a></li>
                        <li><a href="#">Hệ thống cửa hàng</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-subscribe">
                <h4>Tham gia bản tin Mặn Salt</h4>
                <p>Hãy là người đầu tiên nhận thông tin về sản phẩm mới và khuyến mãi!</p>
                <form class="subscribe-form" onsubmit="event.preventDefault(); Swal.fire('Thành công', 'Cảm ơn bạn đã đăng ký nhận bản tin!', 'success');">
                    <input type="email" placeholder="Email của bạn" required>
                    <button type="submit">ĐĂNG KÝ</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div><a href="#" style="color: inherit; text-decoration: none;">Điều khoản & Điều kiện</a></div>
            <div>&copy; 2026 Mặn Salt. All rights reserved.</div>
        </div>
    </footer>

    <!-- Pass routes to JS if needed -->
    <script>
        window.routes = {
            home: "{{ route('home') }}",
            login: "{{ route('login') }}",
            san_pham: "{{ route('san-pham') }}",
            don_hang: "{{ route('don-hang') }}",
            admin: "{{ route('admin') }}"
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
