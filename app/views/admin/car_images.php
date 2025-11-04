<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Images - Car #<?= (int)($car['id'] ?? 0) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .sidebar { background:#2c3e50; min-height:100vh; padding-top:20px; }
    .sidebar .nav-link { color:#ecf0f1; padding:10px 20px; margin:5px 15px; border-radius:5px; }
    .sidebar .nav-link.active { background:#3498db; color:#fff; }
    .thumb { width: 120px; height: 80px; object-fit: cover; border:1px solid #e9ecef; background:#fff; }
    .table td, .table th { vertical-align: middle; }
  </style>
  </head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
      <a href="<?= site_url('/admin') ?>" class="navbar-brand d-block text-center text-white py-3 border-bottom border-2 border-dark text-decoration-none">
        <i class="fa-solid fa-car-side"></i> CarRental
      </a>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="<?= site_url('/admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="<?= site_url('/admin/cars') ?>"><i class="fa-solid fa-car-side"></i> Manage Cars</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= site_url('/admin/rentals') ?>"><i class="fas fa-list"></i> View Rentals</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= site_url('/admin/payments') ?>"><i class="fas fa-dollar-sign"></i> View Payments</a></li>
        <li class="nav-item mt-3"><a class="nav-link text-danger" href="<?= site_url('/admin/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>

    <div class="col-md-9 ms-sm-auto col-lg-10 px-4 py-4">
      <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-2">
        <div>
          <h1 class="h3 mb-0">Images for <?= htmlspecialchars(($car['make'] ?? '') . ' ' . ($car['model'] ?? '')) ?> (<?= (int)($car['year'] ?? 0) ?>)</h1>
          <div class="small text-muted mt-1">Car ID: <?= (int)($car['id'] ?? 0) ?> • Plate: <?= htmlspecialchars($car['plate_number'] ?? '') ?></div>
        </div>
        <div>
          <a href="<?= site_url('/admin/cars') ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Back</a>
          <a href="<?= site_url('/admin/cars/edit/' . (int)($car['id'] ?? 0)) ?>" class="btn btn-outline-primary ms-2"><i class="fas fa-edit me-1"></i> Edit Car</a>
        </div>
      </div>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          <h5 class="mb-3">Add Image</h5>
          <form action="<?= site_url('/admin/cars/images/add') ?>" method="post" enctype="multipart/form-data" class="row g-3">
            <input type="hidden" name="car_id" value="<?= (int)($car['id'] ?? 0) ?>">
            <div class="col-md-4">
              <label class="form-label">Upload File</label>
              <input type="file" name="image" class="form-control" accept="image/*">
              <div class="form-text">JPG/PNG/GIF up to 5MB</div>
            </div>
            <div class="col-md-5">
              <label class="form-label">Or Image URL</label>
              <input type="text" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
            </div>
            <div class="col-md-3">
              <label class="form-label">Color</label>
              <input type="text" name="color" class="form-control" placeholder="e.g., Red">
            </div>
            <div class="col-md-9 d-flex align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_primary" id="is_primary">
                <label class="form-check-label" for="is_primary">Set as primary image</label>
              </div>
            </div>
            <div class="col-md-3 text-end">
              <button class="btn btn-primary"><i class="fas fa-upload me-1"></i> Add Image</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Existing Images</h5>
          <?php if (empty($images)): ?>
            <p class="text-muted">No images uploaded yet.</p>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table align-middle">
                <thead class="bg-light">
                  <tr>
                    <th>#</th>
                    <th>Preview</th>
                    <th>Color</th>
                    <th>Path</th>
                    <th>Primary</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($images as $img):
                    $raw = trim($img['image_path'] ?? '');
                    if ($raw === '') { $url = ''; }
                    elseif (preg_match('/^https?:\/\//i', $raw) || strpos($raw, 'data:') === 0) { $url = $raw; }
                    else { $url = site_url('/' . ltrim($raw, '/')); }
                  ?>
                    <tr>
                      <td><?= (int)$img['id'] ?></td>
                      <td>
                        <?php if ($url): ?>
                          <a href="<?= $url ?>" target="_blank" rel="noopener">
                            <img src="<?= $url ?>" class="thumb rounded" alt="preview">
                          </a>
                        <?php else: ?>
                          <span class="text-muted">(no image)</span>
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($img['color'] ?? '') ?></td>
                      <td class="small text-break"><?= htmlspecialchars($img['image_path'] ?? '') ?></td>
                      <td>
                        <?php if ((int)$img['is_primary'] === 1): ?>
                          <span class="badge bg-success">Primary</span>
                        <?php else: ?>
                          <span class="badge bg-secondary">No</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-end">
                        <div class="btn-group">
                          <?php if ((int)$img['is_primary'] !== 1): ?>
                            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('/admin/cars/images/primary/' . (int)$img['id'] . '/' . (int)($car['id'] ?? 0)) ?>" title="Set as primary"><i class="fas fa-star"></i></a>
                          <?php endif; ?>
                          <a class="btn btn-sm btn-outline-danger" href="<?= site_url('/admin/cars/images/delete/' . (int)$img['id'] . '/' . (int)($car['id'] ?? 0)) ?>" onclick="return confirm('Delete this image?')" title="Delete"><i class="fas fa-trash"></i></a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
