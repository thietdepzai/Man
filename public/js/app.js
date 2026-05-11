
// --- Data ---
const defaultProducts = [
    { id: 1, name: "Muối Hồng Himalaya Hạt Lớn", price: 150000, img: "https://images.unsplash.com/photo-1518110924446-24e5d8dce288?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Muối hồng Himalaya tinh khiết khai thác từ mỏ đá muối cổ đại, giữ nguyên khoáng chất tự nhiên." },
    { id: 2, name: "Muối Biển Chấm Hoa Quả", price: 85000, img: "https://images.unsplash.com/photo-1623838421838-89c56fa98c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Muối biển sấy khô kết hợp ớt sừng và tôm khô, vị cay nồng đậm đà." },
    { id: 3, name: "Muối Tiêu Đen Nguyên Hạt", price: 120000, img: "https://images.unsplash.com/photo-1596647248356-0798e945c115?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Sự kết hợp hoàn hảo giữa muối biển và tiêu đen Phú Quốc." },
    { id: 4, name: "Muối Tỏi Thảo Mộc", price: 95000, img: "https://images.unsplash.com/photo-1605335122165-4fcd0339d1b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Muối ướp thịt tuyệt hảo với tỏi sấy và các loại thảo mộc Ý." },
    { id: 5, name: "Muối Truffle Đen", price: 450000, img: "https://images.unsplash.com/photo-1621252178044-f254ee4bc710?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Đỉnh cao ẩm thực với nấm Truffle đen từ Ý xay nhuyễn cùng muối biển." },
    { id: 6, name: "Muối Chanh Vàng", price: 110000, img: "https://images.unsplash.com/photo-1587313632739-c894c2598d9a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Vị chua thanh mát từ vỏ chanh vàng sấy lạnh." },
    { id: 7, name: "Muối Khói Gỗ Sồi", price: 180000, img: "https://images.unsplash.com/photo-1616428751433-f57ec0968df7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Hun khói thủ công bằng gỗ sồi trong 48h, tạo hương vị BBQ đặc trưng." },
    { id: 8, name: "Muối Diêm Mạch", price: 160000, img: "https://images.unsplash.com/photo-1587595431973-160d0d94add1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80", desc: "Giàu protein và khoáng chất, kết hợp hoàn hảo cho chế độ ăn eat clean." }
];

let products = JSON.parse(localStorage.getItem('products'));
if (!products || products.length === 0) {
    products = defaultProducts;
    localStorage.setItem('products', JSON.stringify(products));
}

// --- Global Constants ---
const formatPrice = (price) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);

// --- GSAP Animations ---
function initAnimations() {
    const cursor = document.querySelector('.custom-cursor');
    if(cursor) {
        document.addEventListener('mousemove', (e) => {
            gsap.to(cursor, { x: e.clientX, y: e.clientY, duration: 0.1 });
        });

        document.querySelectorAll('a, button, .product-card, input, select').forEach(el => {
            el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
            el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
        });
    }

    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (header) {
            if (window.scrollY > 50) header.classList.add('scrolled');
            else header.classList.remove('scrolled');
        }
    });

    gsap.utils.toArray('.section').forEach(section => {
        gsap.from(section, {
            scrollTrigger: {
                trigger: section,
                start: "top 80%",
            },
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power2.out"
        });
    });
}

// --- Preloader ---
function initPreloader() {
    const preloader = document.querySelector('.preloader');
    const progress = document.querySelector('.preloader-progress');
    if(!preloader) {
        initAnimations();
        return;
    }
    
    let width = 0;
    const interval = setInterval(() => {
        width += Math.random() * 20;
        if (width >= 100) {
            width = 100;
            clearInterval(interval);
            gsap.to(preloader, { 
                opacity: 0, 
                display: 'none', 
                duration: 1, 
                delay: 0.5,
                onComplete: () => initAnimations()
            });
        }
        progress.style.width = width + '%';
    }, 100);
}

// --- Authentication ---
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
            adminLink = `<a href="${window.routes.admin}"><i class="fas fa-cog"></i> Quản lý</a>`;
        }
        
        container.innerHTML = `
            <div class="user-dropdown">
                <span class="user-greeting" style="font-size: 13px; font-weight: 500; cursor: pointer; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="far fa-user" style="margin-right: 8px;"></i>${user.name}
                </span>
                <div class="user-dropdown-content glass">
                    ${adminLink}
                    <a href="${window.routes.don_hang}"><i class="fas fa-box"></i> Đơn hàng</a>
                    <a href="#" onclick="logoutUser()"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                </div>
            </div>
        `;
    } else {
        container.innerHTML = `<a href="${window.routes.login}" class="auth-trigger"><i class="far fa-user"></i></a>`;
    }
}

window.logoutUser = function() {
    localStorage.removeItem('currentUser');
    window.location = window.routes.home;
}

function initRegister() {
    const form = document.getElementById('register-form');
    if(!form) return;
    form.addEventListener('submit', e => {
        e.preventDefault();
        const name = document.getElementById('reg-name').value;
        const email = document.getElementById('reg-email').value;
        const pass = document.getElementById('reg-pass').value;
        localStorage.setItem('db_user', JSON.stringify({name, email, pass}));
        Swal.fire('Thành công', 'Đăng ký thành công! Vui lòng đăng nhập.', 'success').then(() => {
            window.location = window.routes.login;
        });
    });
}

function initLogin() {
    const form = document.getElementById('login-form');
    if(!form) return;
    form.addEventListener('submit', e => {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const pass = document.getElementById('login-pass').value;
        if(email === 'thiet1234@gmail.com' && pass === 'thiet1234') {
            localStorage.setItem('currentUser', JSON.stringify({name: 'Admin', email: email}));
            Swal.fire('Chào mừng trở lại', 'Đăng nhập trang Quản trị thành công!', 'success').then(() => {
                window.location = window.routes.admin;
            });
            return;
        }
        const dbUser = JSON.parse(localStorage.getItem('db_user'));
        if(dbUser && dbUser.email === email && dbUser.pass === pass) {
            localStorage.setItem('currentUser', JSON.stringify({name: dbUser.name, email: dbUser.email}));
            Swal.fire('Thành công', 'Chào mừng bạn đến với Mặn Salt!', 'success').then(() => {
                window.location = window.routes.home;
            });
        } else {
            Swal.fire('Lỗi', 'Email hoặc mật khẩu không chính xác.', 'error');
        }
    });
}

// --- Cart ---
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById('cart-count');
    if(badge) {
        badge.innerText = count;
        gsap.fromTo(badge, { scale: 1.5 }, { scale: 1, duration: 0.3 });
    }
}

function addToCart(product, qty = 1) {
    const existing = cart.find(item => item.id === product.id);
    if(existing) existing.qty += qty;
    else cart.push({ ...product, qty });
    saveCart();
    
    Toastify({
        text: `Đã thêm ${product.name} vào bộ sưu tập`,
        duration: 4000,
        gravity: "bottom", position: "right",
        style: { background: "var(--accent)", color: "#fff", borderRadius: "0px", fontFamily: "var(--font-body)", fontSize: "13px" }
    }).showToast();
}

// --- Rendering ---
function createProductCard(p) {
    return `
        <a href="${window.routes.san_pham}?id=${p.id}" class="product-card">
            <div class="product-img-wrapper">
                <img src="${p.img}" class="product-img" alt="${p.name}">
                <div class="product-info-overlay">
                    <h3 class="product-title">${p.name}</h3>
                    <p class="product-price">${formatPrice(p.price)}</p>
                </div>
            </div>
            <div style="padding: 20px 0;">
                <h4 style="font-family: var(--font-body); font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 2px; opacity: 0.8; margin-bottom: 5px;">${p.name}</h4>
                <p style="font-size: 14px; color: var(--accent); font-weight: 600;">${formatPrice(p.price)}</p>
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
    new Swiper('.mySwiper', { 
        effect: 'fade', 
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        speed: 1500
    });
}

function initProductDetail() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = parseInt(urlParams.get('id')) || 1;
    const p = products.find(x => x.id === id);
    if(!p) return;
    
    const detailImg = document.getElementById('detail-img');
    const detailTitle = document.getElementById('detail-title');
    const breadcrumbTitle = document.getElementById('breadcrumb-title');
    
    if(detailImg) detailImg.src = p.img;
    if(detailTitle) detailTitle.innerText = p.name;
    if(breadcrumbTitle) breadcrumbTitle.innerText = p.name;
    
    const priceEl = document.getElementById('detail-price');
    const descEl = document.getElementById('detail-desc');
    if(priceEl) priceEl.innerText = formatPrice(p.price);
    if(descEl) descEl.innerText = p.desc;
    
    document.querySelectorAll('.thumb-img').forEach(img => img.src = p.img);
    
    const addBtn = document.getElementById('btn-add-cart');
    if(addBtn) {
        addBtn.addEventListener('click', () => {
            const qty = parseInt(document.getElementById('detail-qty').value) || 1;
            addToCart(p, qty);
        });
    }
}

function renderCartPage() {
    const tbody = document.getElementById('cart-items');
    if(!tbody) return;
    
    if(cart.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 100px; opacity: 0.5;">Giỏ hàng của bạn đang trống.</td></tr>`;
        const totalEl = document.getElementById('cart-total');
        if(totalEl) totalEl.innerText = '0đ';
        return;
    }
    
    let total = 0;
    tbody.innerHTML = cart.map((item, index) => {
        const lineTotal = item.price * item.qty;
        total += lineTotal;
        return `
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 30px 0;">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <img src="${item.img}" style="width: 100px; aspect-ratio: 1/1; object-fit: cover; border-radius: 2px;">
                        <div>
                            <h4 style="font-family: var(--font-body); text-transform: uppercase; font-size: 14px; letter-spacing: 1px;">${item.name}</h4>
                            <p style="font-size: 12px; opacity: 0.5; margin-top: 5px;">Mã SP: MS-00${item.id}</p>
                        </div>
                    </div>
                </td>
                <td style="padding: 30px 0; font-size: 14px;">${formatPrice(item.price)}</td>
                <td style="padding: 30px 0;">
                    <div class="glass" style="display: inline-flex; align-items: center; padding: 5px 10px; border-radius: 2px;">
                        <input type="number" value="${item.qty}" min="1" onchange="updateQty(${index}, this.value)" style="width: 40px; background: none; border: none; color: white; text-align: center; font-family: var(--font-body); font-weight: 600; outline: none;">
                    </div>
                </td>
                <td style="padding: 30px 0; font-weight: 600; font-size: 14px; color: var(--accent);">${formatPrice(lineTotal)}</td>
                <td style="padding: 30px 0; text-align: right;">
                    <button onclick="removeCartItem(${index})" style="background: none; border: none; color: rgba(255,255,255,0.3); cursor: pointer; transition: color 0.3s;"><i class="fas fa-times"></i></button>
                </td>
            </tr>
        `;
    }).join('');
    const totalEl = document.getElementById('cart-total');
    if(totalEl) totalEl.innerText = formatPrice(total);
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

function initCheckoutPage() {
    const container = document.getElementById('checkout-items');
    if(!container) return;
    
    const user = getUser();
    if(user) {
        const nameInp = document.getElementById('chk-name');
        const emailInp = document.getElementById('chk-email');
        if(nameInp) nameInp.value = user.name;
        if(emailInp) emailInp.value = user.email;
    }
    
    if(cart.length === 0) {
        container.innerHTML = "<p style='opacity: 0.5;'>Không có sản phẩm nào để thanh toán.</p>";
        return;
    }
    
    let total = 0;
    container.innerHTML = cart.map(item => {
        total += item.price * item.qty;
        return `
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px;">
                <span style="opacity: 0.7;">${item.name} <strong style="color: white;">x${item.qty}</strong></span>
                <span style="font-weight: 500;">${formatPrice(item.price * item.qty)}</span>
            </div>
        `;
    }).join('');
    const totalEl = document.getElementById('checkout-total');
    if(totalEl) totalEl.innerText = formatPrice(total);
    
    const subBtn = document.getElementById('btn-checkout-submit');
    if(subBtn) {
        subBtn.addEventListener('click', (e) => {
            e.preventDefault();
            processCheckout();
        });
    }
}

function processCheckout() {
    if(cart.length === 0) {
        Swal.fire('Lỗi', 'Giỏ hàng của bạn đang trống.', 'error');
        return;
    }
    const form = document.getElementById('checkout-form');
    if(form && !form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    Swal.fire({
        title: 'Đang xác nhận đơn hàng',
        text: 'Vui lòng chờ trong giây lát',
        background: '#141414',
        color: '#fff',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
    
    setTimeout(() => {
        const user = getUser();
        const orderHistory = JSON.parse(localStorage.getItem('orders')) || [];
        const total = cart.reduce((s, item) => s + (item.price * item.qty), 0);
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
        cart = [];
        saveCart();
        
        Swal.fire({
            title: 'Đặt hàng thành công!',
            text: 'Cảm ơn bạn đã tin tưởng Mặn Salt.',
            icon: 'success',
            background: '#141414',
            color: '#fff'
        }).then(() => {
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
            <div style="text-align: center; padding: 100px;">
                <p style="margin-bottom: 30px; opacity: 0.5;">Vui lòng đăng nhập để xem đơn hàng của bạn.</p>
                <a href="${window.routes.login}" class="btn btn-primary">Đăng Nhập</a>
            </div>
        `;
        return;
    }
    
    const allOrders = JSON.parse(localStorage.getItem('orders')) || [];
    const userOrders = allOrders.filter(o => o.userEmail === user.email).reverse();
    
    if(userOrders.length === 0) {
        container.innerHTML = `<p style="text-align: center; padding: 100px; opacity: 0.5;">Bạn chưa có đơn hàng nào.</p>`;
        return;
    }
    
    container.innerHTML = userOrders.map(order => `
        <div class="glass" style="padding: 40px; margin-bottom: 30px; border-radius: 4px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 30px; border-bottom: 1px solid var(--glass-border); padding-bottom: 20px;">
                <div>
                    <h3 style="font-size: 20px; margin-bottom: 5px;">Mã Đơn: ${order.id}</h3>
                    <p style="font-size: 13px; opacity: 0.4;">${order.date}</p>
                </div>
                <span style="background: var(--accent); color: white; padding: 5px 15px; border-radius: 2px; font-size: 11px; font-weight: 700; text-transform: uppercase; height: fit-content;">${order.status}</span>
            </div>
            <div style="margin-bottom: 30px;">
                ${order.items.map(item => `
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px;">
                        <span style="opacity: 0.7;">${item.name} <strong>x${item.qty}</strong></span>
                        <span>${formatPrice(item.price * item.qty)}</span>
                    </div>
                `).join('')}
            </div>
            <div style="text-align: right; border-top: 1px dashed var(--glass-border); padding-top: 20px;">
                <span style="font-size: 14px; opacity: 0.5; margin-right: 15px;">Tổng giá trị:</span> 
                <span style="font-size: 24px; font-weight: 600; color: var(--accent);">${formatPrice(order.total)}</span>
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
        if(filtered.length === 0) results.innerHTML = "<p style='grid-column: 1/-1; opacity: 0.5; padding: 100px; text-align: center;'>Không tìm thấy sản phẩm phù hợp.</p>";
        else {
            results.innerHTML = filtered.map(createProductCard).join('');
        }
    }
    
    render('');
    input.addEventListener('input', (e) => render(e.target.value));
}

// --- Global Init ---
document.addEventListener('DOMContentLoaded', () => {
    initPreloader();
    updateCartCount();
    renderAuthMenu();
    
    const lenis = new Lenis()
    function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
    requestAnimationFrame(raf);
});
