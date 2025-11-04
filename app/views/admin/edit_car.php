<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car - Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Edit Car</h3>
                <a href="<?= site_url('/admin/cars/images/' . (int)($car['id'] ?? 0)) ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-image me-1"></i> Manage Images
                </a>
            </div>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="<?php echo site_url('/admin/cars/edit'); ?>" method="post">
                        <input type="hidden" name="car_id" value="<?php echo htmlspecialchars($car['id']); ?>">

                        <div class="mb-3">
                            <label class="form-label">Make *</label>
                            <input type="text" name="make" class="form-control" value="<?php echo htmlspecialchars($car['make']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Model *</label>
                            <input type="text" name="model" class="form-control" value="<?php echo htmlspecialchars($car['model']); ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Year *</label>
                                <input type="number" name="year" class="form-control" value="<?php echo htmlspecialchars($car['year']); ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Plate Number *</label>
                                <input type="text" name="plate_number" class="form-control" value="<?php echo htmlspecialchars($car['plate_number']); ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">VIN *</label>
                                <input type="text" name="vin" class="form-control" value="<?php echo htmlspecialchars($car['vin']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Daily Rate *</label>
                                <input type="number" name="daily_rate" class="form-control" step="0.01" value="<?php echo htmlspecialchars($car['daily_rate']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="available" <?php echo $car['status'] === 'available' ? 'selected' : ''; ?>>Available</option>
                                    <option value="rented" <?php echo $car['status'] === 'rented' ? 'selected' : ''; ?>>Rented</option>
                                    <option value="maintenance" <?php echo $car['status'] === 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
                                    <option value="out_of_service" <?php echo $car['status'] === 'out_of_service' ? 'selected' : ''; ?>>Out of Service</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <?php $cats = ['','Sedan','SUV','Hatchback','Van','Truck','Coupe','Convertible','Others']; ?>
                                    <?php foreach($cats as $c): ?>
                                        <option value="<?= htmlspecialchars($c) ?>" <?= ($car['category'] ?? '') === $c ? 'selected' : '' ?>><?= $c === '' ? 'Select Category (optional)' : $c ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($car['description']); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo site_url('/admin/cars'); ?>" class="btn btn-outline-secondary">Cancel</a>
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
