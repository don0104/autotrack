<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car - Car Rental System</title>
    
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
        .form-label {
            font-weight: 500;
            color: #2c3e50;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e6ed;
            padding: 10px 15px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
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
                    <a class="nav-link" href="<?php echo site_url('/admin/cars'); ?>">
                        <i class="fa-solid fa-car-side"></i> Manage Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url('/admin/cars/add'); ?>">
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
                    <h1 class="h2 mb-0">Add New Car</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 mt-2">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('/admin'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('/admin/cars'); ?>">Cars</a></li>
                            <li class="breadcrumb-item active">Add New Car</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center">
                    <a href="<?php echo site_url('/admin/cars'); ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Cars
                    </a>
                    <div class="ms-3">
                        <div class="user-info text-end">
                            <p class="mb-0"><strong>Welcome, <?php echo isset($username) ? htmlspecialchars($username) : 'Admin'; ?></strong></p>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert -->
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger d-flex align-items-center border-0 shadow-sm mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Add Car Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="<?php echo site_url('/admin/cars/add'); ?>" method="post" enctype="multipart/form-data">
                        <!-- Car Basic Info -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h5 class="text-muted">Basic Information</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Make *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-car"></i></span>
                                    <input type="text" name="make" class="form-control" required placeholder="e.g., Toyota">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Model *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                    <input type="text" name="model" class="form-control" required placeholder="e.g., Camry">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Year *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-calendar"></i></span>
                                    <input type="number" name="year" class="form-control" required min="2000" max="2025" placeholder="2023">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Color *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-palette"></i></span>
                                    <input type="text" name="color" class="form-control" required placeholder="e.g., Silver">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Category</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-list"></i></span>
                                    <select name="category" class="form-select">
                                        <option value="">Select Category (optional)</option>
                                        <option value="Sedan">Sedan</option>
                                        <option value="SUV">SUV</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="Van">Van</option>
                                        <option value="Truck">Truck</option>
                                        <option value="Coupe">Coupe</option>
                                        <option value="Convertible">Convertible</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Plate Number *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-id-card"></i></span>
                                    <input type="text" name="plate_number" class="form-control" required placeholder="e.g., ABC-1234">
                                </div>
                            </div>
                        </div>

                        <!-- Car Details -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h5 class="text-muted">Vehicle Details</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">VIN *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-barcode"></i></span>
                                    <input type="text" name="vin" class="form-control" required placeholder="17-character VIN">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mileage *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-tachometer-alt"></i></span>
                                    <input type="number" name="mileage" class="form-control" required placeholder="e.g., 15000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fuel Type *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-gas-pump"></i></span>
                                    <select name="fuel_type" class="form-select" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="gasoline">Gasoline</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="hybrid">Hybrid</option>
                                        <option value="electric">Electric</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Transmission *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-cog"></i></span>
                                    <select name="transmission" class="form-select" required>
                                        <option value="">Select Transmission</option>
                                        <option value="automatic">Automatic</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Seating Capacity *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-users"></i></span>
                                    <input type="number" name="seating_capacity" class="form-control" required min="2" max="9" placeholder="5">
                                </div>
                            </div>
                        </div>

                        <!-- Rental Info -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h5 class="text-muted">Rental Information</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Daily Rate (₱) *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-dollar-sign"></i></span>
                                    <input type="number" name="daily_rate" class="form-control" required step="0.01" placeholder="2500.00">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Car Image</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-image"></i></span>
                                    <input type="file" name="car_image" accept="image/*" class="form-control">
                                </div>
                                <small class="text-muted">Upload JPG/PNG/GIF up to 5MB. Optional: You can also paste a URL below.</small>
                                <input type="text" name="image_path" class="form-control mt-2" placeholder="https://example.com/image.jpg (optional)">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Enter car description and notable features..."></textarea>
                                <small class="text-muted">Include important details about the car's features and condition.</small>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo site_url('/admin/cars'); ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Add Car
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
