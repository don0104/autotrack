<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Car Rental System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 10px 20px;
            margin: 5px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background: #34495e;
            color: #fff;
        }
        .sidebar .nav-link.active {
            background: #3498db;
            color: #fff;
        }
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        .main-content {
            padding: 20px;
        }
        .navbar-brand {
            color: #fff;
            font-size: 1.5rem;
            padding: 10px 20px;
            margin-bottom: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            border-bottom: 1px solid #34495e;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.85rem;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <a href="<?php echo site_url('/admin'); ?>" class="navbar-brand">
                <i class="fa-solid fa-car-side"></i> CarRental
            </a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('/admin'); ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/admin/cars'); ?>">
                        <i class="fa-solid fa-car-side"></i> Manage Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/admin/cars/add'); ?>">
                        <i class="fa-solid fa-car-side"></i> Add New Car
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/admin/rentals'); ?>">
                        <i class="fas fa-list"></i> View Rentals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('/admin/payments'); ?>">
                        <i class="fas fa-dollar-sign"></i> View Payments
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="<?php echo site_url('/admin/logout'); ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- Main content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-4 py-4 main-content">
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom mb-4 pb-3">
                <div>
                    <h1 class="h2 mb-0">Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 mt-2">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center">
                    <div class="user-info text-end">
                        <p class="mb-0"><strong>Welcome, <?php echo isset($username) ? htmlspecialchars($username) : 'Admin'; ?></strong></p>
                        <small class="text-muted">Administrator</small>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Total Cars</h6>
                                    <h3 class="mb-0"><?php echo isset($car_stats['total']) ? $car_stats['total'] : '0'; ?></h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-car text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Available Cars</h6>
                                    <h3 class="mb-0"><?php echo isset($car_stats['available']) ? $car_stats['available'] : '0'; ?></h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Active Rentals</h6>
                                    <h3 class="mb-0"><?php echo isset($rental_stats['active']) ? $rental_stats['active'] : '0'; ?></h3>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Total Revenue</h6>
                                    <h3 class="mb-0">₱<?php echo isset($payment_stats['total_amount']) ? number_format($payment_stats['total_amount'], 2) : '0.00'; ?></h3>
                                </div>
                                <div class="bg-info bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-dollar-sign text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Recent Rentals</h5>
                                <a href="<?php echo site_url('/admin/rentals'); ?>" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <?php if (empty($recent_rentals)): ?>
                                <div class="text-center py-4">
                                    <img src="https://cdn-icons-png.flaticon.com/512/6598/6598519.png" alt="No rentals" style="width: 80px; opacity: 0.5;">
                                    <p class="text-muted mt-3">No recent rentals found</p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer</th>
                                                <th>Car</th>
                                                <th>Status</th>
                                                <th class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_rentals as $rental): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-2 me-2">
                                                                <i class="fas fa-user text-primary"></i>
                                                            </div>
                                                            <?php echo isset($rental['first_name'], $rental['last_name']) ? 
                                                                htmlspecialchars($rental['first_name'] . ' ' . $rental['last_name']) : 'N/A'; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($rental['make'], $rental['model']) ? 
                                                            htmlspecialchars($rental['make'] . ' ' . $rental['model']) : 'N/A'; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $statusClass = 'secondary';
                                                        $statusIcon = 'circle';
                                                        if (isset($rental['status'])) {
                                                            switch(strtolower($rental['status'])) {
                                                                case 'pending':
                                                                    $statusClass = 'warning';
                                                                    $statusIcon = 'clock';
                                                                    break;
                                                                case 'active':
                                                                    $statusClass = 'primary';
                                                                    $statusIcon = 'car';
                                                                    break;
                                                                case 'completed':
                                                                    $statusClass = 'success';
                                                                    $statusIcon = 'check-circle';
                                                                    break;
                                                                case 'cancelled':
                                                                    $statusClass = 'danger';
                                                                    $statusIcon = 'times-circle';
                                                                    break;
                                                            }
                                                        }
                                                        ?>
                                                        <span class="status-badge bg-<?php echo $statusClass; ?> bg-opacity-10 text-<?php echo $statusClass; ?>">
                                                            <i class="fas fa-<?php echo $statusIcon; ?> me-1"></i>
                                                            <?php echo isset($rental['status']) ? htmlspecialchars(ucfirst($rental['status'])) : 'Unknown'; ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        ₱<?php echo isset($rental['total_amount']) ? 
                                                            number_format($rental['total_amount'], 2) : '0.00'; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Recent Payments</h5>
                                <a href="<?php echo site_url('/admin/payments'); ?>" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <?php if (empty($recent_payments)): ?>
                                <div class="text-center py-4">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076478.png" alt="No payments" style="width: 80px; opacity: 0.5;">
                                    <p class="text-muted mt-3">No recent payments found</p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer</th>
                                                <th>Car</th>
                                                <th>Method</th>
                                                <th class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_payments as $payment): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-2 me-2">
                                                                <i class="fas fa-user text-primary"></i>
                                                            </div>
                                                            <?php echo isset($payment['first_name'], $payment['last_name']) ? 
                                                                htmlspecialchars($payment['first_name'] . ' ' . $payment['last_name']) : 'N/A'; ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($payment['make'], $payment['model']) ? 
                                                            htmlspecialchars($payment['make'] . ' ' . $payment['model']) : 'N/A'; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info bg-opacity-10 text-info">
                                                            <i class="fas fa-credit-card me-1"></i>
                                                            <?php echo isset($payment['payment_method']) ? 
                                                                htmlspecialchars(ucfirst($payment['payment_method'])) : 'N/A'; ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <strong>₱<?php echo isset($payment['amount']) ? 
                                                            number_format($payment['amount'], 2) : '0.00'; ?></strong>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>