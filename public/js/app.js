
// --- Data ---
const defaultProducts = [
    { id: 1, name: "Muối Himalaya Nấm Truffle", price: 350000, img: "/images/muoi-himalaya-nam-truffle.jpg", desc: "Sự kết hợp tinh tế giữa muối hồng Himalaya nguyên bản và nấm Truffle đen hảo hạng (Hạt mịn - 8 oz). Tôn lên hương vị quyến rũ và sang trọng cho các món bít tết, hải sản." },
    { id: 2, name: "Muối Himalaya", price: 120000, img: "/images/muoi-himalaya.jpg", desc: "Khai thác từ mỏ đá muối Himalaya cổ đại, tinh khiết 100% không pha tạp chất, giữ nguyên hơn 80 loại khoáng chất quý giá (Hạt mịn - 8 oz)." },
    { id: 3, name: "Muối Biển Trắng", price: 80000, img: "/images/muoi-bien-trang.jpg", desc: "Muối biển sạch sấy khô tự nhiên, hạt mịn, vị mặn dịu thanh khiết, là gia vị không thể thiếu để nêm nếm các bữa ăn gia đình hằng ngày (Hạt mịn - 8 oz)." },
    { id: 4, name: "Muối Diêm Mạch", price: 150000, img: "/images/muoi-diem-mach.jpg", desc: "Hương vị diêm mạch độc đáo, giàu dinh dưỡng, tự nhiên. Lựa chọn hoàn hảo cho chế độ ăn kiêng (Eat Clean) cân bằng khoáng chất (Khối lượng 226g / 8 oz)." },
    { id: 5, name: "Muối Khói Gỗ Sồi", price: 180000, img: "/images/muoi-khoi-go-soi.jpg", desc: "Hương vị khói gỗ sồi đậm đà, độc đáo, cao cấp. Được hun khói thủ công, đem lại sự bùng nổ hương thơm BBQ cho món nướng (Khối lượng 226g / 8 oz)." },
    { id: 6, name: "Muối Biển Tỏi", price: 110000, img: "/images/muoi-bien-toi.jpg", desc: "Hương vị nồng nàn, đậm đà từ muối biển nguyên chất ngâm ủ cùng tỏi tự nhiên, giúp đánh thức hương vị của mọi món ăn (Khối lượng 226g / 8 oz)." },
    { id: 7, name: "Muối Chanh Vàng", price: 130000, img: "/images/muoi-chanh-vang.jpg", desc: "Hương vị chanh tươi thơm ngon, độc đáo. Rất nhẹ nhàng, thanh mát, là sự lựa chọn tuyệt vời cho các món hải sản và salad (Khối lượng 226g / 8 oz)." },
    { id: 8, name: "Muối Nấm Truffle Đen", price: 280000, img: "/images/muoi-nam-truffle-den.jpg", desc: "Dòng muối biển kết hợp nấm Truffle đen đặc trưng. Bí quyết nâng tầm hương vị cao cấp, quyến rũ cho gian bếp nhà bạn (Hạt mịn - 8 oz)." },
    { id: 9, name: "Muối Tre Việt Nam", price: 165000, img: "/images/muoi-tre-viet-nam.jpg", desc: "Đặc sản Việt Nam. Trải qua quy trình nung trong ống tre, mang lại hương vị độc đáo, giúp cân bằng độ pH cơ thể và rất tốt cho sức khỏe (Khối lượng 226g / 8 oz)." },
    { id: 10, name: "Muối Biển Hạt To", price: 75000, img: "/images/muoi-bien-hat-to.jpg", desc: "Mang đậm hương vị biển tự nhiên. Hạt to trong suốt, giữ trọn khoáng chất cốt lõi, không chứa chất bảo quản (Khối lượng 226g / 8 oz)." },
    { id: 11, name: "Muối Kiến Vàng", price: 190000, img: "/images/muoi-kien-vang.jpg", desc: "Đặc sản vùng đất Phú Yên. Hương vị độc đáo kết hợp tuyệt vời. Chấm với thịt nướng hay hải sản là ghiền ngay lập tức (Khối lượng 226g / 8 oz)." },
    { id: 12, name: "Muối Hảo Hảo", price: 50000, img: "/images/muoi-hao-hao.jpg", desc: "Hương vị tôm chua cay truyền thống Việt. Sức hấp dẫn không thể chối từ, quen thuộc nhưng vẫn độc đáo, tự nhiên (Khối lượng 226g / 8 oz)." },
    { id: 13, name: "Muối Tiêu Đen Nguyên Hạt", price: 140000, img: "/images/muoi-tieu-den-nguyen-hat.jpg", desc: "Hương vị tiêu đen nguyên hạt cay nhẹ và đậm đà tự nhiên. Gia vị hoàn hảo tẩm ướp thịt bò, dùng cho mọi món ngon cần điểm nhấn (Khối lượng 226g / 8 oz)." },
    { id: 14, name: "Muối Biển Đen Tự Nhiên", price: 210000, img: "/images/muoi-bien-den.jpg", desc: "Dòng muối Kosher & Gourmet Salt tự nhiên. Đặc sản hiếm có từ Phú Yên, với hương vị và màu sắc nguyên bản, không chất bảo quản, khoáng chất tuyệt đỉnh." },
    { id: 15, name: "Muối Biển Đỏ Tự Nhiên", price: 210000, img: "/images/muoi-bien-do.jpg", desc: "Kosher & Gourmet Salt đẳng cấp trải nghiệm. Lấy cảm hứng từ tự nhiên vùng Phú Yên, vị mặn dịu êm, màu sắc tinh tế, an toàn và hoàn toàn không bảo quản." },
    { id: 16, name: "Muối Trúc Hàn Quốc Jukyeom", price: 320000, img: "/images/muoi-truc-han-quoc.jpg", desc: "Đặc sản nức tiếng Korean Bamboo Salt. Nung chuẩn 9 lần mang lại hàng loạt công dụng đáng kinh ngạc, siêu giàu khoáng chất cho cơ thể khỏe mạnh (Khối lượng 226g / 8 oz)." }
];

let products = JSON.parse(localStorage.getItem('products'));
if (!products || products.length < 16) {
    // Tự động làm mới dữ liệu nếu đang dùng dữ liệu cũ
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
