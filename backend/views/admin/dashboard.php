<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Dashboard Admin</h4>
                        <p class="mb-0">Selamat datang di panel admin Syntaxtrust</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                            <a class="dropdown-item" href="<?= BASE_URL ?>admin/settings">Pengaturan</a>
                            <a class="dropdown-item" href="<?= BASE_URL ?>">Lihat Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Total Layanan</p>
                        <div class="d-flex align-items-end">
                            <h4 class="card-title mb-0 me-2"><?php echo $stats['total_services'] ?? 0; ?></h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-code-alt bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Total Portfolio</p>
                        <div class="d-flex align-items-end">
                            <h4 class="card-title mb-0 me-2"><?php echo $stats['total_portfolio'] ?? 0; ?></h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-info rounded p-2">
                            <i class="bx bx-briefcase bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Booking Pending</p>
                        <div class="d-flex align-items-end">
                            <h4 class="card-title mb-0 me-2"><?php echo $stats['pending_bookings'] ?? 0; ?></h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-calendar bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-info">
                        <p class="card-text">Pesan Baru</p>
                        <div class="d-flex align-items-end">
                            <h4 class="card-title mb-0 me-2"><?php echo $stats['new_messages'] ?? 0; ?></h4>
                        </div>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded p-2">
                            <i class="bx bx-message bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity and Quick Actions -->
<div class="row">
    <!-- Recent Activity -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                <a href="#" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <?php if (!empty($recent_activity)): ?>
                    <div class="timeline">
                        <?php foreach ($recent_activity as $activity): ?>
                            <div class="timeline-item">
                                <div class="timeline-marker bg-label-<?= $activity['type'] === 'booking' ? 'warning' : 'info' ?>"></div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">
                                        <?php if ($activity['type'] === 'booking'): ?>
                                            Booking Baru: <?php echo htmlspecialchars($activity['title']); ?>
                                        <?php else: ?>
                                            Pesan Baru: <?php echo htmlspecialchars($activity['title']); ?>
                                        <?php endif; ?>
                                    </h6>
                                    <p class="timeline-text">
                                        Status: <span class="badge bg-label-<?= $activity['status'] === 'pending' ? 'warning' : 'success' ?>">
                                            <?php echo htmlspecialchars($activity['status']); ?>
                                        </span>
                                    </p>
                                    <small class="text-muted">
                                        <?php echo date('d M Y, H:i', strtotime($activity['date'])); ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bx bx-time" style="font-size: 48px; color: #ddd;"></i>
                        <p class="mt-3 text-muted">Belum ada aktivitas</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="<?= BASE_URL ?>admin/services/create" class="btn btn-primary">
                        <i class="bx bx-plus me-2"></i>Tambah Layanan
                    </a>
                    <a href="<?= BASE_URL ?>admin/portfolio/create" class="btn btn-info">
                        <i class="bx bx-plus me-2"></i>Tambah Portfolio
                    </a>
                    <a href="<?= BASE_URL ?>admin/testimonials/create" class="btn btn-success">
                        <i class="bx bx-plus me-2"></i>Tambah Testimonial
                    </a>
                    <a href="<?= BASE_URL ?>admin/settings" class="btn btn-secondary">
                        <i class="bx bx-cog me-2"></i>Pengaturan
                    </a>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Status Sistem</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Database</span>
                    <span class="badge bg-label-success">Connected</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>PHP Version</span>
                    <span class="badge bg-label-info"><?php echo PHP_VERSION; ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Server Time</span>
                    <small class="text-muted"><?php echo date('d M Y, H:i:s'); ?></small>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Memory Usage</span>
                    <small class="text-muted">
                        <?php echo round(memory_get_usage() / 1024 / 1024, 2); ?> MB
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Services and Bookings -->
<div class="row">
    <!-- Recent Services -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Layanan Terbaru</h5>
                <a href="<?= BASE_URL ?>admin/services" class="btn btn-primary btn-sm">Kelola</a>
            </div>
            <div class="card-body">
                <?php if (!empty($services)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($services as $service): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($service['name']); ?></h6>
                                    <small class="text-muted">
                                        <?php echo htmlspecialchars($service['description']); ?>
                                    </small>
                                </div>
                                <span class="badge bg-label-<?= $service['is_featured'] ? 'primary' : 'secondary' ?>">
                                    <?php echo $service['is_featured'] ? 'Featured' : 'Regular'; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bx bx-code-alt" style="font-size: 48px; color: #ddd;"></i>
                        <p class="mt-3 text-muted">Belum ada layanan</p>
                        <a href="<?= BASE_URL ?>admin/services/create" class="btn btn-primary btn-sm">
                            Tambah Layanan Pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Pending Bookings -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Booking Pending</h5>
                <a href="<?= BASE_URL ?>admin/bookings" class="btn btn-warning btn-sm">Kelola</a>
            </div>
            <div class="card-body">
                <?php if (!empty($pending_bookings)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($pending_bookings as $booking): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($booking['client_name']); ?></h6>
                                    <small class="text-muted">
                                        <?php echo htmlspecialchars($booking['service_name']); ?> -
                                        <?php echo date('d M Y, H:i', strtotime($booking['booking_date'] . ' ' . $booking['booking_time'])); ?>
                                    </small>
                                </div>
                                <span class="badge bg-label-warning">Pending</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bx bx-check-circle" style="font-size: 48px; color: #28a745;"></i>
                        <p class="mt-3 text-muted">Tidak ada booking pending</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- New Messages -->
<?php if (!empty($new_messages)): ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Pesan Baru</h5>
                <a href="<?= BASE_URL ?>admin/messages" class="btn btn-success btn-sm">Kelola</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($new_messages as $message): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="d-flex align-items-start mb-2">
                                        <div class="avatar me-3">
                                            <span class="avatar-initial bg-label-info rounded-circle">
                                                <?php echo strtoupper(substr($message['name'], 0, 1)); ?>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0"><?php echo htmlspecialchars($message['name']); ?></h6>
                                            <small class="text-muted"><?php echo htmlspecialchars($message['email']); ?></small>
                                        </div>
                                    </div>
                                    <p class="card-text small mb-2">
                                        <?php echo htmlspecialchars(substr($message['message'], 0, 100) . '...'); ?>
                                    </p>
                                    <small class="text-muted">
                                        <?php echo date('d M Y, H:i', strtotime($message['created_at'])); ?>
                                    </small>
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

<!-- Custom CSS for timeline -->
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.timeline-content {
    margin-left: 10px;
}

.timeline-title {
    margin-bottom: 5px;
    font-size: 14px;
    font-weight: 600;
}

.timeline-text {
    margin-bottom: 5px;
    font-size: 13px;
}
</style>
