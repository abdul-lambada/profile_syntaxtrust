<!DOCTYPE html>
<html lang="id" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="Profile Syntaxtrust - Jasa pembuatan website akademik untuk mahasiswa" />
    <meta name="keywords" content="website mahasiswa, tugas kuliah, skripsi, web development akademik" />

    <title><?= isset($page_title) ? $page_title : APP_NAME ?></title>

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

    <!-- Page-specific CSS -->
    <?php if (isset($page_css)): ?>
        <?php foreach ($page_css as $css): ?>
            <link rel="stylesheet" href="<?= ASSETS_URL . $css ?>" />
        <?php endforeach; ?>
    <?php endif; ?>

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
                    <a href="<?= BASE_URL ?>" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="<?= ASSETS_URL ?>img/logo.png" alt="Logo" width="32" />
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Syntaxtrust</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item <?= (basename($_SERVER['SCRIPT_NAME']) == 'index.php') ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Beranda</div>
                        </a>
                    </li>

                    <!-- Services -->
                    <li class="menu-item <?= (basename($_SERVER['SCRIPT_NAME']) == 'services.php') ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>services" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-code-alt"></i>
                            <div data-i18n="Layouts">Layanan</div>
                        </a>
                    </li>

                    <!-- Pricing -->
                    <li class="menu-item <?= (basename($_SERVER['SCRIPT_NAME']) == 'pricing.php') ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>pricing" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-money"></i>
                            <div data-i18n="Tables">Harga</div>
                        </a>
                    </li>

                    <!-- Portfolio -->
                    <li class="menu-item <?= (basename($_SERVER['SCRIPT_NAME']) == 'portfolio.php') ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>portfolio" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-briefcase"></i>
                            <div data-i18n="Tables">Portfolio</div>
                        </a>
                    </li>

                    <!-- Schedule -->
                    <li class="menu-item <?= (basename($_SERVER['SCRIPT_NAME']) == 'schedule.php') ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>schedule" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="Tables">Jadwal</div>
                        </a>
                    </li>

                    <!-- Contact -->
                    <li class="menu-item <?= (basename($_SERVER['SCRIPT_NAME']) == 'contact.php') ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>contact" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-phone"></i>
                            <div data-i18n="Tables">Kontak</div>
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
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Quick Links -->
                            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="bx bx-link-alt bx-sm"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end py-0">
                                    <div class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Quick Links</h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-shortcuts-list scrollable-container">
                                        <div class="row g-0">
                                            <div class="col-6">
                                                <a href="<?= BASE_URL ?>services" class="dropdown-shortcuts-item">
                                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle">
                                                        <i class="bx bx-code-alt"></i>
                                                    </span>
                                                    <span class="dropdown-shortcuts-text">Layanan</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?= BASE_URL ?>pricing" class="dropdown-shortcuts-item">
                                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle">
                                                        <i class="bx bx-money"></i>
                                                    </span>
                                                    <span class="dropdown-shortcuts-text">Harga</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?= BASE_URL ?>portfolio" class="dropdown-shortcuts-item">
                                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle">
                                                        <i class="bx bx-briefcase"></i>
                                                    </span>
                                                    <span class="dropdown-shortcuts-text">Portfolio</span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="<?= BASE_URL ?>contact" class="dropdown-shortcuts-item">
                                                    <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle">
                                                        <i class="bx bx-phone"></i>
                                                    </span>
                                                    <span class="dropdown-shortcuts-text">Kontak</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Contact -->
                            <li class="nav-item">
                                <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', COMPANY_PHONE) ?>" target="_blank" class="btn btn-primary">
                                    <i class="bx bxl-whatsapp me-1"></i> Chat WhatsApp
                                </a>
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
                                - Jasa Pembuatan Website Akademik
                            </div>
                            <div>
                                <a href="https://wa.me/<?= str_replace(['+', ' ', '-'], '', COMPANY_PHONE) ?>" class="footer-link me-4" target="_blank">
                                    <i class="bx bxl-whatsapp"></i> WhatsApp
                                </a>
                                <a href="mailto:<?= COMPANY_EMAIL ?>" class="footer-link me-4">
                                    <i class="bx bx-envelope"></i> Email
                                </a>
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
    </script>
</body>

</html>
