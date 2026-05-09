<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $product->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Main Product Box */
        .product-box {
            background: white;
            border-radius: 20px;
            padding: 30px;
            width: 900px; /* FIXED WIDTH */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Image Container */
        .product-img-box {
            height: 350px; /* FIXED HEIGHT */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .product-img-box img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain; /* IMPORTANT */
        }

        .btn-buy {
            background: #28a745;
            color: white;
        }

        .btn-buy:hover {
            background: #218838;
        }
    </style>
</head>

<body>

<div class="product-box">

    <div class="row">

        <!-- IMAGE -->
        <div class="col-md-6">
            <div class="product-img-box">
                <img src="{{ $product->image ? asset('products/'.$product->image) : 'https://via.placeholder.com/400x300' }}">
            </div>
        </div>

        <!-- DETAILS -->
        <div class="col-md-6 d-flex flex-column justify-content-center">

            <h2>{{ $product->name }}</h2>

            <h3 class="text-danger mt-3">${{ $product->price }}</h3>

            <p class="mt-3 text-muted">
                {{ $product->description }}
            </p>

            <div class="mt-4 d-grid gap-2">

                <button class="btn btn-primary btn-lg" id="addToCartBtn">
                    Add to Cart
                </button>

                <form action="/buy-now/{{ $product->id }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-buy btn-lg w-100">
                        Buy Now
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

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

    // Add to cart button
    document.getElementById('addToCartBtn').addEventListener('click', function() {
        const productId = {{ $product->id }};

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
</script>

</body>
</html>