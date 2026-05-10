import os

CSS_CONTENT = """
:root {
  --admin-bg: #f4f7f6;
  --admin-surface: #ffffff;
  --admin-text: #333333;
  --admin-primary: #17191b;
  --admin-accent: #ba1a1a;
  --admin-border: #e2e8f0;
}
body { margin: 0; font-family: 'Inter', sans-serif; background: var(--admin-bg); color: var(--admin-text); display: flex; height: 100vh; overflow: hidden; }
.sidebar { width: 260px; background: var(--admin-primary); color: white; display: flex; flex-direction: column; }
.sidebar-header { padding: 24px; font-family: 'Playfair Display', serif; font-size: 28px; font-weight: bold; border-bottom: 1px solid rgba(255,255,255,0.1); }
.nav-item { padding: 16px 24px; color: #a0aec0; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 12px; font-weight: 500; }
.nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.1); color: white; border-left: 4px solid var(--admin-accent); padding-left: 20px;}
.main-content { flex: 1; padding: 40px; overflow-y: auto; }
.header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
.header h2 { font-size: 28px; font-family: 'Playfair Display', serif; margin: 0; }
.card { background: var(--admin-surface); border-radius: 8px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 24px; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.stat-value { font-size: 32px; font-weight: bold; color: var(--admin-primary); margin-top: 8px; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 16px; text-align: left; border-bottom: 1px solid var(--admin-border); vertical-align: middle; }
th { color: #718096; font-weight: 500; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;}
.badge { padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; }
.badge-pending { background: #fefcbf; color: #b7791f; }
.badge-success { background: #c6f6d5; color: #22543d; }
.btn { padding: 12px 24px; border-radius: 4px; border: none; cursor: pointer; font-weight: 600; transition: 0.2s;}
.btn-primary { background: var(--admin-primary); color: white; }
.btn-primary:hover { background: #333; }
.btn-small { padding: 8px 16px; font-size: 12px; }
.action-btn { background: none; border: none; cursor: pointer; font-size: 18px; margin-right: 12px; transition: 0.2s;}
.edit-btn { color: #3182ce; } .edit-btn:hover { color: #2b6cb0; }
.delete-btn { color: #e53e3e; } .delete-btn:hover { color: #c53030; }
.view-btn { color: #38a169; } .view-btn:hover { color: #2f855a; }
.modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000; }
.modal-content { background: white; padding: 32px; border-radius: 8px; width: 500px; max-width: 90%; max-height: 90vh; overflow-y: auto;}
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px;}
.form-input { width: 100%; padding: 12px; border: 1px solid var(--admin-border); border-radius: 4px; box-sizing: border-box; font-family: 'Inter';}
.form-input:focus { outline: none; border-color: var(--admin-primary); }
.product-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid var(--admin-border);}
"""

JS_CONTENT = """
const formatPrice = (price) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);

let products = JSON.parse(localStorage.getItem('products')) || [];
let orders = JSON.parse(localStorage.getItem('orders')) || [];

function switchTab(tabId) {
    document.getElementById('tab-dashboard').style.display = 'none';
    document.getElementById('tab-products').style.display = 'none';
    document.getElementById('tab-orders').style.display = 'none';
    
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    event.currentTarget.classList.add('active');
    
    document.getElementById('tab-' + tabId).style.display = 'block';
    
    if(tabId === 'dashboard') renderDashboard();
    if(tabId === 'products') renderProducts();
    if(tabId === 'orders') renderOrders();
}

function renderDashboard() {
    const totalRevenue = orders.filter(o => o.status === 'Hoàn thành').reduce((sum, o) => sum + o.total, 0);
    document.getElementById('stat-revenue').innerText = formatPrice(totalRevenue);
    document.getElementById('stat-orders').innerText = orders.length;
    document.getElementById('stat-products').innerText = products.length;
    
    const recent = [...orders].reverse().slice(0, 5);
    const tbody = document.getElementById('recent-orders-table');
    tbody.innerHTML = recent.map(o => `
        <tr>
            <td><strong>${o.id}</strong></td>
            <td>${o.userEmail}</td>
            <td style="font-weight: 600;">${formatPrice(o.total)}</td>
            <td><span class="badge ${o.status === 'Hoàn thành' ? 'badge-success' : 'badge-pending'}">${o.status}</span></td>
        </tr>
    `).join('');
}

function renderProducts() {
    const tbody = document.getElementById('products-table');
    tbody.innerHTML = products.map(p => `
        <tr>
            <td><img src="${p.img}" class="product-thumb"></td>
            <td style="font-weight: 500;">${p.name}</td>
            <td style="color: var(--admin-accent); font-weight: 600;">${formatPrice(p.price)}</td>
            <td>
                <button class="action-btn edit-btn" onclick="editProduct(${p.id})"><i class="fas fa-edit"></i></button>
                <button class="action-btn delete-btn" onclick="deleteProduct(${p.id})"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
    `).join('');
}

function renderOrders() {
    const tbody = document.getElementById('orders-table');
    tbody.innerHTML = [...orders].reverse().map((o, index) => {
        const realIndex = orders.length - 1 - index;
        return `
        <tr>
            <td><strong>${o.id}</strong></td>
            <td>${o.date}</td>
            <td>${o.userEmail}</td>
            <td style="font-weight: 600;">${formatPrice(o.total)}</td>
            <td><span class="badge ${o.status === 'Hoàn thành' ? 'badge-success' : 'badge-pending'}">${o.status}</span></td>
            <td>
                <button class="action-btn view-btn" onclick="viewOrder(${realIndex})"><i class="fas fa-eye"></i></button>
                ${o.status !== 'Hoàn thành' ? `<button class="btn btn-primary btn-small" onclick="completeOrder(${realIndex})">Duyệt</button>` : ''}
            </td>
        </tr>
    `}).join('');
}

function openProductModal() {
    document.getElementById('product-form').reset();
    document.getElementById('prod-id').value = '';
    document.getElementById('modal-title').innerText = 'Thêm Sản Phẩm';
    document.getElementById('productModal').style.display = 'flex';
}

function closeProductModal() {
    document.getElementById('productModal').style.display = 'none';
}

document.getElementById('product-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('prod-id').value;
    const name = document.getElementById('prod-name').value;
    const price = parseInt(document.getElementById('prod-price').value);
    const img = document.getElementById('prod-img').value;
    const desc = document.getElementById('prod-desc').value;
    
    if(id) {
        // Edit
        const p = products.find(x => x.id == id);
        p.name = name; p.price = price; p.img = img; p.desc = desc;
        Swal.fire('Thành công', 'Cập nhật sản phẩm thành công', 'success');
    } else {
        // Add
        const newId = products.length > 0 ? Math.max(...products.map(p=>p.id)) + 1 : 1;
        products.push({ id: newId, name, price, img, desc });
        Swal.fire('Thành công', 'Thêm sản phẩm thành công', 'success');
    }
    
    localStorage.setItem('products', JSON.stringify(products));
    closeProductModal();
    renderProducts();
    renderDashboard();
});

window.editProduct = function(id) {
    const p = products.find(x => x.id == id);
    document.getElementById('prod-id').value = p.id;
    document.getElementById('prod-name').value = p.name;
    document.getElementById('prod-price').value = p.price;
    document.getElementById('prod-img').value = p.img;
    document.getElementById('prod-desc').value = p.desc;
    document.getElementById('modal-title').innerText = 'Sửa Sản Phẩm';
    document.getElementById('productModal').style.display = 'flex';
}

window.deleteProduct = function(id) {
    Swal.fire({
        title: 'Xóa sản phẩm?',
        text: "Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e53e3e',
        confirmButtonText: 'Xóa ngay',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            products = products.filter(x => x.id != id);
            localStorage.setItem('products', JSON.stringify(products));
            renderProducts();
            renderDashboard();
            Swal.fire('Đã xóa!', 'Sản phẩm đã bị xóa.', 'success');
        }
    });
}

window.viewOrder = function(index) {
    const o = orders[index];
    let html = `
        <p><strong>Mã đơn:</strong> ${o.id}</p>
        <p><strong>Khách hàng:</strong> ${o.userEmail}</p>
        <p><strong>Ngày đặt:</strong> ${o.date}</p>
        <hr style="margin: 16px 0; border: none; border-top: 1px solid var(--admin-border);">
        <h4>Sản phẩm:</h4>
        <ul style="padding-left: 20px; margin-top: 8px; line-height: 1.8;">
    `;
    o.items.forEach(item => {
        html += `<li>${item.name} x ${item.qty} = ${formatPrice(item.price * item.qty)}</li>`;
    });
    html += `</ul>
        <h3 style="margin-top: 16px; color: var(--admin-accent);">Tổng: ${formatPrice(o.total)}</h3>
    `;
    document.getElementById('order-detail-content').innerHTML = html;
    document.getElementById('orderModal').style.display = 'flex';
}

window.completeOrder = function(index) {
    orders[index].status = 'Hoàn thành';
    localStorage.setItem('orders', JSON.stringify(orders));
    renderOrders();
    renderDashboard();
    Swal.fire('Thành công', 'Đã duyệt đơn hàng!', 'success');
}

// Init
document.addEventListener('DOMContentLoaded', () => {
    renderDashboard();
});
"""

BLADE_CONTENT = """
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
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
        <div style="margin-top: auto; padding: 24px;">
            <a href="{{ route('home') }}" style="color: #a0aec0; text-decoration: none;"><i class="fas fa-arrow-left"></i> Về trang mua sắm</a>
        </div>
    </div>
    <div class="main-content">
        <div id="tab-dashboard">
            <div class="header">
                <h2>Tổng Quan</h2>
            </div>
            <div class="grid-3">
                <div class="card">
                    <div style="color: #718096">Tổng doanh thu (Đã duyệt)</div>
                    <div class="stat-value" id="stat-revenue">0đ</div>
                </div>
                <div class="card">
                    <div style="color: #718096">Tổng đơn hàng</div>
                    <div class="stat-value" id="stat-orders">0</div>
                </div>
                <div class="card">
                    <div style="color: #718096">Sản phẩm hiện có</div>
                    <div class="stat-value" id="stat-products">0</div>
                </div>
            </div>
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
                    <label>URL Hình ảnh (Link ảnh online)</label>
                    <input type="url" id="prod-img" class="form-input" placeholder="https://..." required>
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
"""

def build():
    os.chdir('c:/Users/thiet/Man-Store')
    
    with open('public/css/admin.css', 'w', encoding='utf-8') as f:
        f.write(CSS_CONTENT)
        
    with open('public/js/admin.js', 'w', encoding='utf-8') as f:
        f.write(JS_CONTENT)
        
    with open('resources/views/admin.blade.php', 'w', encoding='utf-8') as f:
        f.write(BLADE_CONTENT)
        
    # Append route to web.php
    with open('routes/web.php', 'a', encoding='utf-8') as f:
        f.write("Route::get('/admin', function () {\n    return view('admin');\n})->name('admin');\n")
        
    # Modify public/js/app.js to use localStorage for products
    with open('public/js/app.js', 'r', encoding='utf-8') as f:
        app_js = f.read()
        
    # Find the const products = [ ... ]; and replace it
    # We will just replace "const products = [" with "let defaultProducts = [" 
    # and add initialization logic
    if "const products = [" in app_js:
        app_js = app_js.replace("const products = [", "const defaultProducts = [")
        init_logic = """
let products = JSON.parse(localStorage.getItem('products'));
if (!products || products.length === 0) {
    products = defaultProducts;
    localStorage.setItem('products', JSON.stringify(products));
}
"""
        app_js = app_js.replace("];\n\n// --- Authentication Logic ---", "];\n" + init_logic + "\n// --- Authentication Logic ---")
        
        with open('public/js/app.js', 'w', encoding='utf-8') as f:
            f.write(app_js)
            
    print("Admin dashboard installed successfully.")

if __name__ == "__main__":
    build()
