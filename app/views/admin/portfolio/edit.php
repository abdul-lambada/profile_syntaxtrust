<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Edit Portfolio</h4>
                        <p class="mb-0">Edit informasi project portfolio</p>
                    </div>
                    <div>
                        <a href="<?= BASE_URL ?>admin/portfolio" class="btn btn-secondary">
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
                <form action="<?= BASE_URL ?>admin/portfolio/edit/<?= $portfolio['id'] ?>" method="POST">
                    <?= Router::csrfField() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Project *</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="<?= htmlspecialchars($portfolio['title']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Layanan *</label>
                                <select class="form-select" id="service_id" name="service_id" required>
                                    <option value="">Pilih Layanan</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service['id']; ?>"
                                                <?= $portfolio['service_id'] == $service['id'] ? 'selected' : '' ?>>
                                            <?php echo htmlspecialchars($service['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Project *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required
                                  placeholder="Deskripsi singkat tentang project ini...">
                            <?= htmlspecialchars($portfolio['description']) ?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nama Client</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                       value="<?= htmlspecialchars($portfolio['client_name'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_type" class="form-label">Tipe Project</label>
                                <select class="form-select" id="project_type" name="project_type">
                                    <option value="">Pilih Tipe</option>
                                    <option value="Website Tugas" <?= $portfolio['project_type'] === 'Website Tugas' ? 'selected' : '' ?>>Website Tugas</option>
                                    <option value="Modifikasi Website" <?= $portfolio['project_type'] === 'Modifikasi Website' ? 'selected' : '' ?>>Modifikasi Website</option>
                                    <option value="Website Skripsi" <?= $portfolio['project_type'] === 'Website Skripsi' ? 'selected' : '' ?>>Website Skripsi</option>
                                    <option value="Custom Website" <?= $portfolio['project_type'] === 'Custom Website' ? 'selected' : '' ?>>Custom Website</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_date" class="form-label">Tanggal Project</label>
                                <input type="date" class="form-control" id="project_date" name="project_date"
                                       value="<?= htmlspecialchars($portfolio['project_date'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_url" class="form-label">URL Project</label>
                                <input type="url" class="form-control" id="project_url" name="project_url"
                                       value="<?= htmlspecialchars($portfolio['project_url'] ?? '') ?>"
                                       placeholder="https://example.com">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="challenge" class="form-label">Challenge/Tantangan</label>
                        <textarea class="form-control" id="challenge" name="challenge" rows="2"
                                  placeholder="Tantangan yang dihadapi dalam project...">
                            <?= htmlspecialchars($portfolio['challenge'] ?? '') ?>
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="solution" class="form-label">Solution/Penyelesaian</label>
                        <textarea class="form-control" id="solution" name="solution" rows="2"
                                  placeholder="Bagaimana tantangan diselesaikan...">
                            <?= htmlspecialchars($portfolio['solution'] ?? '') ?>
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="results" class="form-label">Results/Hasil</label>
                        <textarea class="form-control" id="results" name="results" rows="2"
                                  placeholder="Hasil yang dicapai dari project...">
                            <?= htmlspecialchars($portfolio['results'] ?? '') ?>
                        </textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Project</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="planning" <?= $portfolio['status'] === 'planning' ? 'selected' : '' ?>>Planning</option>
                                    <option value="in_progress" <?= $portfolio['status'] === 'in_progress' ? 'selected' : '' ?>>Dalam Pengerjaan</option>
                                    <option value="review" <?= $portfolio['status'] === 'review' ? 'selected' : '' ?>>Review</option>
                                    <option value="completed" <?= $portfolio['status'] === 'completed' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="delivered" <?= $portfolio['status'] === 'delivered' ? 'selected' : '' ?>>Diserahkan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                           <?= $portfolio['is_featured'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_featured">Featured Project</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                           <?= $portfolio['is_active'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_active">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>admin/portfolio" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
