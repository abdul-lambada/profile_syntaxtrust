<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Kelola FAQ</h4>
                        <p class="mb-0">Kelola pertanyaan yang sering diajukan</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                            <i class="bx bx-plus me-1"></i>Tambah FAQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQs Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Kategori</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php if (!empty($faqs)): ?>
                                <?php foreach ($faqs as $faq): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($faq['question']); ?></strong>
                                            <?php if (!empty($faq['answer'])): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($faq['answer'], 0, 60) . '...'); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($faq['category_name'])): ?>
                                                <span class="badge bg-label-info">
                                                    <?php echo htmlspecialchars($faq['category_name']); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-label-secondary">Semua Kategori</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($faq['sort_order']); ?></td>
                                        <td>
                                            <span class="badge bg-label-<?php echo $faq['is_active'] ? 'success' : 'danger'; ?>">
                                                <?php echo $faq['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y', strtotime($faq['created_at'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="editFaq(<?php echo $faq['id']; ?>)">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deleteFaq(<?php echo $faq['id']; ?>, '<?php echo htmlspecialchars($faq['question']); ?>')">
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
                                        <i class="bx bx-help-circle" style="font-size: 48px; color: #ddd;"></i>
                                        <p class="mt-3 text-muted">Belum ada FAQ</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                                            Tambah FAQ Pertama
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

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= BASE_URL ?>admin/faqs" method="POST">
                <?= Router::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addFaqModalLabel">Tambah FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question" class="form-label">Pertanyaan *</label>
                        <input type="text" class="form-control" id="question" name="question" required
                               placeholder="Masukkan pertanyaan yang sering diajukan">
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label">Jawaban *</label>
                        <textarea class="form-control" id="answer" name="answer" rows="6" required
                                  placeholder="Tuliskan jawaban lengkap untuk pertanyaan ini..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Semua Kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">Aktif</label>
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
function editFaq(id) {
    window.location.href = '<?= BASE_URL ?>admin/faqs/edit/' + id;
}

function deleteFaq(id, question) {
    if (confirm('Apakah Anda yakin ingin menghapus FAQ: "' + question + '"?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= BASE_URL ?>admin/faqs/delete/' + id;

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
