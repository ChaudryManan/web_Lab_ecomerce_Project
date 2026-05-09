<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        .cart-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
        }

        .qty-box button {
            width: 30px;
            height: 30px;
            padding: 0;
        }

        .total-box {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">🛒 Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="cart-box">

        @if(count($cart) > 0)

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                @php $grandTotal = 0; @endphp

                @foreach($cart as $id => $item)

                    @php
                        $total = $item['price'] * $item['quantity'];
                        $grandTotal += $total;
                    @endphp

                    <tr id="row-{{ $id }}">
                        <td>
                            <img src="{{ asset('products/'.$item['image']) }}" class="product-img">
                        </td>

                        <td>{{ $item['name'] }}</td>

                        <td>${{ $item['price'] }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-2 qty-box">

                                <button class="btn btn-sm btn-outline-secondary"
                                    onclick="updateQty({{ $id }}, 'decrease')"
                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                    -
                                </button>

                                <span id="qty-{{ $id }}">{{ $item['quantity'] }}</span>

                                <button class="btn btn-sm btn-outline-secondary"
                                    onclick="updateQty({{ $id }}, 'increase')">
                                    +
                                </button>

                            </div>
                        </td>

                        <td id="total-{{ $id }}">
                            ${{ $total }}
                        </td>

                        <td>
                            <button class="btn btn-sm btn-danger"
                                onclick="removeItem({{ $id }})">
                                🗑️ Remove
                            </button>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">

                <h4 class="total-box">
                    Total: ${{ $grandTotal }}
                </h4>

                <div class="d-flex gap-2">

                    <a href="{{ route('checkout.page') }}" class="btn btn-success">
                        Checkout
                    </a>

                    <a href="/dashboard" class="btn btn-secondary">
                        Continue Shopping
                    </a>

                </div>

            </div>

        @else
            <div class="text-center py-5">
                <h4>Your cart is empty 😢</h4>
                <a href="/dashboard" class="btn btn-primary mt-3">Go Shopping</a>
            </div>
        @endif

    </div>

</div>

<script>
function removeItem(id) {

    if(!confirm('Are you sure you want to remove this item?')) {
        return;
    }

    fetch(`/update-cart/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            action: 'remove'
        })
    })
    .then(res => res.json())
    .then(data => {

        if(data.success) {
            document.getElementById(`row-${id}`).remove();
            location.reload(); // refresh to update totals
        }
    })
    .catch(err => console.log(err));
}
</script>

</body>
</html>