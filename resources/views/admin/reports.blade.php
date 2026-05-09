<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Reports</title>
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
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #007bff;
        }
        .stat-card h5 {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card .display-6 {
            color: #343a40;
            font-weight: bold;
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
            <a class="nav-link" href="/admin/products"><i class="fas fa-box"></i>Products</a>
            <a class="nav-link" href="/admin/orders"><i class="fas fa-shopping-cart"></i>Orders</a>
            <a class="nav-link" href="/admin/customers"><i class="fas fa-users"></i>Customers</a>
            <a class="nav-link active" href="/admin/reports"><i class="fas fa-chart-bar"></i>Reports</a>
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
                <h1 class="h2 mb-1"><i class="fas fa-chart-bar me-2"></i>Reports & Analytics</h1>
                <p class="text-muted mb-0">Key metrics and insights for your store.</p>
            </div>
            <div class="d-flex gap-2">
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

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-shopping-bag text-primary"></i>
                <h5>Total Orders</h5>
                <p class="display-6 mb-0">{{ $totalOrders }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-dollar-sign text-success"></i>
                <h5>Total Revenue</h5>
                <p class="display-6 mb-0">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-box text-warning"></i>
                <h5>Products</h5>
                <p class="display-6 mb-0">{{ $totalProducts }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="fas fa-chart-line text-info"></i>
                <h5>Avg Order Value</h5>
                <p class="display-6 mb-0">${{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 2) : '0.00' }}</p>
            </div>
        </div>
    </div>

    <!-- Placeholder for Charts or More Details -->
    <div class="table-card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Detailed Reports</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">Advanced reporting features can be added here, such as charts, graphs, and more detailed analytics.</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>