<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $subject ?? 'Syntaxtrust' ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #3B82F6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .highlight {
            background: #e7f3ff;
            padding: 15px;
            border-left: 4px solid #3B82F6;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Syntaxtrust</div>
            <h2>Website Akademik Berkualitas</h2>
        </div>

        <div class="content">
            <h3>Konfirmasi Booking Konsultasi</h3>

            <p>Halo <strong><?= $client_name ?></strong>,</p>

            <p>Terima kasih telah melakukan booking konsultasi dengan Syntaxtrust. Berikut adalah detail konsultasi Anda:</p>

            <div class="highlight">
                <p><strong>Layanan:</strong> <?= $service_name ?></p>
                <p><strong>Tanggal:</strong> <?= $booking_date ?></p>
                <p><strong>Waktu:</strong> <?= $booking_time ?> WIB</p>
                <p><strong>Tipe Meeting:</strong> <?= ucfirst(str_replace('_', ' ', $meeting_type)) ?></p>
                <?php if (!empty($requirements)): ?>
                    <p><strong>Kebutuhan:</strong> <?= $requirements ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($meeting_link)): ?>
                <p><strong>Link Meeting:</strong> <a href="<?= $meeting_link ?>"><?= $meeting_link ?></a></p>
            <?php endif; ?>

            <p>Silakan hadir tepat waktu. Jika ada perubahan jadwal, mohon hubungi kami minimal 12 jam sebelumnya.</p>

            <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami:</p>
            <ul>
                <li>Email: <?= $company_email ?></li>
                <li>WhatsApp: <?= $company_phone ?></li>
            </ul>

            <p>Terima kasih atas kepercayaan Anda pada Syntaxtrust!</p>

            <p>Hormat kami,<br>Tim Syntaxtrust</p>
        </div>

        <div class="footer">
            <p>&copy; 2024 Syntaxtrust. All rights reserved.</p>
            <p>Jasa Pembuatan Website Akademik untuk Mahasiswa</p>
        </div>
    </div>
</body>
</html>
