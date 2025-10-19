<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Edit Paket Harga</h4>
                        <p class="mb-0">Edit informasi paket harga</p>
                    </div>
                    <div>
                        <a href="<?= BASE_URL ?>admin/packages" class="btn btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Form -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= BASE_URL ?>admin/packages/edit/<?= $package['id'] ?>" method="POST">
                    <?= Router::csrfField() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Paket *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="<?= htmlspecialchars($package['name']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Layanan *</label>
                                <select class="form-select" id="service_id" name="service_id" required>
                                    <option value="">Pilih Layanan</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service['id']; ?>"
                                                <?= $package['service_id'] == $service['id'] ? 'selected' : '' ?>>
                                            <?php echo htmlspecialchars($service['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                                  placeholder="Deskripsi paket..."><?= htmlspecialchars($package['description'] ?? '') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price_min" class="form-label">Harga Minimum (Rp) *</label>
                                <input type="number" class="form-control" id="price_min" name="price_min"
                                       value="<?= htmlspecialchars($package['price_min']) ?>" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price_max" class="form-label">Harga Maximum (Rp) *</label>
                                <input type="number" class="form-control" id="price_max" name="price_max"
                                       value="<?= htmlspecialchars($package['price_max']) ?>" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="features" class="form-label">Fitur (satu per baris)</label>
                        <textarea class="form-control" id="features" name="features" rows="4"
                                  placeholder="Fitur 1&#10;Fitur 2&#10;Fitur 3">
                            <?php
                            if (!empty($package['features'])) {
                                $features = is_string($package['features']) ? json_decode($package['features'], true) : $package['features'];
                                echo htmlspecialchars(implode("\n", $features ?? []));
                            }
                            ?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durasi</label>
                                <input type="text" class="form-control" id="duration" name="duration"
                                       value="<?= htmlspecialchars($package['duration'] ?? '') ?>"
                                       placeholder="3-5 hari">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="package_type" class="form-label">Tipe Paket</label>
                                <select class="form-select" id="package_type" name="package_type">
                                    <option value="basic" <?= $package['package_type'] === 'basic' ? 'selected' : '' ?>>Basic</option>
                                    <option value="standard" <?= $package['package_type'] === 'standard' ? 'selected' : '' ?>>Standard</option>
                                    <option value="premium" <?= $package['package_type'] === 'premium' ? 'selected' : '' ?>>Premium</option>
                                    <option value="enterprise" <?= $package['package_type'] === 'enterprise' ? 'selected' : '' ?>>Enterprise</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order"
                                       value="<?= htmlspecialchars($package['sort_order']) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular"
                                           <?= $package['is_popular'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_popular">Paket Populer</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           <?= $package['is_active'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>admin/packages" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
