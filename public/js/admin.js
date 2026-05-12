
const formatPrice = (price) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);

let products = JSON.parse(localStorage.getItem('products')) || [];
let orders = JSON.parse(localStorage.getItem('orders')) || [];

function switchTab(tabId) {
    document.getElementById('tab-dashboard').style.display = 'none';
    document.getElementById('tab-products').style.display = 'none';
    document.getElementById('tab-orders').style.display = 'none';
    document.getElementById('tab-analytics').style.display = 'none';
    
    document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
    event.currentTarget.classList.add('active');
    
    document.getElementById('tab-' + tabId).style.display = 'block';
    
    if(tabId === 'dashboard') renderDashboard();
    if(tabId === 'products') renderProducts();
    if(tabId === 'orders') renderOrders();
    if(tabId === 'analytics') renderAnalytics();
}

function renderAnalytics() {
    const container = document.getElementById('analytics-content');
    fetch('/analysis.json')
    .then(res => res.json())
    .then(data => {
        let html = `<p style="color: var(--text-muted); margin-bottom: 20px;">Cập nhật lần cuối: ${data.last_updated} (Dữ liệu từ Python Script)</p>`;
        
        html += `<div class="grid-3" style="margin-bottom: 30px;">
                    <div class="card" style="background: var(--bg);">
                        <div style="color: #718096">Tổng User Phân Tích</div>
                        <div class="stat-value">${data.general_stats.total_users_analyzed}</div>
                    </div>
                    <div class="card" style="background: var(--bg);">
                        <div style="color: #718096">Tỉ Lệ Giới Tính</div>
                        <div class="stat-value" style="font-size: 20px;">Nam: ${data.general_stats.gender_ratio.nam}% - Nữ: ${data.general_stats.gender_ratio.nu}%</div>
                    </div>
                    <div class="card" style="background: var(--bg);">
                        <div style="color: #718096">Nhóm Tuổi Chính</div>
                        <div class="stat-value" style="font-size: 20px;">18-30: ${data.general_stats.age_groups['18-30']}%</div>
                    </div>
                 </div>`;
                 
        html += `<h3>Xu Hướng Sở Thích Theo Khách Hàng</h3>
                 <table style="margin-top: 16px;">
                     <thead><tr><th>Nhóm Khách Hàng</th><th>Sản Phẩm Yêu Thích</th><th>Lý Do Phân Tích</th></tr></thead>
                     <tbody>`;
                     
        for(const key in data.demographics) {
            const row = data.demographics[key];
            html += `<tr>
                        <td style="font-weight: 500;">${row.desc}</td>
                        <td style="color: var(--admin-accent); font-weight: 600;">${row.top_product_name}</td>
                        <td style="color: #718096;">${row.reason}</td>
                     </tr>`;
        }
        html += `</tbody></table>`;
        container.innerHTML = html;
    })
    .catch(err => {
        container.innerHTML = `<p style="color: red;">Lỗi khi tải dữ liệu phân tích. Hãy chắc chắn rằng bạn đã chạy file analyze_data.py</p>`;
    });
}

function renderDashboard() {
    // --- Doanh thu ---
    const totalRevenue = orders.filter(o => o.status === 'Hoàn thành').reduce((sum, o) => sum + o.total, 0);
    document.getElementById('stat-revenue').innerText = formatPrice(totalRevenue);

    // --- Tổng đơn hàng ---
    document.getElementById('stat-orders').innerText = orders.length;

    // --- Đang xử lý ---
    const processing = orders.filter(o => o.status === 'Đang xử lý').length;
    document.getElementById('stat-processing').innerText = processing;

    // --- Đang giao ---
    const shipping = orders.filter(o => o.status === 'Đang giao').length;
    document.getElementById('stat-shipping').innerText = shipping;

    // --- Sản phẩm hiện có ---
    document.getElementById('stat-products').innerText = products.length;

    // --- Tính sản phẩm mua nhiều nhất / ít nhất ---
    const salesMap = {};
    orders.forEach(o => {
        if(o.items) {
            o.items.forEach(item => {
                const key = item.name || item.id;
                salesMap[key] = (salesMap[key] || 0) + (item.qty || 1);
            });
        }
    });

    const salesEntries = Object.entries(salesMap); // [ [name, qty], ... ]
    if(salesEntries.length > 0) {
        salesEntries.sort((a, b) => b[1] - a[1]);
        const best = salesEntries[0];
        const worst = salesEntries[salesEntries.length - 1];

        document.getElementById('stat-best-product').innerText = best[0];
        document.getElementById('stat-best-qty').innerText = `Đã bán: ${best[1]} sản phẩm`;
        document.getElementById('stat-worst-product').innerText = worst[0];
        document.getElementById('stat-worst-qty').innerText = `Đã bán: ${worst[1]} sản phẩm`;
    } else {
        document.getElementById('stat-best-product').innerText = '—';
        document.getElementById('stat-best-qty').innerText = 'Chưa có dữ liệu';
        document.getElementById('stat-worst-product').innerText = '—';
        document.getElementById('stat-worst-qty').innerText = 'Chưa có dữ liệu';
    }

    // --- Lượt xem cao nhất ---
    const viewCounts = JSON.parse(localStorage.getItem('productViews')) || {};
    const viewEntries = Object.entries(viewCounts); // [ [productId, views], ... ]
    if(viewEntries.length > 0) {
        viewEntries.sort((a, b) => b[1] - a[1]);
        const topView = viewEntries[0];
        const topProduct = products.find(p => String(p.id) === String(topView[0]));
        document.getElementById('stat-most-viewed').innerText = topProduct ? topProduct.name : `SP #${topView[0]}`;
        document.getElementById('stat-most-viewed-count').innerText = `${topView[1]} lượt xem`;
    } else {
        document.getElementById('stat-most-viewed').innerText = '—';
        document.getElementById('stat-most-viewed-count').innerText = 'Chưa có dữ liệu';
    }

    // --- Đơn hàng gần đây ---
    const recent = [...orders].reverse().slice(0, 5);
    const tbody = document.getElementById('recent-orders-table');
    tbody.innerHTML = recent.map(o => `
        <tr>
            <td><strong>${o.id}</strong></td>
            <td>${o.userEmail}</td>
            <td style="font-weight: 600;">${formatPrice(o.total)}</td>
            <td><span class="badge ${o.status === 'Hoàn thành' ? 'badge-success' : o.status === 'Đang giao' ? 'badge-shipping' : 'badge-pending'}">${o.status}</span></td>
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

// ============================================
// IMAGE UPLOAD HANDLING
// ============================================

let currentImageUrl = ''; // Lưu URL ảnh hiện tại (từ upload hoặc URL thủ công)

function resetImageState() {
    currentImageUrl = '';
    document.getElementById('prod-img').value = '';
    document.getElementById('prod-img-file').value = '';
    document.getElementById('prod-img-url').value = '';
    document.getElementById('prod-img-preview').style.display = 'none';
    document.getElementById('upload-progress').style.display = 'none';
    document.getElementById('upload-progress-bar').style.width = '0%';
}

function showImagePreview(url) {
    const preview = document.getElementById('prod-img-preview');
    const previewImg = document.getElementById('prod-img-preview-img');
    previewImg.src = url;
    previewImg.onload = () => { preview.style.display = 'block'; };
    previewImg.onerror = () => { preview.style.display = 'none'; };
}

window.removeImage = function() {
    resetImageState();
}

// Upload file lên server
function uploadImageFile(file) {
    if (!file || !file.type.startsWith('image/')) {
        Swal.fire('Lỗi', 'Vui lòng chọn file ảnh hợp lệ', 'error');
        return;
    }
    if (file.size > 5 * 1024 * 1024) {
        Swal.fire('Lỗi', 'File ảnh quá lớn (tối đa 5MB)', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('image', file);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Hiển thị progress
    const progressDiv = document.getElementById('upload-progress');
    const progressBar = document.getElementById('upload-progress-bar');
    const statusText = document.getElementById('upload-status');
    progressDiv.style.display = 'block';
    progressBar.style.width = '20%';
    statusText.textContent = 'Đang tải lên...';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/admin/upload', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const pct = Math.round((e.loaded / e.total) * 90);
            progressBar.style.width = pct + '%';
        }
    };

    xhr.onload = function() {
        progressBar.style.width = '100%';
        try {
            const result = JSON.parse(xhr.responseText);
            if (xhr.status === 200 && result.success) {
                currentImageUrl = result.url;
                document.getElementById('prod-img').value = result.url;
                statusText.textContent = '✓ Tải lên thành công!';
                statusText.style.color = '#48bb78';
                showImagePreview(result.url);
                setTimeout(() => { progressDiv.style.display = 'none'; }, 1500);
            } else {
                statusText.textContent = '✗ ' + (result.message || 'Upload thất bại');
                statusText.style.color = '#e53e3e';
            }
        } catch (e) {
            statusText.textContent = '✗ Lỗi kết nối server';
            statusText.style.color = '#e53e3e';
        }
    };

    xhr.onerror = function() {
        statusText.textContent = '✗ Lỗi kết nối server';
        statusText.style.color = '#e53e3e';
    };

    xhr.send(formData);
}

// --- Drop zone: click to select ---
document.getElementById('upload-drop-zone').addEventListener('click', function() {
    document.getElementById('prod-img-file').click();
});

// --- File input change ---
document.getElementById('prod-img-file').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        uploadImageFile(this.files[0]);
    }
});

// --- Drag & Drop ---
const dropZone = document.getElementById('upload-drop-zone');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = 'var(--admin-accent)';
    this.style.background = 'rgba(255,255,255,0.08)';
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = 'rgba(255,255,255,0.2)';
    this.style.background = 'rgba(255,255,255,0.03)';
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = 'rgba(255,255,255,0.2)';
    this.style.background = 'rgba(255,255,255,0.03)';
    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
        uploadImageFile(e.dataTransfer.files[0]);
    }
});

// --- URL input fallback ---
document.getElementById('prod-img-url').addEventListener('input', function() {
    const url = this.value.trim();
    if (url && (url.startsWith('http://') || url.startsWith('https://'))) {
        currentImageUrl = url;
        document.getElementById('prod-img').value = url;
        showImagePreview(url);
    } else {
        if (!document.getElementById('prod-img').value) {
            document.getElementById('prod-img-preview').style.display = 'none';
        }
    }
});

// ============================================
// PRODUCT MODAL
// ============================================

function openProductModal() {
    document.getElementById('product-form').reset();
    document.getElementById('prod-id').value = '';
    document.getElementById('modal-title').innerText = 'Thêm Sản Phẩm';
    resetImageState();
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
    const desc = document.getElementById('prod-desc').value;

    // Lấy URL ảnh từ hidden input hoặc currentImageUrl
    let img = document.getElementById('prod-img').value || currentImageUrl;

    // Nếu đang edit và không chọn ảnh mới → giữ ảnh cũ
    if (id && !img) {
        const existing = products.find(x => x.id == id);
        if (existing) img = existing.img;
    }

    if (!id && !img) {
        Swal.fire('Thiếu ảnh', 'Vui lòng chọn ảnh hoặc dán link ảnh cho sản phẩm', 'warning');
        return;
    }

    if (id) {
        const p = products.find(x => x.id == id);
        p.name = name; p.price = price; p.img = img; p.desc = desc;
        Swal.fire('Thành công', 'Cập nhật sản phẩm thành công', 'success');
    } else {
        const newId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
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
    document.getElementById('prod-desc').value = p.desc;
    document.getElementById('modal-title').innerText = 'Sửa Sản Phẩm';

    // Reset image state rồi set lại ảnh cũ
    resetImageState();
    if (p.img) {
        currentImageUrl = p.img;
        document.getElementById('prod-img').value = p.img;
        showImagePreview(p.img);
    }

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
