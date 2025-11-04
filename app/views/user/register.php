<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — CarRental</title>
    <link rel="icon" href="<?= site_url('/favicon.svg') ?>" type="image/svg+xml">
    <link rel="alternate icon" href="<?= site_url('/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= site_url('/apple-touch-icon.png') ?>">
    <meta name="theme-color" content="#0d6efd">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
    <style>
        body { background: #eef2f5; }
        .login-wrap { max-width: 980px; margin: 4rem auto; padding: 0 1rem; }
        .login-card { border-radius: 1rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,.15); background: #fff; }
        .login-left { padding: 2rem 2.25rem; }
        .brand { font-weight: 700; color: #0ea5a5; letter-spacing: .5px; }
        .title { font-size: 2rem; font-weight: 800; }
        .accent { color: #0ea5a5; }
        .muted { color: #6c757d; }
        .illustration { background: #f8f9fa url('https://images.unsplash.com/photo-1619767886558-efdc259cde1a?q=80&w=1200&auto=format&fit=crop') center/cover no-repeat; min-height: 420px; }
        .form-control { height: 48px; }
        .btn-teal { background: #0ea5a5; border-color: #0ea5a5; }
        .btn-teal:hover { background: #0c8f8f; border-color: #0c8f8f; }
    </style>
</head>
<body>

<div class="login-wrap">
    <div class="row g-0 login-card">
        <div class="col-12 col-md-6 login-left">
            <div class="brand d-flex align-items-center mb-2">
                <i class="fa-solid fa-car-side me-2"></i> CarRental
            </div>
            <div class="title mb-1">Create Your <span class="accent">Account</span></div>
            <div class="muted mb-3">Sign up to book and manage your rentals.</div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger py-2"><i class="fa-solid fa-circle-exclamation me-2"></i><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success py-2"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <form action="<?= site_url('/user/registerProcess') ?>" method="post" class="mt-2">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted">First Name *</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Juan" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Dela Cruz" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label small text-muted">Email Address *</label>
                        <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" placeholder="09XXXXXXXXX">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Driver's License Number</label>
                        <input type="text" name="license_number" class="form-control" placeholder="e.g. N1234-56-789012">
                    </div>
                    <div class="col-12">
                        <label class="form-label small text-muted">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="House No., Street, City"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Password *</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            <span class="input-group-text bg-white"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Confirm Password *</label>
                        <div class="input-group">
                            <input type="password" name="password_confirm" class="form-control" placeholder="••••••••" required>
                            <span class="input-group-text bg-white"><i class="fa-regular fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-teal text-white">Create account</button>
                </div>
            </form>

            <div class="mt-3 small">
                Already have an account? <a href="<?= site_url('/user/login') ?>">Login</a>
            </div>
        </div>
        <div class="col-12 col-md-6 illustration"></div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
