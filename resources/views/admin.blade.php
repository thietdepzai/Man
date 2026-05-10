
<!DOCTYPE html>
<html lang="vi">
<head>
    <script>
        const adminUser = JSON.parse(localStorage.getItem('currentUser'));
        if (!adminUser || adminUser.email !== 'thiet1234@gmail.com') {
            alert('Bạn không có quyền truy cập trang quản trị!');
            window.location.href = '/login';
        }
    </script>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | Mặn Salt</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">Mặn. Admin</div>
        <div class="nav-item active" onclick="switchTab('dashboard')"><i class="fas fa-chart-line"></i> Tổng quan</div>
        <div class="nav-item" onclick="switchTab('products')"><i class="fas fa-box"></i> Sản phẩm</div>
        <div class="nav-item" onclick="switchTab('orders')"><i class="fas fa-shopping-cart"></i> Đơn hàng</div>
        <div class="nav-item" onclick="switchTab('analytics')"><i class="fas fa-chart-pie"></i> Phân tích AI</div>
        <div style="margin-top: auto; padding: 24px;">
            <a href="{{ route('home') }}" style="color: #a0aec0; text-decoration: none;"><i class="fas fa-arrow-left"></i> Về trang mua sắm</a>
        </div>
    </div>
    <div class="main-content">
        <div id="tab-dashboard">
            <div class="header">
                <h2>Tổng Quan</h2>
            </div>

            <!-- Hàng 1: Doanh thu & Đơn hàng -->
            <div class="grid-4">
                <div class="card stat-card stat-card--revenue">
                    <div class="stat-icon"><i class="fas fa-coins"></i></div>
                    <div class="stat-label">Doanh thu (Đã duyệt)</div>
                    <div class="stat-value" id="stat-revenue">0đ</div>
                </div>
                <div class="card stat-card stat-card--total">
                    <div class="stat-icon"><i class="fas fa-receipt"></i></div>
                    <div class="stat-label">Tổng đơn hàng</div>
                    <div class="stat-value" id="stat-orders">0</div>
                </div>
                <div class="card stat-card stat-card--processing">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-label">Đang xử lý</div>
                    <div class="stat-value" id="stat-processing">0</div>
                </div>
                <div class="card stat-card stat-card--shipping">
                    <div class="stat-icon"><i class="fas fa-truck"></i></div>
                    <div class="stat-label">Đang giao</div>
                    <div class="stat-value" id="stat-shipping">0</div>
                </div>
            </div>

            <!-- Hàng 2: Sản phẩm nổi bật -->
            <div class="grid-4">
                <div class="card stat-card stat-card--products">
                    <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                    <div class="stat-label">Sản phẩm hiện có</div>
                    <div class="stat-value" id="stat-products">0</div>
                </div>
                <div class="card stat-card stat-card--best">
                    <div class="stat-icon"><i class="fas fa-fire"></i></div>
                    <div class="stat-label">Mua nhiều nhất</div>
                    <div class="stat-value stat-value--sm" id="stat-best-product">—</div>
                    <div class="stat-sub" id="stat-best-qty"></div>
                </div>
                <div class="card stat-card stat-card--worst">
                    <div class="stat-icon"><i class="fas fa-snowflake"></i></div>
                    <div class="stat-label">Ít mua nhất</div>
                    <div class="stat-value stat-value--sm" id="stat-worst-product">—</div>
                    <div class="stat-sub" id="stat-worst-qty"></div>
                </div>
                <div class="card stat-card stat-card--views">
                    <div class="stat-icon"><i class="fas fa-eye"></i></div>
                    <div class="stat-label">Lượt xem cao nhất</div>
                    <div class="stat-value stat-value--sm" id="stat-most-viewed">—</div>
                    <div class="stat-sub" id="stat-most-viewed-count"></div>
                </div>
            </div>

            <!-- Đơn hàng gần đây -->
            <div class="card">
                <h3>Đơn hàng gần đây</h3>
                <table style="margin-top: 16px;">
                    <thead><tr><th>Mã Đơn</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th></tr></thead>
                    <tbody id="recent-orders-table"></tbody>
                </table>
            </div>
        </div>

        <div id="tab-products" style="display: none;">
            <div class="header">
                <h2>Quản Lý Sản Phẩm</h2>
                <button class="btn btn-primary" onclick="openProductModal()"><i class="fas fa-plus"></i> Thêm Sản Phẩm</button>
            </div>
            <div class="card">
                <table>
                    <thead><tr><th>Hình ảnh</th><th>Tên sản phẩm</th><th>Giá</th><th>Thao tác</th></tr></thead>
                    <tbody id="products-table"></tbody>
                </table>
            </div>
        </div>

        <div id="tab-orders" style="display: none;">
            <div class="header">
                <h2>Quản Lý Đơn Hàng</h2>
            </div>
            <div class="card">
                <table>
                    <thead><tr><th>Mã Đơn</th><th>Ngày đặt</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
                    <tbody id="orders-table"></tbody>
                </table>
            </div>
        </div>
        <div id="tab-analytics" style="display: none;">
            <div class="header">
                <h2>Phân Tích AI - Hành Vi Mua Hàng</h2>
            </div>
            <div class="card" id="analytics-content">
                <p>Đang tải dữ liệu phân tích từ Python...</p>
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <h2 id="modal-title" style="margin-bottom: 24px;">Thêm Sản Phẩm</h2>
            <form id="product-form">
                <input type="hidden" id="prod-id">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" id="prod-name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Giá (VNĐ)</label>
                    <input type="number" id="prod-price" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Hình ảnh sản phẩm</label>
                    <div style="display: flex; gap: 8px;">
                        <input type="url" id="prod-img" class="form-input" placeholder="Link ảnh online https://..." required>
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('prod-img-file').click()" style="padding: 0 16px;"><i class="fas fa-upload"></i> Chọn ảnh</button>
                    </div>
                    <input type="file" id="prod-img-file" style="display: none;" accept="image/*" onchange="handleProductImageUpload(event)">
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea id="prod-desc" class="form-input" rows="3" required></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                    <button type="button" class="btn" onclick="closeProductModal()">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div class="modal" id="orderModal">
        <div class="modal-content">
            <h2 style="margin-bottom: 24px;">Chi Tiết Đơn Hàng</h2>
            <div id="order-detail-content"></div>
            <div style="display: flex; justify-content: flex-end; margin-top: 24px;">
                <button class="btn btn-primary" onclick="document.getElementById('orderModal').style.display='none'">Đóng</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
