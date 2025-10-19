<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Edit Booking Konsultasi</h4>
                        <p class="mb-0">Edit informasi booking konsultasi</p>
                    </div>
                    <div>
                        <a href="<?= BASE_URL ?>admin/bookings" class="btn btn-secondary">
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
                <form action="<?= BASE_URL ?>admin/bookings/edit/<?= $booking['id'] ?>" method="POST">
                    <?= Router::csrfField() ?>

                    <!-- Current Status Badge -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-label-<?php
                                echo match($booking['status']) {
                                    'pending' => 'warning',
                                    'confirmed' => 'primary',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                }; ?> fs-6 me-2">
                                Status: <?php echo ucfirst($booking['status']); ?>
                            </span>
                            <?php if ($booking['status'] === 'confirmed' && !empty($booking['meeting_link'])): ?>
                                <a href="<?php echo htmlspecialchars($booking['meeting_link']); ?>" target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-video me-1"></i>Link Meeting
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nama Klien *</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                       value="<?= htmlspecialchars($booking['client_name']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_email" class="form-label">Email Klien *</label>
                                <input type="email" class="form-control" id="client_email" name="client_email"
                                       value="<?= htmlspecialchars($booking['client_email']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_phone" class="form-label">Telepon Klien</label>
                                <input type="tel" class="form-control" id="client_phone" name="client_phone"
                                       value="<?= htmlspecialchars($booking['client_phone'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Layanan *</label>
                                <select class="form-select" id="service_id" name="service_id" required>
                                    <option value="">Pilih Layanan</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?php echo $service['id']; ?>"
                                                <?= $booking['service_id'] == $service['id'] ? 'selected' : '' ?>>
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
                                <label for="booking_date" class="form-label">Tanggal Booking *</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date"
                                       value="<?= htmlspecialchars($booking['booking_date']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="booking_time" class="form-label">Waktu Booking *</label>
                                <input type="time" class="form-control" id="booking_time" name="booking_time"
                                       value="<?= htmlspecialchars($booking['booking_time']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="meeting_type" class="form-label">Tipe Meeting</label>
                                <select class="form-select" id="meeting_type" name="meeting_type">
                                    <option value="online" <?= $booking['meeting_type'] === 'online' ? 'selected' : '' ?>>Online</option>
                                    <option value="offline" <?= $booking['meeting_type'] === 'offline' ? 'selected' : '' ?>>Offline</option>
                                    <option value="phone" <?= $booking['meeting_type'] === 'phone' ? 'selected' : '' ?>>Telepon</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Status can be updated via separate actions -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="requirements" class="form-label">Kebutuhan/Pertanyaan</label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="4"
                                  placeholder="Jelaskan kebutuhan project atau pertanyaan yang ingin didiskusikan...">
                            <?= htmlspecialchars($booking['requirements'] ?? '') ?>
                        </textarea>
                    </div>

                    <!-- Action Buttons for Status Changes -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="card-title">Aksi Booking</h6>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <?php if ($booking['status'] === 'pending'): ?>
                                            <a href="<?= BASE_URL ?>admin/bookings/confirm/<?= $booking['id'] ?>"
                                               class="btn btn-success btn-sm"
                                               onclick="return confirm('Konfirmasi booking ini? Email akan dikirim ke client.')">
                                                <i class="bx bx-check me-1"></i>Konfirmasi
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($booking['status'] === 'confirmed'): ?>
                                            <a href="<?= BASE_URL ?>admin/bookings/complete/<?= $booking['id'] ?>"
                                               class="btn btn-primary btn-sm"
                                               onclick="return confirm('Tandai booking ini sebagai selesai?')">
                                                <i class="bx bx-check-circle me-1"></i>Selesai
                                            </a>
                                        <?php endif; ?>

                                        <a href="#" class="btn btn-danger btn-sm"
                                           onclick="cancelBooking(<?= $booking['id'] ?>, '<?= htmlspecialchars($booking['client_name']) ?>')">
                                            <i class="bx bx-x me-1"></i>Batalkan
                                        </a>

                                        <?php if ($booking['status'] === 'completed'): ?>
                                            <span class="badge bg-label-success">Sudah Selesai</span>
                                        <?php endif; ?>

                                        <?php if ($booking['status'] === 'cancelled'): ?>
                                            <span class="badge bg-label-danger">Dibatalkan</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>admin/bookings" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Booking Modal (same as in index) -->
<div class="modal fade" id="cancelBookingModal" tabindex="-1" aria-labelledby="cancelBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="cancelBookingForm" method="POST">
                <?= Router::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelBookingModalLabel">Batalkan Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin membatalkan booking dari <strong id="cancelClientName"></strong>?</p>
                    <div class="mb-3">
                        <label for="cancellation_reason" class="form-label">Alasan Pembatalan</label>
                        <textarea class="form-control" id="cancellation_reason" name="cancellation_reason" rows="3" placeholder="Berikan alasan pembatalan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Batalkan Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function cancelBooking(id, clientName) {
    document.getElementById('cancelClientName').textContent = clientName;
    document.getElementById('cancelBookingForm').action = '<?= BASE_URL ?>admin/bookings/cancel/' + id;

    // Reset form
    document.getElementById('cancellation_reason').value = '';

    new bootstrap.Modal(document.getElementById('cancelBookingModal')).show();
}

// Auto-fill current date if empty
document.addEventListener('DOMContentLoaded', function() {
    const dateField = document.getElementById('booking_date');
    if (dateField && !dateField.value) {
        const today = new Date().toISOString().split('T')[0];
        dateField.value = today;
    }
});
</script>
