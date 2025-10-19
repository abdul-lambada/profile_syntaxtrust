<!-- Page header -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold py-3 mb-1">Pengaturan Sistem</h4>
                        <p class="mb-0">Kelola pengaturan aplikasi dan konfigurasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Settings Sections -->
<div class="row">
    <!-- General Settings -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengaturan Umum</h5>
                <div class="mb-3">
                    <label for="app_name" class="form-label">Nama Aplikasi</label>
                    <input type="text" class="form-control" id="app_name" value="Profile Syntaxtrust">
                </div>
                <div class="mb-3">
                    <label for="app_description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="app_description" rows="3">Website development services for academic projects</textarea>
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Email Kontak</label>
                    <input type="email" class="form-control" id="contact_email" value="contact@syntaxtrust.com">
                </div>
                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Telepon Kontak</label>
                    <input type="tel" class="form-control" id="contact_phone" value="+62 812-3456-7890">
                </div>
            </div>
        </div>
    </div>

    <!-- Email Settings -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengaturan Email</h5>
                <div class="mb-3">
                    <label for="smtp_host" class="form-label">SMTP Host</label>
                    <input type="text" class="form-control" id="smtp_host" value="smtp.gmail.com">
                </div>
                <div class="mb-3">
                    <label for="smtp_port" class="form-label">SMTP Port</label>
                    <input type="number" class="form-control" id="smtp_port" value="587">
                </div>
                <div class="mb-3">
                    <label for="smtp_username" class="form-label">SMTP Username</label>
                    <input type="text" class="form-control" id="smtp_username" value="noreply@syntaxtrust.com">
                </div>
                <div class="mb-3">
                    <label for="smtp_password" class="form-label">SMTP Password</label>
                    <input type="password" class="form-control" id="smtp_password" value="">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah password</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Settings -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengaturan Keamanan</h5>
                <div class="mb-3">
                    <label for="session_timeout" class="form-label">Timeout Session (menit)</label>
                    <input type="number" class="form-control" id="session_timeout" value="60">
                </div>
                <div class="mb-3">
                    <label for="max_login_attempts" class="form-label">Maksimal Percobaan Login</label>
                    <input type="number" class="form-control" id="max_login_attempts" value="5">
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="enable_csrf" checked>
                        <label class="form-check-label" for="enable_csrf">Aktifkan CSRF Protection</label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="enable_logging" checked>
                        <label class="form-check-label" for="enable_logging">Aktifkan Logging Aktivitas</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Settings -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengaturan Bisnis</h5>
                <div class="mb-3">
                    <label for="business_hours" class="form-label">Jam Operasional</label>
                    <input type="text" class="form-control" id="business_hours" value="Senin - Jumat: 08:00 - 17:00 WIB">
                </div>
                <div class="mb-3">
                    <label for="response_time" class="form-label">Waktu Respons (jam)</label>
                    <input type="number" class="form-control" id="response_time" value="24">
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="weekend_support">
                        <label class="form-check-label" for="weekend_support">Dukungan Akhir Pekan</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="default_currency" class="form-label">Mata Uang Default</label>
                    <select class="form-select" id="default_currency">
                        <option value="IDR" selected>Rupiah (IDR)</option>
                        <option value="USD">US Dollar (USD)</option>
                        <option value="EUR">Euro (EUR)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Save Settings Button -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-0">Pastikan semua pengaturan sudah benar sebelum menyimpan.</p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary me-2">Reset</button>
                        <button type="button" class="btn btn-primary">Simpan Pengaturan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Settings form handling would go here
// For now, just basic form validation
document.querySelector('.btn-primary').addEventListener('click', function() {
    // Validate required fields
    const appName = document.getElementById('app_name').value.trim();
    const contactEmail = document.getElementById('contact_email').value.trim();

    if (!appName) {
        alert('Nama aplikasi tidak boleh kosong');
        return;
    }

    if (!contactEmail || !contactEmail.includes('@')) {
        alert('Email kontak tidak valid');
        return;
    }

    // In a real implementation, this would submit the form via AJAX
    alert('Pengaturan berhasil disimpan!');

    // Show success message
    const btn = this;
    const originalText = btn.textContent;
    btn.textContent = 'Tersimpan!';
    btn.classList.remove('btn-primary');
    btn.classList.add('btn-success');

    setTimeout(() => {
        btn.textContent = originalText;
        btn.classList.remove('btn-success');
        btn.classList.add('btn-primary');
    }, 2000);
});
</script>
