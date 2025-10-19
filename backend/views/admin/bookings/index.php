<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Kelola Booking Konsultasi</h4>
                        <p class="mb-0">Kelola jadwal konsultasi dengan klien</p>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                            <a class="dropdown-item" href="#">Export Data</a>
                            <a class="dropdown-item" href="#">Filter Status</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Client</th>
                                <th>Layanan</th>
                                <th>Tanggal & Waktu</th>
                                <th>Status</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php if (!empty($bookings)): ?>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($booking['client_name']); ?></strong>
                                            <?php if (!empty($booking['requirements'])): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($booking['requirements'], 0, 50) . '...'); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">
                                                <?php echo htmlspecialchars($booking['service_name'] ?? 'Tidak ada layanan'); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong><?php echo date('d M Y', strtotime($booking['booking_date'])); ?></strong>
                                            <br><small class="text-muted"><?php echo date('H:i', strtotime($booking['booking_time'])); ?> WIB</small>
                                        </td>
                                        <td>
                                            <?php
                                            $statusClass = match($booking['status']) {
                                                'pending' => 'warning',
                                                'confirmed' => 'primary',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                                default => 'secondary'
                                            };
                                            ?>
                                            <span class="badge bg-label-<?php echo $statusClass; ?>">
                                                <?php echo ucfirst($booking['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div><?php echo htmlspecialchars($booking['client_email']); ?></div>
                                            <?php if (!empty($booking['client_phone'])): ?>
                                                <small class="text-muted"><?php echo htmlspecialchars($booking['client_phone']); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="editBooking(<?php echo $booking['id']; ?>)">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <?php if ($booking['status'] === 'pending'): ?>
                                                        <a class="dropdown-item" href="#" onclick="confirmBooking(<?php echo $booking['id']; ?>)">
                                                            <i class="bx bx-check me-1"></i> Konfirmasi
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if ($booking['status'] === 'confirmed'): ?>
                                                        <a class="dropdown-item" href="#" onclick="completeBooking(<?php echo $booking['id']; ?>)">
                                                            <i class="bx bx-check-circle me-1"></i> Selesai
                                                        </a>
                                                    <?php endif; ?>

                                                    <a class="dropdown-item text-danger" href="#" onclick="cancelBooking(<?php echo $booking['id']; ?>, '<?php echo htmlspecialchars($booking['client_name']); ?>')">
                                                        <i class="bx bx-x me-1"></i> Batal
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bx bx-calendar" style="font-size: 48px; color: #ddd;"></i>
                                        <p class="mt-3 text-muted">Belum ada booking konsultasi</p>
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

<!-- Cancel Booking Modal -->
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
function editBooking(id) {
    window.location.href = '<?= BASE_URL ?>admin/bookings/edit/' + id;
}

function confirmBooking(id) {
    if (confirm('Apakah Anda yakin ingin mengkonfirmasi booking ini? Email konfirmasi akan dikirim ke client.')) {
        window.location.href = '<?= BASE_URL ?>admin/bookings/confirm/' + id;
    }
}

function completeBooking(id) {
    if (confirm('Apakah Anda yakin booking ini sudah selesai?')) {
        window.location.href = '<?= BASE_URL ?>admin/bookings/complete/' + id;
    }
}

function cancelBooking(id, clientName) {
    document.getElementById('cancelClientName').textContent = clientName;
    document.getElementById('cancelBookingForm').action = '<?= BASE_URL ?>admin/bookings/cancel/' + id;

    // Reset form
    document.getElementById('cancellation_reason').value = '';

    new bootstrap.Modal(document.getElementById('cancelBookingModal')).show();
}
</script>
