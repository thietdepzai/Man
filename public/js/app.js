
// --- Data ---
const defaultProducts = [
    { id: 1, name: "Muối Hồng Himalaya Hạt Lớn", price: 150000, img: "https://images.unsplash.com/photo-1518110924446-24e5d8dce288?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Muối hồng Himalaya tinh khiết khai thác từ mỏ đá muối cổ đại, giữ nguyên khoáng chất tự nhiên.", category: "Muối Hồng Himalaya" },
    { id: 2, name: "Muối Biển Chấm Hoa Quả", price: 85000, img: "https://images.unsplash.com/photo-1623838421838-89c56fa98c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Muối biển sấy khô kết hợp ớt sừng và tôm khô, vị cay nồng đậm đà.", category: "Muối Tổng Hợp" },
    { id: 3, name: "Muối Tiêu Đen Nguyên Hạt", price: 120000, img: "https://images.unsplash.com/photo-1596647248356-0798e945c115?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Sự kết hợp hoàn hảo giữa muối biển và tiêu đen Phú Quốc.", category: "Muối Tổng Hợp" },
    { id: 4, name: "Muối Tỏi Thảo Mộc", price: 95000, img: "https://images.unsplash.com/photo-1605335122165-4fcd0339d1b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Muối ướp thịt tuyệt hảo với tỏi sấy và các loại thảo mộc Ý.", category: "Muối Tổng Hợp" },
    { id: 5, name: "Muối Truffle Đen", price: 450000, img: "https://images.unsplash.com/photo-1621252178044-f254ee4bc710?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Đỉnh cao ẩm thực với nấm Truffle đen từ Ý xay nhuyễn cùng muối biển.", category: "Muối Tổng Hợp" },
    { id: 6, name: "Muối Chanh Vàng", price: 110000, img: "https://images.unsplash.com/photo-1587313632739-c894c2598d9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Vị chua thanh mát từ vỏ chanh vàng sấy lạnh.", category: "Muối Tổng Hợp" },
    { id: 7, name: "Muối Khói Gỗ Sồi", price: 180000, img: "https://images.unsplash.com/photo-1616428751433-f57ec0968df7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Hun khói thủ công bằng gỗ sồi trong 48h, tạo hương vị BBQ đặc trưng.", category: "Muối Tổng Hợp" },
    { id: 8, name: "Muối Diêm Mạch", price: 160000, img: "https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80", desc: "Giàu protein và khoáng chất, kết hợp hoàn hảo cho chế độ ăn eat clean.", category: "Muối Tổng Hợp" }
];

let products = JSON.parse(localStorage.getItem('products'));
if (!products || products.length === 0 || !products[0].category || products.some(p => p.category === 'Muối Gia Vị' || p.category === 'Muối Biển Tinh Khiết' || p.category === 'undefined' || !p.category)) {
    products = defaultProducts;
    localStorage.setItem('products', JSON.stringify(products));
}

// --- Authentication Logic ---
function getUser() {
    return JSON.parse(localStorage.getItem('currentUser'));
}

function renderAuthMenu() {
    const user = getUser();
    const container = document.getElementById('user-menu-container');
    if(!container) return;
    
    if(user) {
        let adminLink = '';
        if (user.email === 'thiet1234@gmail.com') {
            adminLink = `<a href="${window.routes.admin}"><i class="fas fa-cog"></i> Quản lý Cửa hàng</a>`;
        }
        
        container.innerHTML = `
            <div class="user-dropdown">
                <span class="user-greeting">Xin chào, ${user.name} <i class="fas fa-chevron-down" style="font-size:10px; margin-left:4px;"></i></span>
                <div class="user-dropdown-content">
                    ${adminLink}
                    <a href="${window.routes.don_hang}"><i class="fas fa-box"></i> Đơn hàng của tôi</a>
                    <a href="#" onclick="logoutUser()"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        `;
    } else {
        container.innerHTML = `<a href="${window.routes.login}"><i class="far fa-user"></i></a>`;
    }
}

window.logoutUser = function() {
    localStorage.removeItem('currentUser');
    window.location = window.routes.home;
}

function initRegister() {
    document.getElementById('register-form').addEventListener('submit', e => {
        e.preventDefault();
        const name = document.getElementById('reg-name').value;
        const email = document.getElementById('reg-email').value;
        const pass = document.getElementById('reg-pass').value;
        
        // Save to fake DB
        localStorage.setItem('db_user', JSON.stringify({name, email, pass}));
        
        Swal.fire({title:'Thành công',text:'Đăng ký thành công! Vui lòng đăng nhập.',icon:'success',background:'#1c1917',color:'#fafaf9',confirmButtonColor:'#f59e0b'}).then(() => {
            window.location = window.routes.login;
        });
    });
}

function initLogin() {
    document.getElementById('login-form').addEventListener('submit', e => {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const pass = document.getElementById('login-pass').value;
        
        // Admin hardcoded check
        if(email === 'thiet1234@gmail.com' && pass === 'thiet1234') {
            localStorage.setItem('currentUser', JSON.stringify({name: 'Admin', email: email}));
            Swal.fire({title:'Thành công',text:'Đăng nhập trang Quản trị thành công!',icon:'success',background:'#1c1917',color:'#fafaf9',confirmButtonColor:'#f59e0b'}).then(() => {
                window.location = window.routes.admin;
            });
            return;
        }

        const dbUser = JSON.parse(localStorage.getItem('db_user'));
        
        if(dbUser && dbUser.email === email && dbUser.pass === pass) {
            localStorage.setItem('currentUser', JSON.stringify({name: dbUser.name, email: dbUser.email}));
            Swal.fire({title:'Thành công',text:'Đăng nhập thành công!',icon:'success',background:'#1c1917',color:'#fafaf9',confirmButtonColor:'#f59e0b'}).then(() => {
                window.location = window.routes.home;
            });
        } else {
            Swal.fire({title:'Lỗi',text:'Email hoặc mật khẩu không chính xác. Xin hãy đăng ký trước!',icon:'error',background:'#1c1917',color:'#fafaf9',confirmButtonColor:'#f59e0b'});
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
        text: `✓ Đã thêm ${product.name} vào giỏ`,
        duration: 3000,
        gravity: "bottom", position: "right",
        style: { background: "#1c1917", color: "#fafaf9", borderRadius: "12px", border: "1px solid rgba(245,158,11,0.3)", boxShadow: "0 8px 32px rgba(0,0,0,0.4)", padding: "14px 24px", fontFamily: "Inter, sans-serif", fontSize: "14px" }
    }).showToast();
}

const formatPrice = (price) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);

// --- Render Functions ---
function createProductCard(p) {
    return `
        <a href="${window.routes.san_pham}?id=${p.id}" class="product-card">
            <div style="overflow:hidden;">
                <img src="${p.img}" class="product-img" alt="${p.name}" loading="lazy">
            </div>
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

// --- Pagination and Category Logic ---
let currentCategory = 'all';
let currentPage = 1;
const itemsPerPage = 4; // Display 4 items per page to show pages 1 and 2

function initCatalog() {
    const categories = ['all', ...new Set(products.map(p => p.category))];
    const catList = document.getElementById('category-list');
    
    if (catList) {
        catList.innerHTML = categories.map(cat => {
            const label = cat === 'all' ? 'Tất cả' : cat;
            return `<li><a href="#" onclick="setCategory('${cat}'); return false;" style="display:block;padding:12px 16px;border-radius:var(--radius-sm);color:var(--text-secondary);transition:all 0.2s;font-size:14px;" onmouseover="this.style.background='var(--bg-glass-hover)';this.style.color='var(--text-primary)'" onmouseout="if(currentCategory !== '${cat}') { this.style.background='';this.style.color='var(--text-secondary)' }" class="cat-link" data-cat="${cat}">${label}</a></li>`;
        }).join('');
    }
    
    renderCatalog();
}

function setCategory(cat) {
    currentCategory = cat;
    currentPage = 1;
    renderCatalog();
}

function setPage(page) {
    currentPage = page;
    renderCatalog();
}

function renderCatalog() {
    // Highlight active category
    document.querySelectorAll('.cat-link').forEach(el => {
        if (el.getAttribute('data-cat') === currentCategory) {
            el.style.background = 'var(--bg-glass-hover)';
            el.style.color = 'var(--text-primary)';
        } else {
            el.style.background = '';
            el.style.color = 'var(--text-secondary)';
        }
    });

    const filtered = currentCategory === 'all' ? products : products.filter(p => p.category === currentCategory);
    
    // Pagination
    const totalPages = Math.ceil(filtered.length / itemsPerPage);
    const startIdx = (currentPage - 1) * itemsPerPage;
    const paginatedItems = filtered.slice(startIdx, startIdx + itemsPerPage);
    
    const container = document.getElementById('all-products');
    if (container) {
        if (paginatedItems.length === 0) {
            container.innerHTML = '<p style="text-align:center;grid-column:1/-1;">Không tìm thấy sản phẩm nào.</p>';
        } else {
            container.innerHTML = paginatedItems.map(createProductCard).join('');
        }
    }
    
    // Render pagination controls
    const pagContainer = document.getElementById('pagination-controls');
    if (pagContainer) {
        let pagHtml = '';
        if (totalPages > 1) {
            for (let i = 1; i <= totalPages; i++) {
                const activeStyle = i === currentPage ? 'background:var(--accent);color:var(--bg-primary);' : 'background:transparent;color:var(--text-primary);border:1px solid var(--border);';
                pagHtml += `<button onclick="setPage(${i})" style="width:36px;height:36px;border-radius:var(--radius-sm);cursor:pointer;font-weight:600;${activeStyle}">${i}</button>`;
            }
        }
        pagContainer.innerHTML = pagHtml;
    }
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
                window.location = window.routes.login;
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
        Swal.fire({title:'Lỗi',text:'Giỏ hàng trống!',icon:'error',background:'#1c1917',color:'#fafaf9',confirmButtonColor:'#f59e0b'});
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
        
        Swal.fire({title:'Thành công!',text:'Đơn hàng của bạn đã được đặt thành công.',icon:'success',background:'#1c1917',color:'#fafaf9',confirmButtonColor:'#f59e0b'}).then(() => {
            window.location = user ? window.routes.don_hang : window.routes.home;
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
