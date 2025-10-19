<!DOCTYPE html>
<html lang="id" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= isset($page_title) ? $page_title : 'Admin - ' . APP_NAME ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= ASSETS_URL ?>img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/libs/apex-charts/apex-charts.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/style.css" />
    <link rel="stylesheet" href="<?= ASSETS_URL ?>css/admin.css" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?= $csrf_token ?>" />
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="<?= BASE_URL ?>admin/dashboard" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="<?= ASSETS_URL ?>img/logo.png" alt="Logo" width="32" />
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="<?= BASE_URL ?>admin/dashboard" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <!-- Content Management -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Content Management</span>
                    </li>

                    <!-- Services -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/services" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-code-alt"></i>
                            <div data-i18n="Layouts">Layanan</div>
                        </a>
                    </li>

                    <!-- Categories -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/categories" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div data-i18n="Tables">Kategori</div>
                        </a>
                    </li>

                    <!-- Packages -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/packages" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-money"></i>
                            <div data-i18n="Tables">Paket Harga</div>
                        </a>
                    </li>

                    <!-- Portfolio -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/portfolio" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-briefcase"></i>
                            <div data-i18n="Tables">Portfolio</div>
                        </a>
                    </li>

                    <!-- Testimonials -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/testimonials" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Tables">Testimonial</div>
                        </a>
                    </li>

                    <!-- Communications -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Communications</span>
                    </li>

                    <!-- Bookings -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/bookings" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="Tables">Booking</div>
                        </a>
                    </li>

                    <!-- Messages -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/messages" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-message"></i>
                            <div data-i18n="Tables">Pesan</div>
                        </a>
                    </li>

                    <!-- Content -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Content</span>
                    </li>

                    <!-- FAQs -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/faqs" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-help-circle"></i>
                            <div data-i18n="Tables">FAQ</div>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/settings" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div data-i18n="Tables">Pengaturan</div>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="menu-item">
                        <a href="<?= BASE_URL ?>admin/logout" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-log-out"></i>
                            <div data-i18n="Tables">Logout</div>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Welcome message -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <span class="text-heading">Selamat datang, <?= $_SESSION['admin_name'] ?? 'Admin' ?>!</span>
                            </div>
                        </div>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Notifications -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="bx bx-bell bx-sm"></i>
                                    <span class="badge bg-danger rounded-pill badge-notifications">
                                        <?= ($stats['pending_bookings'] ?? 0) + ($stats['new_messages'] ?? 0) ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Notifikasi</h5>
                                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read">
                                                <i class="bx bx-check-double"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <?php if (($stats['new_messages'] ?? 0) > 0): ?>
                                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <span class="avatar-initial bg-label-info rounded-circle">
                                                                    <i class="bx bx-message"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Pesan Baru</h6>
                                                            <p class="mb-0">Ada <?= $stats['new_messages'] ?> pesan baru yang perlu direspons</p>
                                                            <small class="text-muted">Baru saja</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="<?= BASE_URL ?>admin/messages" class="dropdown-notifications-read">
                                                                <span class="badge badge-dot"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (($stats['pending_bookings'] ?? 0) > 0): ?>
                                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <span class="avatar-initial bg-label-warning rounded-circle">
                                                                    <i class="bx bx-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Booking Pending</h6>
                                                            <p class="mb-0">Ada <?= $stats['pending_bookings'] ?> booking yang perlu dikonfirmasi</p>
                                                            <small class="text-muted">Baru saja</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="<?= BASE_URL ?>admin/bookings" class="dropdown-notifications-read">
                                                                <span class="badge badge-dot"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?= ASSETS_URL ?>img/avatars/admin.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="<?= BASE_URL ?>admin/settings">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?= ASSETS_URL ?>img/avatars/admin.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">Admin</span>
                                                    <small class="text-muted">Administrator</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/settings">Pengaturan</a></li>
                                    <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php if ($this->hasSuccess()): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php foreach ($this->getSuccess() as $success): ?>
                                    <p class="mb-0"><?php echo $success; ?></p>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->hasErrors()): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php foreach ($this->getErrors() as $error): ?>
                                    <p class="mb-0"><?php echo $error; ?></p>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Page content -->
                        <?php echo $content ?? ''; ?>
                    </div>

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © <?= date('Y') ?>,
                                <a href="https://syntaxtrust.com" target="_blank" class="footer-link fw-bolder">Syntaxtrust</a>
                                - Admin Panel
                            </div>
                            <div>
                                <span class="footer-text">Version 1.0.0</span>
                            </div>
                        </div>
                    </footer>

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <script src="<?= ASSETS_URL ?>vendor/libs/jquery/jquery.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/popper/popper.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/js/bootstrap.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <!-- Main JS -->
    <script src="<?= ASSETS_URL ?>js/main.js"></script>

    <!-- Custom JS -->
    <script src="<?= ASSETS_URL ?>js/admin.js"></script>

    <!-- Page-specific JS -->
    <?php if (isset($page_js)): ?>
        <?php foreach ($page_js as $js): ?>
            <script src="<?= ASSETS_URL . $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Custom JS -->
    <script>
        // CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Confirm delete actions
        $('[data-confirm]').on('click', function(e) {
            var message = $(this).data('confirm');
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>
