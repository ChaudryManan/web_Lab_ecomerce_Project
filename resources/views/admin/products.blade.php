<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #343a40, #495057);
            color: white;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .dashboard-header {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .table-card .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1.5rem;
        }
        .table th {
            background: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: #495057;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="p-3">
        <h4 class="mb-4"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</h4>
        <nav class="nav flex-column">
            <a class="nav-link" href="/admin/dashboard"><i class="fas fa-home"></i>Dashboard</a>
            <a class="nav-link active" href="/admin/products"><i class="fas fa-box"></i>Products</a>
            <a class="nav-link" href="/admin/orders"><i class="fas fa-shopping-cart"></i>Orders</a>
            <a class="nav-link" href="/admin/customers"><i class="fas fa-users"></i>Customers</a>
            <a class="nav-link" href="/admin/reports"><i class="fas fa-chart-bar"></i>Reports</a>
            <a class="nav-link" href="/dashboard"><i class="fas fa-store"></i>Store Front</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </button>
            </form>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="h2 mb-1"><i class="fas fa-box me-2"></i>Product Management</h1>
                <p class="text-muted mb-0">Manage your product catalog.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="/add-product" class="btn btn-primary btn-custom"><i class="fas fa-plus me-1"></i>Add Product</a>
                <a href="/admin/dashboard" class="btn btn-outline-secondary btn-custom"><i class="fas fa-arrow-left me-1"></i>Back to Dashboard</a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Products Table -->
    <div class="table-card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-box me-2"></i>All Products</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-tag"></i> Name</th>
                            <th><i class="fas fa-dollar-sign"></i> Price</th>
                            <th><i class="fas fa-align-left"></i> Description</th>
                            <th><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td><strong>#{{ $product->id }}</strong></td>
                                <td>{{ $product->name }}</td>
                                <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                                <td>{{ Illuminate\Support\Str::limit($product->description, 60) }}</td>
                                <td>
                                    <a href="/product/{{ $product->id }}" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-eye"></i> View</a>
                                    <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i> Edit</a>
                                    <form method="POST" action="/admin/products/{{ $product->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No products available.</p>
                                    <a href="/add-product" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Add First Product</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>