<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Beranda</h4>
                        <p class="mb-0">Selamat datang di Profile Syntaxtrust</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                            <a class="dropdown-item" href="<?= BASE_URL ?>contact">Hubungi Kami</a>
                            <a class="dropdown-item" href="<?= BASE_URL ?>schedule">Jadwal Konsultasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-primary text-white">
            <div class="card-body text-center py-5">
                <h2 class="text-white mb-3">Website Akademik Berkualitas</h2>
                <p class="lead mb-4">Kami membantu mahasiswa mewujudkan ide akademik melalui website profesional</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#services" class="btn btn-light btn-lg">Lihat Layanan</a>
                    <a href="<?= BASE_URL ?>schedule" class="btn btn-outline-light btn-lg">Konsultasi Gratis</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Overview -->
<div class="row mb-4" id="services">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Layanan Kami</h5>
                <a href="<?= BASE_URL ?>services" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($featured_services)): ?>
                        <?php foreach ($featured_services as $service): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="avatar mx-auto mb-3" style="width: 60px; height: 60px; background-color: #e7f3ff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bx <?= $service['icon'] ?> text-primary" style="font-size: 24px;"></i>
                                        </div>
                                        <h6 class="card-title mb-2"><?php echo htmlspecialchars($service['name']); ?></h6>
                                        <p class="card-text small text-muted"><?php echo htmlspecialchars(substr($service['description'], 0, 100) . '...'); ?></p>
                                        <a href="<?= BASE_URL ?>services" class="btn btn-outline-primary btn-sm">Pelajari Lebih Lanjut</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bx bx-code-alt" style="font-size: 48px; color: #ddd;"></i>
                                <p class="mt-3 text-muted">Layanan akan segera ditambahkan</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Showcase -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Portfolio Terbaru</h5>
                <a href="<?= BASE_URL ?>portfolio" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($portfolio_items)): ?>
                        <?php foreach ($portfolio_items as $item): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2"><?php echo htmlspecialchars($item['title']); ?></h6>
                                        <p class="card-text small text-muted mb-3">
                                            <?php echo htmlspecialchars(substr($item['description'], 0, 80) . '...'); ?>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-label-info">
                                                <?php echo htmlspecialchars($item['project_type'] ?? 'Project'); ?>
                                            </span>
                                            <small class="text-muted">
                                                <?php echo htmlspecialchars($item['project_date'] ?? ''); ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bx bx-briefcase" style="font-size: 48px; color: #ddd;"></i>
                                <p class="mt-3 text-muted">Portfolio akan segera ditambahkan</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Apa Kata Klien Kami</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($testimonials as $testimonial): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="avatar me-3">
                                            <span class="avatar-initial bg-label-primary rounded-circle">
                                                <?php echo strtoupper(substr($testimonial['client_name'], 0, 2)); ?>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0"><?php echo htmlspecialchars($testimonial['client_name']); ?></h6>
                                            <small class="text-muted">
                                                <?php echo htmlspecialchars($testimonial['client_company'] ?? 'Mahasiswa'); ?>
                                            </small>
                                        </div>
                                        <div class="ms-auto">
                                            <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                                <i class="bx bxs-star text-warning"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="card-text">"<?php echo htmlspecialchars(substr($testimonial['testimonial'], 0, 100) . '...'); ?>"</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Quick Stats -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-1">50+</h4>
                            <small class="text-muted">Project Selesai</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-1">98%</h4>
                            <small class="text-muted">Kepuasan Klien</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-1">24/7</h4>
                            <small class="text-muted">Support</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex flex-column">
                            <h4 class="mb-1">3</h4>
                            <small class="text-muted">Tahun Pengalaman</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="row">
    <div class="col-12">
        <div class="card bg-gradient-primary text-white">
            <div class="card-body text-center py-4">
                <h4 class="text-white mb-3">Siap Memulai Project Anda?</h4>
                <p class="mb-4">Konsultasikan kebutuhan website akademik Anda dengan tim kami</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?= BASE_URL ?>schedule" class="btn btn-light btn-lg">Jadwal Konsultasi</a>
                    <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', COMPANY_PHONE) ?>" target="_blank" class="btn btn-outline-light btn-lg">
                        <i class="bx bxl-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
