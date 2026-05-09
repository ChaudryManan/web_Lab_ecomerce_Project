<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyShop - Premium E-Commerce Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --gradient: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--light-color);
            color: var(--dark-color);
        }

        /* Navbar */
        .navbar {
            background: var(--gradient);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-1px);
        }

        .btn-cart {
            background: var(--accent-color);
            border: none;
            border-radius: 50px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-cart:hover {
            background: #d97706;
            transform: scale(1.05);
        }

        .btn-logout {
            background: #ef4444;
            border: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-logout:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .btn-login {
            background: var(--gradient);
            border: none;
            border-radius: 50px;
            padding: 8px 16px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-login:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-signup {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 6px 14px;
            transition: all 0.3s ease;
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-signup:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.05);
        }

        .user-info {
            background: rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 8px 16px;
            backdrop-filter: blur(10px);
            color: white;
        }

        /* Hero Section */
        .hero {
            background: var(--gradient);
            min-height: 70vh;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover;
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 100px 0;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-hero-primary {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .btn-hero-primary:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-hero-secondary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Search Bar */
        .search-section {
            background: white;
            padding: 40px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            border: none;
            border-radius: 50px 0 0 50px;
            padding: 15px 25px;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .search-btn {
            background: var(--gradient);
            border: none;
            border-radius: 0 50px 50px 0;
            padding: 15px 25px;
            color: white;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: scale(1.05);
        }

        /* Products Section */
        .products-section {
            padding: 80px 0;
            background: var(--light-color);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--dark-color);
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: none;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--accent-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-body {
            padding: 25px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .product-rating {
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            background: var(--gradient);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-view-details {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-view-details:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Categories */
        .categories-section {
            padding: 60px 0;
            background: white;
        }

        .category-card {
            text-align: center;
            padding: 30px;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .category-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .category-title {
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 40px 0;
            margin-top: 80px;
        }

        .footer h5 {
            color: white;
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .product-body {
                padding: 20px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark px-4 py-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-shopping-bag me-2"></i>MyShop
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#products">
                        <i class="fas fa-box me-1"></i>Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#categories">
                        <i class="fas fa-tags me-1"></i>Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">
                        <i class="fas fa-envelope me-1"></i>Contact
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/cart" class="btn btn-cart ms-2">
                        <i class="fas fa-shopping-cart me-1"></i>Cart
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('add.product') }}">
                        <i class="fas fa-plus me-1"></i>Add Product
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                @if(auth()->check())
                <div class="user-info">
                    <i class="fas fa-user me-2"></i>
                    {{ Auth::user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </button>
                </form>

                @if(auth()->user()->email === 'manankhn81@gmail.com')
                <a href="/admin/dashboard" class="btn btn-admin">
                    <i class="fas fa-cog me-1"></i>Admin
                </a>
                @endif
                @else
                <a href="/login" class="btn btn-login">Login</a>
                <a href="/signup" class="btn btn-signup">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-content">
        <div class="container">
            <h1 class="fade-in-up">Welcome to MyShop</h1>
            <p class="fade-in-up">Discover premium products at unbeatable prices. Shop with confidence and style.</p>
            <div class="fade-in-up">
                <a href="#products" class="btn-hero-primary">Shop Now</a>
                <a href="#categories" class="btn-hero-secondary">Explore Categories</a>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="search-section">
    <div class="container">
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="form-control search-input" placeholder="Search for products...">
                <button class="btn search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products-section" id="products">
    <div class="container">
        <h2 class="section-title">
            <i class="fas fa-star me-2"></i>Featured Products
        </h2>

        <div class="row g-4">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="product-image">
                        <a href="/product/{{ $product->id }}">
                            <img
                                src="{{ $product->image ? asset('products/'.$product->image) : 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}"
                                alt="{{ $product->name }}"
                                class="card-img-top">
                        </a>
                        <span class="product-badge">NEW</span>
                    </div>

                    <div class="product-body">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <div class="product-price">${{ $product->price }}</div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="ms-1">(4.5)</span>
                        </div>

                        <button class="btn btn-add-cart" type="button">
                            <i class="fas fa-cart-plus me-1"></i>Add to Cart
                        </button>
                        <a href="/product/{{ $product->id }}" class="btn btn-view-details">
                            <i class="fas fa-eye me-1"></i>View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No products found</h4>
                    <p class="text-muted">Check back later for new arrivals!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section" id="categories">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="category-card bg-light">
                    <div class="category-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h5 class="category-title">Fashion</h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="category-card bg-light">
                    <div class="category-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h5 class="category-title">Electronics</h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="category-card bg-light">
                    <div class="category-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h5 class="category-title">Home & Garden</h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="category-card bg-light">
                    <div class="category-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="category-title">Health & Beauty</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>MyShop</h5>
                <p>Your trusted online shopping destination for quality products at great prices.</p>
            </div>
            <div class="col-md-2">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#categories">Categories</a></li>
                    <li><a href="/cart">Cart</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Follow Us</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="text-center">
            <p>&copy; 2024 MyShop. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Toast Notification -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-info-circle text-info me-2" id="toastIcon"></i>
            <strong class="me-auto" id="toastTitle">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toastMessage">
            Product added to cart!
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toastEl = document.getElementById('cartToast');
    const toast = new bootstrap.Toast(toastEl);

    // Add to cart buttons
    document.querySelectorAll('.btn-add-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productCard = this.closest('.product-card');
            const productLink = productCard.querySelector('a[href*="/product/"]');
            const productId = productLink.href.split('/').pop();

            fetch(`/add-to-cart/${productId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to add to cart');
                }
            })
            .then(data => {
                const toastIcon = document.getElementById('toastIcon');
                const toastTitle = document.getElementById('toastTitle');
                const toastMessage = document.getElementById('toastMessage');

                if (data.success) {
                    toastIcon.className = 'fas fa-check-circle text-success me-2';
                    toastTitle.textContent = 'Success';
                } else {
                    toastIcon.className = 'fas fa-info-circle text-info me-2';
                    toastTitle.textContent = 'Info';
                }
                toastMessage.textContent = data.message;
                toast.show();
            })
            .catch(error => {
                console.error('Error:', error);
                // Optionally show error toast
                alert('Failed to add product to cart. Please try again.');
            });
        });
    });
});
</script>

</body>
</html>