
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

function openProductModal() {
    document.getElementById('product-form').reset();
    document.getElementById('prod-id').value = '';
    document.getElementById('modal-title').innerText = 'Thêm Sản Phẩm';
    document.getElementById('prod-img').value = '';
    document.getElementById('prod-img-url').value = '';
    document.getElementById('prod-img-preview').style.display = 'none';
    document.getElementById('productModal').style.display = 'flex';
}

document.getElementById('prod-img').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewDiv = document.getElementById('prod-img-preview');
    const previewImg = document.getElementById('prod-img-preview-img');
    
    // Xóa URL ảnh đã chọn từ Kho khi chọn file mới từ máy
    document.getElementById('prod-img-url').value = '';
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewDiv.style.display = 'none';
        previewImg.src = '';
    }
});

function closeProductModal() {
    document.getElementById('productModal').style.display = 'none';
}

document.getElementById('product-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const id = document.getElementById('prod-id').value;
    const name = document.getElementById('prod-name').value;
    const price = parseInt(document.getElementById('prod-price').value);
    const desc = document.getElementById('prod-desc').value;
    
    let imgPath = document.getElementById('prod-img-url').value; // Lấy từ url kho ảnh nếu có
    const imgFile = document.getElementById('prod-img').files[0];
    
    // Nếu có file ảnh mới tải lên từ máy thì ưu tiên upload
    if (imgFile) {
        const formData = new FormData();
        formData.append('image', imgFile);
        
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch('/admin/upload', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            if (!response.ok) {
                let errorMsg = 'Lỗi máy chủ';
                try {
                    const errorData = await response.json();
                    errorMsg = errorData.message || (errorData.errors ? Object.values(errorData.errors)[0][0] : 'Lỗi máy chủ');
                } catch(e) {
                    errorMsg = 'Lỗi server (Mã: ' + response.status + ')';
                }
                Swal.fire('Lỗi', errorMsg, 'error');
                return;
            }

            const data = await response.json();
            if (data.success) {
                imgPath = data.url;
            } else {
                Swal.fire('Lỗi', data.message || 'Lỗi tải ảnh lên', 'error');
                return;
            }
        } catch (error) {
            console.error(error);
            Swal.fire('Lỗi', 'Không thể kết nối đến server hoặc lỗi mạng', 'error');
            return;
        }
    }
    
    if(id) {
        // Edit
        const p = products.find(x => x.id == id);
        p.name = name; p.price = price; p.desc = desc;
        if (imgPath) p.img = imgPath; // Nếu có ảnh mới thì cập nhật, không thì giữ nguyên
        Swal.fire('Thành công', 'Cập nhật sản phẩm thành công', 'success');
    } else {
        // Add
        if (!imgPath) {
            Swal.fire('Lỗi', 'Vui lòng chọn ảnh hoặc tải ảnh lên', 'error');
            return;
        }
        const newId = products.length > 0 ? Math.max(...products.map(p=>p.id)) + 1 : 1;
        products.push({ id: newId, name, price, img: imgPath, desc });
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
    // Không gán .value cho input type="file", thay vào đó xóa giá trị cũ và chỉ bắt buộc tải ảnh mới khi thêm mới
    document.getElementById('prod-img').value = '';
    document.getElementById('prod-img-url').value = p.img || ''; 
    document.getElementById('prod-desc').value = p.desc;
    document.getElementById('modal-title').innerText = 'Sửa Sản Phẩm';
    
    // Hiển thị ảnh preview nếu có
    const previewDiv = document.getElementById('prod-img-preview');
    const previewImg = document.getElementById('prod-img-preview-img');
    if (p.img) {
        previewImg.src = p.img;
        previewDiv.style.display = 'inline-block';
    } else {
        previewDiv.style.display = 'none';
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

// --- Image URL Preview ---
document.getElementById('prod-img').addEventListener('input', function() {
    const url = this.value.trim();
    const preview = document.getElementById('prod-img-preview');
    const previewImg = document.getElementById('prod-img-preview-img');

    if (url && (url.startsWith('http://') || url.startsWith('https://'))) {
        previewImg.src = url;
        previewImg.onload = () => { preview.style.display = 'block'; };
        previewImg.onerror = () => { preview.style.display = 'none'; };
    } else {
        preview.style.display = 'none';
    }
});

// --- Gallery Functions ---
window.openGalleryModal = async function() {
    document.getElementById('galleryModal').style.display = 'flex';
    const grid = document.getElementById('gallery-grid');
    const loading = document.getElementById('gallery-loading');
    
    grid.innerHTML = '';
    loading.style.display = 'block';
    
    try {
        const response = await fetch('/admin/gallery');
        const data = await response.json();
        
        loading.style.display = 'none';
        
        if (data.success && data.images.length > 0) {
            data.images.forEach(img => {
                const item = document.createElement('div');
                item.style.cursor = 'pointer';
                item.style.borderRadius = '8px';
                item.style.overflow = 'hidden';
                item.style.border = '2px solid transparent';
                item.style.transition = 'border 0.2s';
                
                item.onmouseover = () => item.style.border = '2px solid var(--admin-accent)';
                item.onmouseout = () => item.style.border = '2px solid transparent';
                
                item.onclick = () => selectGalleryImage(img.url);
                
                item.innerHTML = `
                    <div style="background-image: url('${img.url}'); background-size: cover; background-position: center; height: 120px; width: 100%;"></div>
                    <div style="padding: 4px; font-size: 12px; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${img.name}">${img.name}</div>
                `;
                grid.appendChild(item);
            });
        } else {
            grid.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; color: #718096; padding: 40px;">Thư viện trống. Chưa có ảnh nào được tải lên.</div>';
        }
    } catch (error) {
        console.error(error);
        loading.style.display = 'none';
        grid.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; color: red;">Lỗi tải thư viện ảnh.</div>';
    }
}

window.closeGalleryModal = function() {
    document.getElementById('galleryModal').style.display = 'none';
}

window.selectGalleryImage = function(url) {
    document.getElementById('prod-img-url').value = url;
    document.getElementById('prod-img').value = ''; // Xoá file đang chọn nếu có
    
    const previewDiv = document.getElementById('prod-img-preview');
    const previewImg = document.getElementById('prod-img-preview-img');
    
    previewImg.src = url;
    previewDiv.style.display = 'inline-block';
    
    closeGalleryModal();
}

window.handleBulkUpload = async function(e) {
    const files = e.target.files;
    if (!files || files.length === 0) return;

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    const statusText = document.getElementById('bulk-upload-status');
    statusText.style.color = '#4a5568';
    statusText.innerText = 'Đang tải lên ' + files.length + ' ảnh...';

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch('/admin/upload-multiple', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await response.json();
        if (data.success) {
            statusText.style.color = 'green';
            statusText.innerText = 'Tải lên thành công!';
            setTimeout(() => { statusText.innerText = ''; }, 3000);
            
            // Reload the gallery interface
            openGalleryModal();
        } else {
            Swal.fire('Lỗi', data.message || 'Lỗi tải ảnh', 'error');
            statusText.innerText = '';
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Lỗi', 'Không thể kết nối đến server hoặc đường truyền lỗi', 'error');
        statusText.innerText = '';
    }
    
    // Clear the input value so user can upload the same files again if needed
    e.target.value = '';
}
