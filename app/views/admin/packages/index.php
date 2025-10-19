<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Kelola Paket Harga</h4>
                        <p class="mb-0">Kelola paket harga untuk setiap layanan</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                            <i class="bx bx-plus me-1"></i>Tambah Paket
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Packages Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Layanan</th>
                                <th>Harga</th>
                                <th>Tipe</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php if (!empty($packages)): ?>
                                <?php foreach ($packages as $package): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($package['name']); ?></strong>
                                            <?php if (!empty($package['description'])): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars($package['description']); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">
                                                <?php echo htmlspecialchars($package['service_name']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong>Rp <?php echo number_format($package['price_min']); ?></strong>
                                            <?php if ($package['price_min'] != $package['price_max']): ?>
                                                <br><small class="text-muted">- Rp <?php echo number_format($package['price_max']); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-<?php
                                                echo $package['package_type'] === 'premium' ? 'warning' :
                                                     ($package['package_type'] === 'enterprise' ? 'danger' : 'secondary'); ?>">
                                                <?php echo ucfirst($package['package_type']); ?>
                                            </span>
                                            <?php if ($package['is_popular']): ?>
                                                <br><span class="badge bg-label-success mt-1">Populer</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-<?php echo $package['is_active'] ? 'success' : 'danger'; ?>">
                                                <?php echo $package['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="editPackage(<?php echo $package['id']; ?>)">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deletePackage(<?php echo $package['id']; ?>, '<?php echo htmlspecialchars($package['name']); ?>')">
                                                        <i class="bx bx-trash me-1"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bx bx-money" style="font-size: 48px; color: #ddd;"></i>
                                        <p class="mt-3 text-muted">Belum ada paket harga</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                                            Tambah Paket Pertama
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= BASE_URL ?>admin/packages" method="POST">
                <?= Router::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addPackageModalLabel">Tambah Paket Harga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Paket *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Layanan *</label>
                                <select class="form-select" id="service_id" name="service_id" required>
                                    <option value="">Pilih Layanan</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service['id']; ?>"><?php echo htmlspecialchars($service['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price_min" class="form-label">Harga Minimum (Rp) *</label>
                                <input type="number" class="form-control" id="price_min" name="price_min" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price_max" class="form-label">Harga Maximum (Rp) *</label>
                                <input type="number" class="form-control" id="price_max" name="price_max" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="features" class="form-label">Fitur (satu per baris)</label>
                        <textarea class="form-control" id="features" name="features" rows="4" placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durasi</label>
                                <input type="text" class="form-control" id="duration" name="duration" placeholder="3-5 hari">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="package_type" class="form-label">Tipe Paket</label>
                                <select class="form-select" id="package_type" name="package_type">
                                    <option value="basic">Basic</option>
                                    <option value="standard" selected>Standard</option>
                                    <option value="premium">Premium</option>
                                    <option value="enterprise">Enterprise</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular">
                                    <label class="form-check-label" for="is_popular">Paket Populer</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPackage(id) {
    window.location.href = '<?= BASE_URL ?>admin/packages/edit/' + id;
}

function deletePackage(id, name) {
    if (confirm('Apakah Anda yakin ingin menghapus paket "' + name + '"?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= BASE_URL ?>admin/packages/delete/' + id;

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '<?= CSRF_TOKEN_NAME ?>';
        csrfInput.value = '<?= Router::generateCSRFToken() ?>';
        form.appendChild(csrfInput);

        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-update max price when min price changes
document.getElementById('price_min').addEventListener('input', function() {
    const minPrice = parseInt(this.value) || 0;
    const maxPriceField = document.getElementById('price_max');
    const currentMax = parseInt(maxPriceField.value) || 0;

    if (currentMax < minPrice) {
        maxPriceField.value = minPrice;
    }
});
</script>
