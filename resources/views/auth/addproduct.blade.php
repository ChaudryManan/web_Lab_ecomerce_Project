<!DOCTYPE html>
<html lang="en">



<head>
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
        }

        .product-card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .form-control {\
            border-radius: 10px;
        }

        .btn-custom {
            background: #667eea;
            color: white;
            border-radius: 10px;
        }

        .btn-custom:hover {
            background: #5a67d8;
        }

        .title {
            font-weight: bold;
            color: #333;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card product-card p-4" style="width: 500px;">

        <h3 class="text-center title">➕ Add New Product</h3>
        <p class="text-center subtitle">Fill details to list a new product</p>
         @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
          <form method="POST" action="/store-product" enctype="multipart/form-data">
    @csrf

    <!-- Product Name -->
    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Enter product name"
            value="{{ old('name') }}">

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" min="0"
    class="form-control @error('price') is-invalid @enderror"
    placeholder="Enter price"
    value="{{ old('price') }}">

        @error('price')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description"
            class="form-control @error('description') is-invalid @enderror"
            rows="3"
            placeholder="Product description">{{ old('description') }}</textarea>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Image -->
    <div class="mb-3">
        <label>Product Image</label>
        <input type="file" name="image"
            class="form-control @error('image') is-invalid @enderror">

        @error('image')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-custom w-100">
        Save Product
    </button>
</form>
    </div>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const priceInput = document.querySelector('input[name="price"]');

    priceInput.addEventListener('input', function () {

        const value = parseFloat(this.value);

        let error = document.getElementById('price-error');
        if (error) error.remove();

        if (value < 0) {
            this.classList.add('is-invalid');

            let msg = document.createElement('small');
            msg.id = "price-error";
            msg.className = "text-danger";
            msg.innerText = "Negative amount is not allowed!";
            this.parentNode.appendChild(msg);
        } else {
            this.classList.remove('is-invalid');
        }
    });

});
</script>
</body>
</html>