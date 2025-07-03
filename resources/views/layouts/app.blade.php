<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'FDRIX') - Cemilan Keren</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
    
<header>
    <div class="logo-nav">
        <a href="{{ route('home') }}" aria-label="FDRIX logo" class="logo">
            <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M4 4h4v16H4V4zm6 0h10v4H10V4z"></path></svg>
            <span class="logo-text">FDRIX</span>
        </a>
        <nav aria-label="Primary navigation" class="nav-links">
            <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('store') }}" class="{{ Route::is('store') ? 'active' : '' }}">Store</a>
            <a href="#">About Us</a>
            <a href="{{ route('faq') }}" class="{{ Route::is('faq') ? 'active' : '' }}">FAQ</a>
        </nav>
    </div>
    
    <div class="actions">
        @guest
            {{-- Tampilan saat user belum login --}}
            <a href="{{ route('cart.index') }}" class="cart-icon-wrapper">
                <i class="fas fa-shopping-cart cart-icon" aria-label="Shopping Cart"></i>
                <span id="cart-counter" class="cart-counter">{{ count((array) session('cart')) }}</span>
            </a>
            <a href="{{ route('store') }}" class="order-btn" role="button">Order Now</a>
            <a href="{{ route('login') }}" class="user-icon" role="button" aria-label="Login">
                <i class="fas fa-user" aria-hidden="true"></i>
            </a>
        @endguest

        @auth
            {{-- Tampilan saat user sudah login --}}
            {{-- INI BAGIAN YANG DIPERBAIKI --}}
            <a href="{{ route('cart.index') }}" class="cart-icon-wrapper">
                <i class="fas fa-shopping-cart cart-icon" aria-label="Shopping Cart"></i>
                <span id="cart-counter" class="cart-counter">{{ count((array) session('cart')) }}</span>
            </a>
            <a href="{{ route('store') }}" class="order-btn" role="button">Order Now</a>

            {{-- Tombol Ikon Pengguna untuk membuka popup --}}
            <div id="user-menu-button" class="user-icon" role="button" aria-label="User Menu">
                <i class="fas fa-user" aria-hidden="true"></i>
            </div>

            {{-- POPUP PROFIL (Awalnya tersembunyi) --}}
            <div id="user-menu-popup" class="user-menu-popup">
                <div class="popup-header">
                    <div class="popup-avatar"><i class="fas fa-user"></i></div>
                    <div class="popup-user-info">
                        <span class="popup-user-name">{{ Auth::user()->name }}</span>
                        <span class="popup-user-email">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                <div class="popup-links">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ route('profile.edit') }}">Manage Profile</a>
                </div>
                <div class="popup-logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</header>

<main>
    @yield('content')
</main>

@include('layouts.partials.footer')

{{-- KODE JAVASCRIPT GABUNGAN UNTUK SEMUA FITUR --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- LOGIKA UNTUK MENU PROFIL ---
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenuPopup = document.getElementById('user-menu-popup');
    if (userMenuButton && userMenuPopup) {
        userMenuButton.addEventListener('click', function (event) {
            event.stopPropagation();
            userMenuPopup.style.display = userMenuPopup.style.display === 'block' ? 'none' : 'block';
        });
        window.addEventListener('click', function (event) {
            if (userMenuPopup.style.display === 'block' && !userMenuPopup.contains(event.target)) {
                userMenuPopup.style.display = 'none';
            }
        });
    }

    // --- LOGIKA UNTUK MODAL HAPUS AKUN ---
    const deleteBtn = document.getElementById('delete-account-button');
    if (deleteBtn) {
        const modal = document.getElementById('delete-confirm-modal');
        const cancelBtn = document.getElementById('cancel-delete-button');
        deleteBtn.addEventListener('click', () => modal.style.display = 'flex');
        cancelBtn.addEventListener('click', () => modal.style.display = 'none');
        modal.addEventListener('click', (event) => {
            if (event.target === modal) modal.style.display = 'none';
        });
    }

    // --- LOGIKA UNTUK TAMBAH PRODUK KE KERANJANG ---
    const cartCounter = document.getElementById('cart-counter');
    function handleAddToCartClick(event) {
        event.preventDefault();
        const button = event.currentTarget;
        const url = button.href;
        const originalText = button.innerHTML;
        button.innerHTML = 'Menambahkan...';
        button.disabled = true;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                if (cartCounter) {
                    cartCounter.innerText = data.cartCount;
                    cartCounter.style.display = 'flex';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }
    
    function initializeCartButtons() {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        addToCartButtons.forEach(button => {
            button.removeEventListener('click', handleAddToCartClick); 
            button.addEventListener('click', handleAddToCartClick);
        });
    }
    initializeCartButtons();

    // --- KODE YANG DITAMBAHKAN UNTUK UPDATE & REMOVE ITEM ---
    function updateCartTotal(total) {
        const summaryTotal = document.getElementById('summary-total');
        const summarySubtotal = document.getElementById('summary-subtotal');
        if (summaryTotal) summaryTotal.innerText = 'Rp' + total;
        if (summarySubtotal) summarySubtotal.innerText = 'Rp' + total;
    }

    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.dataset.id;
            const quantity = this.value;

            fetch(`/cart/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    const priceElement = document.querySelector(`.cart-item-card[data-id="${id}"] .cart-item-price`);
                    if (priceElement) {
                        const price = priceElement.dataset.price;
                        const subtotal = (price * quantity).toLocaleString('id-ID');
                        document.getElementById(`subtotal-${id}`).innerText = 'Rp' + subtotal;
                    }
                    updateCartTotal(data.total);
                }
            });
        });
    });

    document.querySelectorAll('.remove-item-btn').forEach(button => {
        button.addEventListener('click', function() {
            if(!confirm('Anda yakin ingin menghapus item ini?')) return;
            const id = this.dataset.id;
            
            fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    document.querySelector(`.cart-item-card[data-id="${id}"]`).remove();
                    updateCartTotal(data.total);
                    if (cartCounter) {
                        cartCounter.innerText = data.cartCount;
                        if(data.cartCount === 0) {
                            cartCounter.style.display = 'none';
                            location.reload(); 
                        }
                    }
                }
            });
        });
    });
});
</script>
</body>
</html>
