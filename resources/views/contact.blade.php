<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - MyShop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
        font-family: 'Segoe UI', sans-serif;
    }

    .contact-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .contact-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        padding: 50px 30px;
        text-align: center;
    }

    .contact-header h1 {
        font-weight: 700;
        font-size: 2.2rem;
    }

    .contact-header p {
        opacity: 0.9;
        margin-top: 10px;
    }

    .contact-form {
        padding: 40px;
    }

    .contact-info {
        background: #f8f9ff;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 30px;
        border-left: 5px solid #6366f1;
    }

    .contact-info h5 {
        color: #6366f1;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        font-size: 14px;
        color: #444;
    }

    .contact-item i {
        color: #6366f1;
        margin-right: 12px;
        font-size: 16px;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 12px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.15);
    }

    .btn-submit {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 12px 35px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
        width: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
    }

    .form-title {
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    .divider {
        height: 1px;
        background: #eee;
        margin: 25px 0;
    }
</style>
</head>

<body>

<div class="contact-container">

    <!-- HEADER -->
    <div class="contact-header">
        <h1><i class="fas fa-envelope me-2"></i>Contact Us</h1>
        <p>We are here to help you anytime. Send us a message!</p>
    </div>

    <!-- BODY -->
    <div class="contact-form">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- INFO BOX -->
        <div class="contact-info">
            <h5><i class="fas fa-info-circle me-2"></i>Get in Touch</h5>

            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <span>support@myshop.com</span>
            </div>

            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <span>+92 300 1234567</span>
            </div>

            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Rahim Yar Khan, Punjab, Pakistan</span>
            </div>

            <div class="contact-item">
                <i class="fas fa-clock"></i>
                <span>Mon - Sat: 9AM - 8PM</span>
            </div>
        </div>

        <div class="divider"></div>

        <!-- FORM -->
        <h5 class="form-title">Send Message</h5>

        <form action="/contact" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject *</label>
                <input type="text" class="form-control" name="subject" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message *</label>
                <textarea class="form-control" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-submit">
                <i class="fas fa-paper-plane me-2"></i>Send Message
            </button>
        </form>

    </div>

</div>

</body>
</html>