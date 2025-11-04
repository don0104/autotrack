<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Details - Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background: #2c3e50; min-height: 100vh; padding-top: 20px; }
        .sidebar .nav-link { color: #ecf0f1; padding: 10px 20px; margin: 5px 15px; border-radius: 5px; transition: all 0.3s; }
        .sidebar .nav-link:hover { background: #34495e; color: #fff; }
        .sidebar .nav-link.active { background: #3498db; color: #fff; }
        .sidebar .nav-link i { width: 20px; text-align: center; margin-right: 10px; }
        .navbar-brand { color: #fff; font-size: 1.5rem; padding: 10px 20px; margin-bottom: 20px; display: block; text-align: center; text-decoration: none; border-bottom: 1px solid #34495e; }
        .main-content { padding: 20px; }
        .status-badge { padding: 5px 10px; border-radius: 15px; font-size: 0.85rem; }
        .list-group-item { border: 0; padding-left: 0; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <a href="<?php echo site_url('/admin'); ?>" class="navbar-brand">
                <i class="fas fa-car-alt"></i> CarRental
            </a>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('/admin/dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('/admin/cars'); ?>"><i class="fas fa-car"></i> Manage Cars</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?php echo site_url('/admin/rentals'); ?>"><i class="fas fa-list"></i> View Rentals</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('/admin/payments'); ?>"><i class="fas fa-dollar-sign"></i> View Payments</a></li>
                <li class="nav-item mt-3"><a class="nav-link text-danger" href="<?php echo site_url('/admin/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-4 py-4 main-content">
            <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-3">
                <div>
                    <h1 class="h2 mb-0">Rental #<?php echo (int)$rental['id']; ?></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 mt-2">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('/admin'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('/admin/rentals'); ?>">Rentals</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-end">
                    <?php 
                        $status = strtolower($rental['status']);
                        $canConfirm = in_array($status, ['pending','confirmed']);
                        $canCancel = in_array($status, ['pending','confirmed','active']);
                    ?>
                    <div class="btn-group">
                        <?php if ($canConfirm): ?>
                        <a href="<?php echo site_url('/admin/rentals/confirm/' . (int)$rental['id']); ?>" class="btn btn-success">
                            <i class="fas fa-check me-1"></i> Confirm
                        </a>
                        <?php endif; ?>
                        <?php if ($canCancel): ?>
                        <a href="<?php echo site_url('/admin/rentals/cancel/' . (int)$rental['id']); ?>" class="btn btn-outline-danger" onclick="return confirm('Cancel this rental?');">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Rental Information</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Status:</strong>
                                    <span class="ms-2 badge bg-secondary"><?php echo htmlspecialchars(ucfirst($rental['status'])); ?></span>
                                </li>
                                <li class="list-group-item"><strong>Car:</strong> <?php echo htmlspecialchars($rental['make'] . ' ' . $rental['model'] . ' (' . $rental['year'] . ')'); ?>
                                    <small class="text-muted ms-2"><?php echo htmlspecialchars($rental['plate_number']); ?></small>
                                </li>
                                <li class="list-group-item"><strong>Dates:</strong>
                                    <?php 
                                        $start = new DateTime($rental['rental_start']);
                                        $end = new DateTime($rental['rental_end']);
                                        echo $start->format('M j, Y') . ' - ' . $end->format('M j, Y');
                                    ?>
                                    <small class="text-muted ms-2"><?php echo (int)$rental['total_days']; ?> day(s)</small>
                                </li>
                                <li class="list-group-item"><strong>Locations:</strong>
                                    <div class="ms-2">
                                        <div><small class="text-muted">Pickup:</small> <?php echo htmlspecialchars($rental['pickup_location'] ?? '-'); ?></div>
                                        <div><small class="text-muted">Return:</small> <?php echo htmlspecialchars($rental['return_location'] ?? '-'); ?></div>
                                    </div>
                                </li>
                                <li class="list-group-item"><strong>Contract:</strong>
                                    <?php if (!empty($rental['is_contract_signed'])): ?>
                                        <span class="badge bg-success ms-2"><i class="fas fa-file-signature me-1"></i> Signed</span>
                                        <a href="<?php echo site_url('/user/contract/pdf/' . (int)$rental['id']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary ms-2">View PDF</a>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark ms-2">Not Signed</span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Customer</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Name:</strong> <?php echo htmlspecialchars($rental['first_name'] . ' ' . $rental['last_name']); ?></li>
                                <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($rental['email']); ?></li>
                                <li class="list-group-item"><strong>Phone:</strong> <?php echo htmlspecialchars($rental['phone'] ?? '-'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Payment Summary</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between"><span>Subtotal</span><strong>₱<?php echo number_format((float)$rental['subtotal'], 2); ?></strong></li>
                                <li class="list-group-item d-flex justify-content-between"><span>Tax (<?php echo number_format((float)$rental['tax_rate'], 2); ?>%)</span><strong>₱<?php echo number_format((float)$rental['tax_amount'], 2); ?></strong></li>
                                <li class="list-group-item d-flex justify-content-between"><span>Total</span><strong>₱<?php echo number_format((float)$rental['total_amount'], 2); ?></strong></li>
                                <li class="list-group-item d-flex justify-content-between"><span>Paid</span><strong class="text-success">₱<?php echo number_format((float)$paid_total, 2); ?></strong></li>
                                <li class="list-group-item d-flex justify-content-between"><span>Required Deposit</span><strong class="text-primary">₱<?php echo number_format((float)$required_deposit, 2); ?></strong></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Payments</h5>
                            <?php if (!empty($payments)): ?>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Method</th>
                                                <th>Status</th>
                                                <th class="text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($payments as $p): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars(date('M j, Y H:i', strtotime($p['created_at']))); ?></td>
                                                <td><?php echo htmlspecialchars(ucfirst($p['payment_method'])); ?></td>
                                                <td>
                                                    <?php $cls = $p['payment_status'] === 'completed' ? 'success' : ($p['payment_status'] === 'failed' ? 'danger' : 'secondary'); ?>
                                                    <span class="badge bg-<?php echo $cls; ?>"><?php echo htmlspecialchars(ucfirst($p['payment_status'])); ?></span>
                                                </td>
                                                <td class="text-end">₱<?php echo number_format((float)$p['amount'], 2); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted mb-0">No payments yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
