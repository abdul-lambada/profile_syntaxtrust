<!DOCTYPE html>
<html lang="id" class="light-style customizer-hide" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin Login - <?= APP_NAME ?></title>

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

    <!-- Page -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>vendor/css/pages/page-auth.css" />

    <!-- Custom CSS -->
    <style>
        .auth-cover-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3B82F6;
        }

        .auth-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card auth-cover-bg">
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Side (Branding) -->
                            <div class="col-lg-6 d-none d-lg-flex align-items-center auth-cover-bg">
                                <div class="flex-grow-1 px-3">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="brand-logo mb-4">
                                            <img src="<?= ASSETS_URL ?>img/logo.png" alt="Logo" width="40" class="me-2" />
                                            Syntaxtrust
                                        </div>
                                        <h3 class="text-white mb-3">Admin Panel</h3>
                                        <p class="text-white opacity-75">
                                            Kelola website dan konten Syntaxtrust dengan mudah melalui panel admin yang powerful.
                                        </p>
                                        <div class="d-flex gap-3 mt-4">
                                            <div class="text-center">
                                                <div class="avatar avatar-lg">
                                                    <span class="avatar-initial bg-white bg-opacity-20 text-white rounded-circle">
                                                        <i class="bx bx-code-alt"></i>
                                                    </span>
                                                </div>
                                                <p class="text-white opacity-75 mt-2 small">Layanan</p>
                                            </div>
                                            <div class="text-center">
                                                <div class="avatar avatar-lg">
                                                    <span class="avatar-initial bg-white bg-opacity-20 text-white rounded-circle">
                                                        <i class="bx bx-briefcase"></i>
                                                    </span>
                                                </div>
                                                <p class="text-white opacity-75 mt-2 small">Portfolio</p>
                                            </div>
                                            <div class="text-center">
                                                <div class="avatar avatar-lg">
                                                    <span class="avatar-initial bg-white bg-opacity-20 text-white rounded-circle">
                                                        <i class="bx bx-calendar"></i>
                                                    </span>
                                                </div>
                                                <p class="text-white opacity-75 mt-2 small">Booking</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side (Login Form) -->
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <!-- Logo -->
                                    <div class="app-brand justify-content-center mb-4">
                                        <a href="<?= BASE_URL ?>" class="app-brand-link gap-2">
                                            <span class="app-brand-logo demo">
                                                <img src="<?= ASSETS_URL ?>img/logo.png" alt="Logo" width="32" />
                                            </span>
                                            <span class="app-brand-text demo menu-text fw-bolder">Admin Login</span>
                                        </a>
                                    </div>

                                    <!-- Form -->
                                    <form id="formAuthentication" class="mb-3" action="<?= BASE_URL ?>admin/authenticate" method="POST">
                                        <?= Router::csrfField() ?>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                placeholder="Masukkan email admin"
                                                autofocus
                                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
                                            <?php if (isset($errors['email'])): ?>
                                                <div class="form-text text-danger"><?php echo $errors['email']; ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3 form-password-toggle">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label" for="password">Password</label>
                                                <a href="<?= BASE_URL ?>admin/forgot-password">
                                                    <small>Lupa Password?</small>
                                                </a>
                                            </div>
                                            <div class="input-group input-group-merge">
                                                <input
                                                    type="password"
                                                    id="password"
                                                    class="form-control"
                                                    name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <span class="input-group-text cursor-pointer">
                                                    <i class="bx bx-hide bx-sm"></i>
                                                </span>
                                            </div>
                                            <?php if (isset($errors['password'])): ?>
                                                <div class="form-text text-danger"><?php echo $errors['password']; ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Remember me -->
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                                <label class="form-check-label" for="remember-me"> Ingat saya </label>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid w-100" type="submit">
                                                Masuk ke Admin Panel
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Footer -->
                                    <div class="text-center">
                                        <p class="mb-0">
                                            <a href="<?= BASE_URL ?>" class="text-decoration-none">
                                                ← Kembali ke Website
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="<?= ASSETS_URL ?>vendor/libs/jquery/jquery.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/libs/popper/popper.js"></script>
    <script src="<?= ASSETS_URL ?>vendor/js/bootstrap.js"></script>

    <!-- Password visibility toggle -->
    <script>
        $(document).ready(function() {
            $('.input-group-text').on('click', function() {
                var $input = $(this).siblings('input');
                var $icon = $(this).find('i');

                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    $input.attr('type', 'password');
                    $icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
        });
    </script>
</body>

</html>
