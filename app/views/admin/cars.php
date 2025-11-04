<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars - Car Rental System</title>
    
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
                    <a class="nav-link" href="<?php echo site_url('/admin/dashboard'); ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('/admin/cars'); ?>">
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
                    <h1 class="h2 mb-0">Manage Cars</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 mt-2">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('/admin'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Cars</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center">
                    <a href="<?php echo site_url('/admin/cars/add'); ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i> Add New Car
                    </a>
                    <div class="ms-3">
                        <div class="user-info text-end">
                            <p class="mb-0"><strong>Welcome, <?php echo isset($username) ? htmlspecialchars($username) : 'Admin'; ?></strong></p>
                            <small class="text-muted">Administrator</small>
                        </div>
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
                                    <h3 class="mb-0"><?php echo isset($total_cars) ? $total_cars : '0'; ?></h3>
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
                                    <h6 class="text-muted mb-1">Available</h6>
                                    <h3 class="mb-0"><?php echo isset($available_cars) ? $available_cars : '0'; ?></h3>
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
                                    <h6 class="text-muted mb-1">Rented</h6>
                                    <h3 class="mb-0"><?php echo isset($rented_cars) ? $rented_cars : '0'; ?></h3>
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
                                    <h6 class="text-muted mb-1">Maintenance</h6>
                                    <h3 class="mb-0"><?php echo isset($maintenance_cars) ? $maintenance_cars : '0'; ?></h3>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-tools text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success d-flex align-items-center border-0 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger d-flex align-items-center border-0 shadow-sm mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Cars List -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <?php if (empty($cars)): ?>
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/3774/3774278.png" alt="No cars" class="mb-3" style="width: 100px; opacity: 0.5;">
                            <h4 class="text-muted">No Cars Found</h4>
                            <p class="text-muted">Start by adding your first car to the system.</p>
                            <a href="<?php echo site_url('/admin/cars/add'); ?>" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i> Add First Car
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">#</th>
                                        <th>Car Details</th>
                                        <th>Category</th>
                                        <th>Year</th>
                                        <th>Plate Number</th>
                                        <th>Daily Rate</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cars as $car): ?>
                                        <tr>
                                            <td class="ps-4"><?php echo (int)($car['id'] ?? 0); ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3">
                                                        <i class="fas fa-car text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo htmlspecialchars(($car['make'] ?? '') . ' ' . ($car['model'] ?? '')); ?></strong>
                                                        <br>
                                                        <small class="text-muted">
                                                            <?php echo htmlspecialchars($car['color'] ?? ''); ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($car['category'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($car['year'] ?? ''); ?></td>
                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    <?php echo htmlspecialchars($car['plate_number'] ?? ''); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <strong>₱<?php echo number_format((float)($car['daily_rate'] ?? 0), 2); ?></strong>
                                            </td>
                                            <td>
                                                <?php
                                                $statusClass = 'secondary';
                                                $statusIcon = 'circle';
                                                $status = $car['status'] ?? '';
                                                switch($status) {
                                                    case 'available':
                                                        $statusClass = 'success';
                                                        $statusIcon = 'check-circle';
                                                        break;
                                                    case 'rented':
                                                        $statusClass = 'warning';
                                                        $statusIcon = 'clock';
                                                        break;
                                                    case 'maintenance':
                                                        $statusClass = 'danger';
                                                        $statusIcon = 'tools';
                                                        break;
                                                }
                                                ?>
                                                <span class="status-badge bg-<?php echo $statusClass; ?> bg-opacity-10 text-<?php echo $statusClass; ?>">
                                                    <i class="fas fa-<?php echo $statusIcon; ?> me-1"></i>
                                                    <?php echo htmlspecialchars(ucfirst($status)); ?>
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group">
                                                    <a href="<?php echo site_url('/admin/cars/edit/' . (int)($car['id'] ?? 0)); ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('/admin/cars/images/' . (int)($car['id'] ?? 0)); ?>" class="btn btn-sm btn-outline-secondary" title="Manage Images">
                                                        <i class="fas fa-image"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('/admin/cars/delete/' . (int)($car['id'] ?? 0)); ?>" 
                                                       class="btn btn-sm btn-outline-danger" 
                                                       onclick="return confirm('Are you sure you want to delete this car?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
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

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
