<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Edit Testimonial</h4>
                        <p class="mb-0">Edit testimonial dan review dari klien</p>
                    </div>
                    <div>
                        <a href="<?= BASE_URL ?>admin/testimonials" class="btn btn-secondary">
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
                <form action="<?= BASE_URL ?>admin/testimonials/edit/<?= $testimonial['id'] ?>" method="POST">
                    <?= Router::csrfField() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nama Klien *</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                       value="<?= htmlspecialchars($testimonial['client_name']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_company" class="form-label">Perusahaan/Institusi</label>
                                <input type="text" class="form-control" id="client_company" name="client_company"
                                       value="<?= htmlspecialchars($testimonial['client_company'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="testimonial" class="form-label">Testimonial *</label>
                        <textarea class="form-control" id="testimonial" name="testimonial" rows="4" required
                                  placeholder="Tuliskan testimonial dari klien...">
                            <?= htmlspecialchars($testimonial['testimonial']) ?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating *</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="">Pilih Rating</option>
                                    <option value="5" <?= $testimonial['rating'] == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4" <?= $testimonial['rating'] == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐ (4)</option>
                                    <option value="3" <?= $testimonial['rating'] == 3 ? 'selected' : '' ?>>⭐⭐⭐ (3)</option>
                                    <option value="2" <?= $testimonial['rating'] == 2 ? 'selected' : '' ?>>⭐⭐ (2)</option>
                                    <option value="1" <?= $testimonial['rating'] == 1 ? 'selected' : '' ?>>⭐ (1)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="project_type" class="form-label">Tipe Project</label>
                                <select class="form-select" id="project_type" name="project_type">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Website Tugas" <?= $testimonial['project_type'] === 'Website Tugas' ? 'selected' : '' ?>>Website Tugas</option>
                                    <option value="Modifikasi Website" <?= $testimonial['project_type'] === 'Modifikasi Website' ? 'selected' : '' ?>>Modifikasi Website</option>
                                    <option value="Website Skripsi" <?= $testimonial['project_type'] === 'Website Skripsi' ? 'selected' : '' ?>>Website Skripsi</option>
                                    <option value="General" <?= $testimonial['project_type'] === 'General' ? 'selected' : '' ?>>General</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Layanan</label>
                                <select class="form-select" id="service_id" name="service_id">
                                    <option value="">Pilih Layanan</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service['id']; ?>"
                                                <?= $testimonial['service_id'] == $service['id'] ? 'selected' : '' ?>>
                                            <?php echo htmlspecialchars($service['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                           <?= $testimonial['is_featured'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_featured">Testimonial Unggulan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           <?= $testimonial['is_active'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>admin/testimonials" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
