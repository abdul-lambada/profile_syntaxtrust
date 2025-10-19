<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Kelola Portfolio</h4>
                        <p class="mb-0">Kelola showcase project dan studi kasus</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                            <i class="bx bx-plus me-1"></i>Tambah Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Judul Project</th>
                                <th>Layanan</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Featured</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php if (!empty($portfolio_items)): ?>
                                <?php foreach ($portfolio_items as $item): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($item['title']); ?></strong>
                                            <?php if (!empty($item['description'])): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($item['description'], 0, 60) . '...'); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">
                                                <?php echo htmlspecialchars($item['service_name'] ?? 'Tidak ada layanan'); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($item['client_name'] ?? '-'); ?></td>
                                        <td>
                                            <span class="badge bg-label-<?php
                                                echo match($item['status']) {
                                                    'completed' => 'success',
                                                    'in_progress' => 'warning',
                                                    'planning' => 'info',
                                                    default => 'secondary'
                                                }; ?>">
                                                <?php echo ucfirst(str_replace('_', ' ', $item['status'] ?? 'Unknown')); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($item['project_date'] ?? '-'); ?></td>
                                        <td>
                                            <span class="badge bg-label-<?php echo $item['is_featured'] ? 'primary' : 'secondary'; ?>">
                                                <?php echo $item['is_featured'] ? 'Ya' : 'Tidak'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="editPortfolio(<?php echo $item['id']; ?>)">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deletePortfolio(<?php echo $item['id']; ?>, '<?php echo htmlspecialchars($item['title']); ?>')">
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
                                        <i class="bx bx-briefcase" style="font-size: 48px; color: #ddd;"></i>
                                        <p class="mt-3 text-muted">Belum ada portfolio</p>
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                                            Tambah Portfolio Pertama
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

<!-- Add Portfolio Modal -->
<div class="modal fade" id="addPortfolioModal" tabindex="-1" aria-labelledby="addPortfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= BASE_URL ?>admin/portfolio" method="POST">
                <?= Router::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addPortfolioModalLabel">Tambah Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Project *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
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
                        <label for="description" class="form-label">Deskripsi Project *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nama Client</label>
                                <input type="text" class="form-control" id="client_name" name="client_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_type" class="form-label">Tipe Project</label>
                                <select class="form-select" id="project_type" name="project_type">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Website Tugas">Website Tugas</option>
                                    <option value="Modifikasi Website">Modifikasi Website</option>
                                    <option value="Website Skripsi">Website Skripsi</option>
                                    <option value="Custom Website">Custom Website</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_date" class="form-label">Tanggal Project</label>
                                <input type="date" class="form-control" id="project_date" name="project_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_url" class="form-label">URL Project</label>
                                <input type="url" class="form-control" id="project_url" name="project_url" placeholder="https://example.com">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="challenge" class="form-label">Challenge/Tantangan</label>
                        <textarea class="form-control" id="challenge" name="challenge" rows="2" placeholder="Tantangan yang dihadapi dalam project..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="solution" class="form-label">Solution/Penyelesaian</label>
                        <textarea class="form-control" id="solution" name="solution" rows="2" placeholder="Bagaimana tantangan diselesaikan..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="results" class="form-label">Results/Hasil</label>
                        <textarea class="form-control" id="results" name="results" rows="2" placeholder="Hasil yang dicapai dari project..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Project</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="planning">Planning</option>
                                    <option value="in_progress" selected>Dalam Pengerjaan</option>
                                    <option value="review">Review</option>
                                    <option value="completed" selected>Selesai</option>
                                    <option value="delivered">Diserahkan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured">
                                    <label class="form-check-label" for="is_featured">Featured Project</label>
                                </div>
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
function editPortfolio(id) {
    window.location.href = '<?= BASE_URL ?>admin/portfolio/edit/' + id;
}

function deletePortfolio(id, title) {
    if (confirm('Apakah Anda yakin ingin menghapus portfolio "' + title + '"?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= BASE_URL ?>admin/portfolio/delete/' + id;

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
