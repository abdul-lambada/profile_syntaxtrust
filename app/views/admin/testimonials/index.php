<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Kelola Testimonial</h4>
                        <p class="mb-0">Kelola testimonial dan review dari klien</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                            <i class="bx bx-plus me-1"></i>Tambah Testimonial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Klien</th>
                                <th>Perusahaan</th>
                                <th>Rating</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php if (!empty($testimonials)): ?>
                                <?php foreach ($testimonials as $testimonial): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($testimonial['client_name']); ?></strong>
                                        </td>
                                        <td><?php echo htmlspecialchars($testimonial['client_company'] ?? '-'); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="bx bx-star <?php echo $i <= $testimonial['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                                <?php endfor; ?>
                                                <span class="ms-1">(<?php echo $testimonial['rating']; ?>)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">
                                                <?php echo htmlspecialchars($testimonial['project_type'] ?? 'General'); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-<?php echo $testimonial['is_featured'] ? 'primary' : 'secondary'; ?>">
                                                <?php echo $testimonial['is_featured'] ? 'Featured' : 'Regular'; ?>
                                            </span>
                                            <br>
                                            <span class="badge bg-label-<?php echo $testimonial['is_active'] ? 'success' : 'danger'; ?> mt-1">
                                                <?php echo $testimonial['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($testimonial['created_at'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="editTestimonial(<?php echo $testimonial['id']; ?>)">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deleteTestimonial(<?php echo $testimonial['id']; ?>, '<?php echo htmlspecialchars($testimonial['client_name']); ?>')">
                                                        <i class="bx bx-trash me-1"></i> Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="bx bx-star" style="font-size: 48px; color: #ddd;"></i>
                                        <p class="mt-3 text-muted">Belum ada testimonial</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                                            Tambah Testimonial Pertama
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

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= BASE_URL ?>admin/testimonials" method="POST">
                <?= Router::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestimonialModalLabel">Tambah Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nama Klien *</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_company" class="form-label">Perusahaan/Institusi</label>
                                <input type="text" class="form-control" id="client_company" name="client_company">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="testimonial" class="form-label">Testimonial *</label>
                        <textarea class="form-control" id="testimonial" name="testimonial" rows="4" required placeholder="Tuliskan testimonial dari klien..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating *</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="">Pilih Rating</option>
                                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4)</option>
                                    <option value="3">⭐⭐⭐ (3)</option>
                                    <option value="2">⭐⭐ (2)</option>
                                    <option value="1">⭐ (1)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="project_type" class="form-label">Tipe Project</label>
                                <select class="form-select" id="project_type" name="project_type">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Website Tugas">Website Tugas</option>
                                    <option value="Modifikasi Website">Modifikasi Website</option>
                                    <option value="Website Skripsi">Website Skripsi</option>
                                    <option value="General">General</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Layanan</label>
                                <select class="form-select" id="service_id" name="service_id">
                                    <option value="">Pilih Layanan</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service['id']; ?>"><?php echo htmlspecialchars($service['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured">
                                    <label class="form-check-label" for="is_featured">Testimonial Unggulan</label>
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
function editTestimonial(id) {
    window.location.href = '<?= BASE_URL ?>admin/testimonials/edit/' + id;
}

function deleteTestimonial(id, name) {
    if (confirm('Apakah Anda yakin ingin menghapus testimonial dari "' + name + '"?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= BASE_URL ?>admin/testimonials/delete/' + id;

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '<?= CSRF_TOKEN_NAME ?>';
        csrfInput.value = '<?= Router::generateCSRFToken() ?>';
        form.appendChild(csrfInput);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
