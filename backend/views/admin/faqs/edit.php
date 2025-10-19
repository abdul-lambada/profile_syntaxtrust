<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Edit FAQ</h4>
                        <p class="mb-0">Edit pertanyaan yang sering diajukan</p>
                    </div>
                    <div>
                        <a href="<?= BASE_URL ?>admin/faqs" class="btn btn-secondary">
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
                <form action="<?= BASE_URL ?>admin/faqs/edit/<?= $faq['id'] ?>" method="POST">
                    <?= Router::csrfField() ?>

                    <div class="mb-3">
                        <label for="question" class="form-label">Pertanyaan *</label>
                        <input type="text" class="form-control" id="question" name="question"
                               value="<?= htmlspecialchars($faq['question']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label">Jawaban *</label>
                        <textarea class="form-control" id="answer" name="answer" rows="6" required
                                  placeholder="Tuliskan jawaban lengkap untuk pertanyaan ini...">
                            <?= htmlspecialchars($faq['answer']) ?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Semua Kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"
                                                <?= $faq['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order"
                                       value="<?= htmlspecialchars($faq['sort_order']) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   <?= $faq['is_active'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>admin/faqs" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
