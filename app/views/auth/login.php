<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - LavaLust</title>
    <link rel="icon" href="<?= site_url('/favicon.svg') ?>" type="image/svg+xml">
    <link rel="alternate icon" href="<?= site_url('/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= site_url('/apple-touch-icon.png') ?>">
    <meta name="theme-color" content="#0d6efd">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h3 class="text-primary"><i class="fas fa-fire"></i> LavaLust</h3>
                    <h4 class="mt-3">Admin Login</h4>
                </div>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo site_url('/admin/loginProcess'); ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Username</label>
                        <input type="text" name="username" class="form-control" required placeholder="Enter admin username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="<?php echo site_url('/admin/register'); ?>" class="text-decoration-none">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
