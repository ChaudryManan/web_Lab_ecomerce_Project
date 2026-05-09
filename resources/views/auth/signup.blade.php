<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .signup-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .signup-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .signup-header i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .signup-body {
            padding: 2rem;
        }
        .form-floating > label {
            color: #6c757d;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-signup {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .signup-footer {
            text-align: center;
            padding: 1rem 2rem;
            background: #f8f9fa;
        }
        .signup-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .signup-footer a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>

<body>

<div class="signup-container">
    <div class="signup-header">
        <i class="fas fa-user-plus"></i>
        <h2>Join Us Today</h2>
        <p>Create your account to get started</p>
    </div>

    <div class="signup-body">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/signup">
            @csrf

            <!-- NAME -->
            <div class="form-floating mb-3">
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Enter your full name"
                    value="{{ old('name') }}" required>
                <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="form-floating mb-3">
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter your email address"
                    value="{{ old('email') }}" required>
                <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="form-floating mb-3">
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Create a strong password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="form-floating mb-4">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control"
                    placeholder="Confirm your password" required>
                <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
            </div>

            <button type="submit" class="btn btn-signup w-100 mb-3">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>
        </form>
    </div>

    <div class="signup-footer">
        <p class="mb-0">Already have an account? <a href="/login">Sign in here</a></p>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

</body>
</html>