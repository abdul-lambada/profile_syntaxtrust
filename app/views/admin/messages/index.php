<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Kelola Pesan Kontak</h4>
                        <p class="mb-0">Kelola pesan dan pertanyaan dari klien</p>
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

<!-- Messages Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php if (!empty($messages)): ?>
                                <?php foreach ($messages as $message): ?>
                                    <tr class="<?php echo $message['status'] === 'new' ? 'table-primary' : ''; ?>">
                                        <td>
                                            <strong><?php echo htmlspecialchars($message['name']); ?></strong>
                                        </td>
                                        <td><?php echo htmlspecialchars($message['email']); ?></td>
                                        <td><?php echo htmlspecialchars($message['phone'] ?? '-'); ?></td>
                                        <td>
                                            <div title="<?php echo htmlspecialchars($message['message']); ?>">
                                                <?php echo htmlspecialchars(substr($message['message'], 0, 50) . '...'); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-<?php
                                                echo match($message['status']) {
                                                    'new' => 'primary',
                                                    'read' => 'info',
                                                    'responded' => 'success',
                                                    'closed' => 'secondary',
                                                    default => 'secondary'
                                                }; ?>">
                                                <?php echo ucfirst($message['status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d M Y, H:i', strtotime($message['created_at'])); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="viewMessage(<?php echo $message['id']; ?>)">
                                                        <i class="bx bx-show me-1"></i> Lihat Detail
                                                    </a>
                                                    <?php if ($message['status'] !== 'responded' && $message['status'] !== 'closed'): ?>
                                                        <a class="dropdown-item" href="#" onclick="respondMessage(<?php echo $message['id']; ?>)">
                                                            <i class="bx bx-reply me-1"></i> Balas
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if ($message['status'] !== 'closed'): ?>
                                                        <a class="dropdown-item text-success" href="#" onclick="closeMessage(<?php echo $message['id']; ?>)">
                                                            <i class="bx bx-check me-1"></i> Tutup
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="bx bx-message" style="font-size: 48px; color: #ddd;"></i>
                                        <p class="mt-3 text-muted">Belum ada pesan kontak</p>
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

<!-- Message Detail Modal -->
<div class="modal fade" id="messageDetailModal" tabindex="-1" aria-labelledby="messageDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageDetailModalLabel">Detail Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messageDetailContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Respond Message Modal -->
<div class="modal fade" id="respondMessageModal" tabindex="-1" aria-labelledby="respondMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="respondMessageForm" method="POST">
                <?= Router::csrfField() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="respondMessageModalLabel">Balas Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="response" class="form-label">Balasan Anda *</label>
                        <textarea class="form-control" id="response" name="response" rows="6" required placeholder="Tuliskan balasan untuk klien..."></textarea>
                    </div>
                    <div class="alert alert-info">
                        <small>Balasan akan dikirim ke email klien dan status pesan akan diubah menjadi "Direspons".</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Balasan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function viewMessage(id) {
    // In a real implementation, this would fetch message details via AJAX
    // For now, we'll show a placeholder
    document.getElementById('messageDetailContent').innerHTML = `
        <div class="text-center py-4">
            <i class="bx bx-message-detail" style="font-size: 48px; color: #ddd;"></i>
            <p class="mt-3 text-muted">Detail pesan akan dimuat di sini</p>
            <p class="text-muted">ID Pesan: ${id}</p>
        </div>
    `;

    new bootstrap.Modal(document.getElementById('messageDetailModal')).show();
}

function respondMessage(id) {
    // Set form action
    document.getElementById('respondMessageForm').action = '<?= BASE_URL ?>admin/messages/respond/' + id;

    // Reset form
    document.getElementById('response').value = '';

    new bootstrap.Modal(document.getElementById('respondMessageModal')).show();
}

function closeMessage(id) {
    if (confirm('Apakah Anda yakin ingin menutup pesan ini?')) {
        window.location.href = '<?= BASE_URL ?>admin/messages/close/' + id;
    }
}

// Auto-refresh page every 30 seconds to check for new messages
setTimeout(function() {
    if (<?= time() % 30 === 0 ? 'true' : 'false' ?>) {
        location.reload();
    }
}, 30000);
</script>
