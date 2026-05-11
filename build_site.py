import os

HEADER = """
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{title} | Mặn Salt</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <a href="index.html" class="logo">Mặn.</a>
        <nav class="nav-links">
            <a href="index.html">Trang chủ</a>
            <a href="danh-muc.html">Sản phẩm</a>
            <a href="tim-kiem.html"><i class="fas fa-search"></i> Tìm kiếm</a>
        </nav>
        <div class="header-actions">
            <div id="user-menu-container">
                <!-- Rendered by JS -->
            </div>
            <a href="gio-hang.html" class="cart-icon">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-badge" id="cart-count">0</span>
            </a>
        </div>
    </header>
"""

FOOTER = """
    <footer class="footer">
        <h2 class="logo" style="margin-bottom: 16px;">Mặn.</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Tinh hoa muối Việt. Tinh khiết từ thiên nhiên.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/studio-freight/lenis@1.0.19/bundled/lenis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script src="app.js"></script>
    {extra_scripts}
</body>
</html>
"""

PAGES = {
    "index.html": {
        "title": "Trang Chủ",
        "content": """
        <section class="hero swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background: url('https://images.unsplash.com/photo-1610447814238-a15dcc3779e5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') center/cover;">
                    <div class="hero-overlay"></div>
                    <div class="hero-content" data-aos="fade-up">
                        <h1 class="hero-title">Essential Earthiness</h1>
                        <p class="hero-subtitle">Khám phá hương vị nguyên bản của muối biển thủ công cao cấp.</p>
                        <a href="danh-muc.html" class="btn btn-primary">Khám Phá Ngay</a>
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
    "danh-muc.html": {
        "title": "Danh Mục Sản Phẩm",
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
    "san-pham.html": {
        "title": "Chi Tiết Sản Phẩm",
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
    "gio-hang.html": {
        "title": "Giỏ Hàng",
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
                    <a href="danh-muc.html" class="btn btn-outline">Tiếp tục mua sắm</a>
                    <div style="text-align: right; width: 300px;">
                        <h3 style="display: flex; justify-content: space-between; margin-bottom: 24px;"><span>Tổng cộng:</span> <span id="cart-total" style="color: var(--accent);">0đ</span></h3>
                        <a href="thanh-toan.html" class="btn btn-primary" style="width: 100%; text-align: center;">Tiến Hành Thanh Toán</a>
                    </div>
                </div>
            </div>
        </section>
        """,
        "extra": "<script>renderCartPage();</script>"
    },
    "thanh-toan.html": {
        "title": "Thanh Toán",
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
    "tim-kiem.html": {
        "title": "Tìm Kiếm",
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
    "login.html": {
        "title": "Đăng Nhập",
        "content": """
        <section class="container" style="padding-top: 100px; padding-bottom: 100px; display: flex; justify-content: center;">
            <div style="width: 400px; padding: 40px; border: 1px solid var(--border); text-align: center;" data-aos="fade-up">
                <h2 style="margin-bottom: 32px;">Đăng Nhập</h2>
                <form id="login-form" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="email" id="login-email" placeholder="Email" required class="form-input">
                    <input type="password" id="login-pass" placeholder="Mật khẩu" required class="form-input">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng Nhập</button>
                </form>
                <p style="margin-top: 24px; color: var(--text-muted);">Chưa có tài khoản? <a href="register.html" style="color: var(--primary); font-weight: 600;">Đăng ký ngay</a></p>
            </div>
        </section>
        """,
        "extra": "<script>initLogin();</script>"
    },
    "register.html": {
        "title": "Đăng Ký",
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
                <p style="margin-top: 24px; color: var(--text-muted);">Đã có tài khoản? <a href="login.html" style="color: var(--primary); font-weight: 600;">Đăng nhập</a></p>
            </div>
        </section>
        """,
        "extra": "<script>initRegister();</script>"
    },
    "don-hang.html": {
        "title": "Đơn Hàng Của Tôi",
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

CSS_CONTENT = """
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap');

:root {
    --surface: #fcf8f8;
    --surface-dim: #f6f3f2;
    --primary: #17191b;
    --secondary: #5d5f5f;
    --accent: #ba1a1a;
    --text-main: #1c1b1b;
    --text-muted: #75777a;
    --border: #e5e2e1;
    --font-heading: 'Playfair Display', serif;
    --font-body: 'Inter', sans-serif;
}

* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: var(--font-body);
    background-color: var(--surface);
    color: var(--text-main);
    line-height: 1.6;
    overflow-x: hidden;
}
h1, h2, h3, h4, h5 { font-family: var(--font-heading); font-weight: 600; color: var(--primary); }
a { text-decoration: none; color: inherit; }
ul { list-style: none; }

.container { max-width: 1280px; margin: 0 auto; padding: 0 5%; }
.page-header { background: var(--surface-dim); padding: 80px 5%; text-align: center; border-bottom: 1px solid var(--border); }
.page-header h1 { font-size: 48px; margin-bottom: 16px; }

/* Header */
.header {
    display: flex; justify-content: space-between; align-items: center;
    padding: 24px 5%; border-bottom: 1px solid var(--border);
    background: rgba(252, 248, 248, 0.9); backdrop-filter: blur(10px);
    position: sticky; top: 0; z-index: 100;
}
.logo { font-family: var(--font-heading); font-size: 28px; font-weight: 700; letter-spacing: -1px; }
.nav-links { display: flex; gap: 32px; }
.nav-links a { font-weight: 500; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: color 0.3s; }
.nav-links a:hover { color: var(--accent); }
.header-actions { display: flex; gap: 24px; align-items: center; font-size: 18px; }
.cart-icon { position: relative; cursor: pointer; }
.cart-badge {
    position: absolute; top: -8px; right: -12px; background: var(--accent); color: white;
    font-size: 10px; font-weight: bold; width: 18px; height: 18px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}

/* User Menu */
.user-dropdown { position: relative; display: inline-block; padding-bottom: 10px; margin-bottom: -10px; }
.user-dropdown-content {
    display: none; position: absolute; right: 0; background-color: var(--surface); top: 100%; margin-top: 5px;
    min-width: 180px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 100;
    border: 1px solid var(--border); border-radius: 4px; overflow: visible;
}
.user-dropdown-content::before {
    content: ''; position: absolute; top: -15px; left: 0; width: 100%; height: 15px; background: transparent;
}
.user-dropdown:hover .user-dropdown-content { display: block; }
.user-dropdown-content a { color: var(--text-main); padding: 12px 16px; text-decoration: none; display: block; font-size: 14px; }
.user-dropdown-content a:hover { background-color: var(--surface-dim); }
.user-greeting { font-size: 14px; font-weight: 600; cursor: pointer; }

/* Buttons & Inputs */
.btn {
    display: inline-block; padding: 14px 32px; font-family: var(--font-body);
    font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
    cursor: pointer; transition: all 0.3s ease; border: none; border-radius: 4px;
}
.btn-primary { background-color: var(--primary); color: white; }
.btn-primary:hover { background-color: var(--text-muted); }
.btn-outline { background: transparent; border: 1px solid var(--primary); color: var(--primary); }
.btn-outline:hover { background: var(--primary); color: white; }
.btn-sm { padding: 8px 16px; font-size: 12px; }

.form-input {
    padding: 14px 16px; border: 1px solid var(--border); border-radius: 4px;
    font-family: var(--font-body); font-size: 16px; width: 100%; outline: none;
    transition: border-color 0.3s; background: white;
}
.form-input:focus { border-color: var(--primary); }

/* Hero */
.hero { height: 80vh; position: relative; }
.hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.3); z-index: 1; }
.hero-content {
    position: absolute; top: 50%; left: 5%; transform: translateY(-50%);
    z-index: 2; color: white; max-width: 600px;
}
.hero-title { font-size: 64px; line-height: 1.1; margin-bottom: 24px; color: white; }
.hero-subtitle { font-size: 18px; margin-bottom: 40px; opacity: 0.9; }

/* Grid & Cards */
.grid-4 { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 32px; }
.product-card {
    background: white; transition: transform 0.4s ease, box-shadow 0.4s ease;
    border: 1px solid var(--border); text-align: center; cursor: pointer; display: block;
}
.product-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.06); }
.product-img { width: 100%; height: 320px; object-fit: cover; border-bottom: 1px solid var(--border); }
.product-info-box { padding: 24px 16px; }
.product-title { font-size: 18px; margin-bottom: 8px; color: var(--primary); }
.product-price { color: var(--accent); font-weight: 600; font-size: 16px; }

/* Tables */
.cart-table { width: 100%; border-collapse: collapse; text-align: left; }
.cart-table th { padding: 16px 0; border-bottom: 1px solid var(--border); }
.cart-table td { padding: 24px 0; border-bottom: 1px solid var(--border); vertical-align: middle; }
.cart-item-img { width: 80px; height: 80px; object-fit: cover; margin-right: 16px; vertical-align: middle; border: 1px solid var(--border); }

/* Orders card */
.order-card { border: 1px solid var(--border); padding: 24px; margin-bottom: 24px; background: white; border-radius: 4px; }
.order-header { display: flex; justify-content: space-between; border-bottom: 1px solid var(--border); padding-bottom: 16px; margin-bottom: 16px; }
.order-item-row { display: flex; justify-content: space-between; margin-bottom: 8px; color: var(--text-muted); }

/* Footer */
.footer { border-top: 1px solid var(--border); padding: 80px 5%; margin-top: 80px; text-align: center; background: var(--surface-dim); }
"""

JS_CONTENT = """
// --- Data ---
const products = [
    { id: 1, name: "Muối Hồng Himalaya Hạt Lớn", price: 150000, img: "https://images.unsplash.com/photo-1518110924446-24e5d8dce288?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Muối hồng Himalaya tinh khiết khai thác từ mỏ đá muối cổ đại, giữ nguyên khoáng chất tự nhiên." },
    { id: 2, name: "Muối Biển Chấm Hoa Quả", price: 85000, img: "https://images.unsplash.com/photo-1623838421838-89c56fa98c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Muối biển sấy khô kết hợp ớt sừng và tôm khô, vị cay nồng đậm đà." },
    { id: 3, name: "Muối Tiêu Đen Nguyên Hạt", price: 120000, img: "https://images.unsplash.com/photo-1596647248356-0798e945c115?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Sự kết hợp hoàn hảo giữa muối biển và tiêu đen Phú Quốc." },
    { id: 4, name: "Muối Tỏi Thảo Mộc", price: 95000, img: "https://images.unsplash.com/photo-1605335122165-4fcd0339d1b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Muối ướp thịt tuyệt hảo với tỏi sấy và các loại thảo mộc Ý." },
    { id: 5, name: "Muối Truffle Đen", price: 450000, img: "https://images.unsplash.com/photo-1621252178044-f254ee4bc710?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Đỉnh cao ẩm thực với nấm Truffle đen từ Ý xay nhuyễn cùng muối biển." },
    { id: 6, name: "Muối Chanh Vàng", price: 110000, img: "https://images.unsplash.com/photo-1587313632739-c894c2598d9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Vị chua thanh mát từ vỏ chanh vàng sấy lạnh." },
    { id: 7, name: "Muối Khói Gỗ Sồi", price: 180000, img: "https://images.unsplash.com/photo-1616428751433-f57ec0968df7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Hun khói thủ công bằng gỗ sồi trong 48h, tạo hương vị BBQ đặc trưng." },
    { id: 8, name: "Muối Diêm Mạch", price: 160000, img: "https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Giàu protein và khoáng chất, kết hợp hoàn hảo cho chế độ ăn eat clean." }
];

// --- Authentication Logic ---
function getUser() {
    return JSON.parse(localStorage.getItem('currentUser'));
}

function renderAuthMenu() {
    const user = getUser();
    const container = document.getElementById('user-menu-container');
    if(!container) return;
    
    if(user) {
        container.innerHTML = `
            <div class="user-dropdown">
                <span class="user-greeting">Xin chào, ${user.name} <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></span>
                <div class="user-dropdown-content">
                    <a href="don-hang.html"><i class="fas fa-box"></i> Đơn hàng của tôi</a>
                    <a href="#" onclick="logoutUser()"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        `;
    } else {
        container.innerHTML = `<a href="login.html"><i class="far fa-user"></i></a>`;
    }
}

window.logoutUser = function() {
    localStorage.removeItem('currentUser');
    window.location = 'index.html';
}

function initRegister() {
    document.getElementById('register-form').addEventListener('submit', e => {
        e.preventDefault();
        const name = document.getElementById('reg-name').value;
        const email = document.getElementById('reg-email').value;
        const pass = document.getElementById('reg-pass').value;
        
        // Save to fake DB
        localStorage.setItem('db_user', JSON.stringify({name, email, pass}));
        
        Swal.fire('Thành công', 'Đăng ký thành công! Vui lòng đăng nhập.', 'success').then(() => {
            window.location = 'login.html';
        });
    });
}

function initLogin() {
    document.getElementById('login-form').addEventListener('submit', e => {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const pass = document.getElementById('login-pass').value;
        
        const dbUser = JSON.parse(localStorage.getItem('db_user'));
        
        if(dbUser && dbUser.email === email && dbUser.pass === pass) {
            localStorage.setItem('currentUser', JSON.stringify({name: dbUser.name, email: dbUser.email}));
            Swal.fire('Thành công', 'Đăng nhập thành công!', 'success').then(() => {
                window.location = 'index.html';
            });
        } else {
            Swal.fire('Lỗi', 'Email hoặc mật khẩu không chính xác. Xin hãy đăng ký trước!', 'error');
        }
    });
}

// --- Cart Logic ---
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById('cart-count');
    if(badge) badge.innerText = count;
}

function addToCart(product, qty = 1) {
    const existing = cart.find(item => item.id === product.id);
    if(existing) existing.qty += qty;
    else cart.push({ ...product, qty });
    saveCart();
    
    Toastify({
        text: `Đã thêm ${product.name} vào giỏ`,
        duration: 3000,
        gravity: "bottom", position: "right",
        style: { background: "#ba1a1a", color: "#fff", borderRadius: "4px" }
    }).showToast();
}

const formatPrice = (price) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);

// --- Render Functions ---
function createProductCard(p) {
    return `
        <a href="san-pham.html?id=${p.id}" class="product-card">
            <img src="${p.img}" class="product-img" alt="${p.name}">
            <div class="product-info-box">
                <h3 class="product-title">${p.name}</h3>
                <p class="product-price">${formatPrice(p.price)}</p>
            </div>
        </a>
    `;
}

function renderProducts(containerId, limit = null) {
    const container = document.getElementById(containerId);
    if(!container) return;
    const items = limit ? products.slice(0, limit) : products;
    container.innerHTML = items.map(createProductCard).join('');
}

function initHome() {
    renderProducts('featured-products', 4);
    new Swiper('.mySwiper', { effect: 'fade', autoplay: { delay: 5000 } });
}

function initProductDetail() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = parseInt(urlParams.get('id')) || 1;
    const p = products.find(x => x.id === id);
    if(!p) return;
    
    document.getElementById('detail-img').src = p.img;
    document.getElementById('detail-title').innerText = p.name;
    document.getElementById('detail-price').innerText = formatPrice(p.price);
    document.getElementById('detail-desc').innerText = p.desc;
    
    document.getElementById('btn-add-cart').addEventListener('click', () => {
        const qty = parseInt(document.getElementById('detail-qty').value) || 1;
        addToCart(p, qty);
    });
}

function renderCartPage() {
    const tbody = document.getElementById('cart-items');
    if(!tbody) return;
    
    if(cart.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 40px;">Giỏ hàng trống</td></tr>`;
        document.getElementById('cart-total').innerText = '0đ';
        return;
    }
    
    let total = 0;
    tbody.innerHTML = cart.map((item, index) => {
        const lineTotal = item.price * item.qty;
        total += lineTotal;
        return `
            <tr>
                <td>
                    <img src="${item.img}" class="cart-item-img">
                    <span style="font-weight: 500;">${item.name}</span>
                </td>
                <td>${formatPrice(item.price)}</td>
                <td>
                    <input type="number" value="${item.qty}" min="1" onchange="updateQty(${index}, this.value)" style="width: 60px; padding: 8px; text-align: center; border: 1px solid var(--border);">
                </td>
                <td style="font-weight: 600;">${formatPrice(lineTotal)}</td>
                <td><button onclick="removeCartItem(${index})" style="background: none; border: none; color: var(--accent); cursor: pointer; font-size: 18px;"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
    }).join('');
    document.getElementById('cart-total').innerText = formatPrice(total);
}

window.updateQty = function(index, newQty) {
    cart[index].qty = parseInt(newQty) || 1;
    saveCart();
    renderCartPage();
}

window.removeCartItem = function(index) {
    cart.splice(index, 1);
    saveCart();
    renderCartPage();
}

// --- Checkout and Orders ---
function initCheckoutPage() {
    const container = document.getElementById('checkout-items');
    if(!container) return;
    
    const user = getUser();
    if(user) {
        document.getElementById('chk-name').value = user.name;
        document.getElementById('chk-email').value = user.email;
    } else {
        Swal.fire({
            title: 'Chú ý',
            text: 'Bạn chưa đăng nhập. Vui lòng đăng nhập để dễ dàng theo dõi đơn hàng!',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Đăng nhập',
            cancelButtonText: 'Tiếp tục thanh toán'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'login.html';
            }
        });
    }
    
    if(cart.length === 0) {
        container.innerHTML = "<p>Không có sản phẩm nào để thanh toán.</p>";
        return;
    }
    
    let total = 0;
    container.innerHTML = cart.map(item => {
        total += item.price * item.qty;
        return `
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                <span>${item.name} x ${item.qty}</span>
                <span>${formatPrice(item.price * item.qty)}</span>
            </div>
        `;
    }).join('');
    document.getElementById('checkout-total').innerText = formatPrice(total);
    
    // Bind checkout
    document.getElementById('btn-checkout-submit').addEventListener('click', (e) => {
        e.preventDefault();
        processCheckout();
    });
}

function processCheckout() {
    if(cart.length === 0) {
        Swal.fire('Lỗi', 'Giỏ hàng trống!', 'error');
        return;
    }
    const form = document.getElementById('checkout-form');
    if(!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    const total = cart.reduce((s, item) => s + (item.price * item.qty), 0);
    
    Swal.fire({
        title: 'Đang xử lý...',
        text: 'Vui lòng chờ trong giây lát',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
    
    setTimeout(() => {
        // Save order to history
        const user = getUser();
        const orderHistory = JSON.parse(localStorage.getItem('orders')) || [];
        const newOrder = {
            id: 'ORD-' + Math.floor(Math.random()*1000000),
            date: new Date().toLocaleString('vi-VN'),
            items: [...cart],
            total: total,
            status: 'Đang xử lý',
            userEmail: user ? user.email : 'Guest'
        };
        orderHistory.push(newOrder);
        localStorage.setItem('orders', JSON.stringify(orderHistory));
        
        // Clear cart
        cart = [];
        saveCart();
        
        Swal.fire('Thành công!', 'Đơn hàng của bạn đã được đặt thành công.', 'success').then(() => {
            window.location = user ? 'don-hang.html' : 'index.html';
        });
    }, 2000);
}

function renderOrdersPage() {
    const container = document.getElementById('orders-container');
    if(!container) return;
    
    const user = getUser();
    if(!user) {
        container.innerHTML = `
            <div style="text-align: center; padding: 40px;">
                <p style="margin-bottom: 24px; color: var(--text-muted);">Vui lòng đăng nhập để xem đơn hàng.</p>
                <a href="login.html" class="btn btn-primary">Đăng Nhập Ngay</a>
            </div>
        `;
        return;
    }
    
    const allOrders = JSON.parse(localStorage.getItem('orders')) || [];
    // Filter orders for the current user
    const userOrders = allOrders.filter(o => o.userEmail === user.email).reverse();
    
    if(userOrders.length === 0) {
        container.innerHTML = `<p style="text-align: center; padding: 40px;">Bạn chưa có đơn hàng nào.</p>`;
        return;
    }
    
    container.innerHTML = userOrders.map(order => `
        <div class="order-card">
            <div class="order-header">
                <div>
                    <h3 style="margin-bottom: 8px;">Mã Đơn: ${order.id}</h3>
                    <p style="font-size: 14px; color: var(--text-muted);"><i class="far fa-calendar-alt"></i> ${order.date}</p>
                </div>
                <div style="text-align: right;">
                    <span style="background: var(--surface-dim); padding: 4px 12px; border-radius: 4px; font-size: 14px; font-weight: 500;">${order.status}</span>
                </div>
            </div>
            <div class="order-items" style="margin-bottom: 16px;">
                ${order.items.map(item => `
                    <div class="order-item-row">
                        <span>${item.name} <strong style="color: var(--primary);">x${item.qty}</strong></span>
                        <span>${formatPrice(item.price * item.qty)}</span>
                    </div>
                `).join('')}
            </div>
            <div style="text-align: right; border-top: 1px dashed var(--border); padding-top: 16px;">
                <span style="font-size: 16px;">Tổng tiền:</span> <span style="font-size: 20px; font-weight: 600; color: var(--accent);">${formatPrice(order.total)}</span>
            </div>
        </div>
    `).join('');
}

function initSearch() {
    const input = document.getElementById('search-input');
    const results = document.getElementById('search-results');
    if(!input) return;
    
    const render = (query) => {
        const filtered = products.filter(p => p.name.toLowerCase().includes(query.toLowerCase()));
        if(filtered.length === 0) results.innerHTML = "<p style='grid-column: 1/-1;'>Không tìm thấy sản phẩm phù hợp.</p>";
        else {
            results.innerHTML = filtered.map(createProductCard).join('');
        }
    }
    
    render('');
    input.addEventListener('input', (e) => render(e.target.value));
}

// --- Global Init ---
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    renderAuthMenu();
    
    AOS.init({ duration: 800, once: true });
    
    const lenis = new Lenis()
    function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
    requestAnimationFrame(raf);
});
"""

import os

def build():
    os.chdir('c:/Users/thiet/Man-Store')
    
    with open('style.css', 'w', encoding='utf-8') as f:
        f.write(CSS_CONTENT)
        
    with open('app.js', 'w', encoding='utf-8') as f:
        f.write(JS_CONTENT)
        
    for filename, data in PAGES.items():
        html = HEADER.format(title=data['title']) + data['content'] + FOOTER.format(extra_scripts=data['extra'])
        with open(filename, 'w', encoding='utf-8') as f:
            f.write(html)
            
    print("Built 9 pages successfully, including order history and authentication.")

if __name__ == "__main__":
    build()
