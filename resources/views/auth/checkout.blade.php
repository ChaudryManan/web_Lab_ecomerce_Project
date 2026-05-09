<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .checkout-box {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .total-box {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
        }

        .btn-place {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 12px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-place:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">🧾 Checkout</h2>

    <div class="row g-4">

        <!-- LEFT SIDE: FORM -->
        <div class="col-md-7">

            <div class="checkout-box">

                <h4 class="section-title">👤 Customer Details</h4>

                <form action="{{ route('place.order') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="03xx-xxxxxxx" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="House, street, area..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="Rahim Yar Khan" required>
                    </div>

            </div>

        </div>

        <!-- RIGHT SIDE: ORDER SUMMARY -->
        <div class="col-md-5">

            <div class="checkout-box">

                <h4 class="section-title">🛒 Order Summary</h4>

                @php $total = 0; @endphp

                @foreach(session('cart', []) as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp

                    <div class="order-item">
                        <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                        <span>${{ $item['price'] * $item['quantity'] }}</span>
                    </div>
                @endforeach

                <hr>

                <div class="total-box">
                    Total: ${{ $total }}
                </div>

                <button type="submit" class="btn btn-place text-white w-100 mt-3">
                    Place Order
                </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>