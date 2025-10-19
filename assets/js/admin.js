// Admin Panel - Custom JavaScript

$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Confirm delete actions
    $('[data-confirm]').on('click', function(e) {
        var message = $(this).data('confirm') || 'Apakah Anda yakin ingin menghapus data ini?';
        if (!confirm(message)) {
            e.preventDefault();
        }
    });

    // Form validation enhancement
    $('form').on('submit', function(e) {
        var $form = $(this);
        var hasErrors = false;

        // Check required fields
        $form.find('[required]').each(function() {
            var $field = $(this);
            if (!$field.val().trim()) {
                $field.addClass('is-invalid');
                hasErrors = true;
            } else {
                $field.removeClass('is-invalid');
            }
        });

        // Check email fields
        $form.find('input[type="email"]').each(function() {
            var $field = $(this);
            var email = $field.val().trim();
            if (email && !isValidEmail(email)) {
                $field.addClass('is-invalid');
                hasErrors = true;
            } else {
                $field.removeClass('is-invalid');
            }
        });

        if (hasErrors) {
            e.preventDefault();
            showNotification('Silakan lengkapi semua field yang wajib diisi', 'danger');
        }
    });

    // Real-time form validation
    $('input[required], select[required]').on('blur', function() {
        var $field = $(this);
        if (!$field.val().trim()) {
            $field.addClass('is-invalid');
        } else {
            $field.removeClass('is-invalid');
        }
    });

    // Email validation
    $('input[type="email"]').on('blur', function() {
        var $field = $(this);
        var email = $field.val().trim();
        if (email && !isValidEmail(email)) {
            $field.addClass('is-invalid');
        } else {
            $field.removeClass('is-invalid');
        }
    });

    // Phone validation for Indonesian numbers
    $('input[name*="phone"]').on('blur', function() {
        var $field = $(this);
        var phone = $field.val().trim();
        if (phone && !isValidIndonesianPhone(phone)) {
            $field.addClass('is-invalid');
        } else {
            $field.removeClass('is-invalid');
        }
    });

    // AJAX form submissions for better UX
    $('form[data-ajax="true"]').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var originalText = $submitBtn.text();

        // Show loading state
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Memproses...');

        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: $form.serialize(),
            success: function(response) {
                if (response.success) {
                    showNotification(response.message || 'Data berhasil disimpan', 'success');
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1500);
                    }
                } else {
                    showNotification(response.message || 'Terjadi kesalahan', 'danger');
                }
            },
            error: function(xhr) {
                var message = 'Terjadi kesalahan server';
                try {
                    var response = JSON.parse(xhr.responseText);
                    message = response.message || message;
                } catch (e) {}
                showNotification(message, 'danger');
            },
            complete: function() {
                // Restore button
                $submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Dynamic form fields (for features, etc.)
    $('[data-add-field]').on('click', function() {
        var $container = $($(this).data('target'));
        var $template = $($container.data('template'));
        var $newField = $template.clone().removeClass('d-none').appendTo($container);

        // Focus on new field
        $newField.find('input, textarea, select').first().focus();
    });

    $('[data-remove-field]').on('click', function() {
        $(this).closest('.dynamic-field').remove();
    });

    // Image preview for file uploads
    $('input[type="file"][data-preview]').on('change', function() {
        var $input = $(this);
        var $preview = $($input.data('preview'));

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $preview.attr('src', e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});

// Utility functions
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidIndonesianPhone(phone) {
    // Indonesian phone number patterns
    var phoneRegex = /^(\+62|62|0)8[1-9][0-9]{6,11}$/;
    return phoneRegex.test(phone);
}

function showNotification(message, type = 'info') {
    var $alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">' +
        message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>');

    $('body').append($alert);

    // Auto-remove after 5 seconds
    setTimeout(function() {
        $alert.fadeOut('slow', function() {
            $alert.remove();
        });
    }, 5000);
}

// Format currency (Indonesian Rupiah)
function formatCurrency(amount) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
}

// Format date (Indonesian format)
function formatDate(dateString, format = 'dd MMM yyyy') {
    var date = new Date(dateString);
    var options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    };

    if (format === 'dd MMM yyyy HH:mm') {
        options.hour = '2-digit';
        options.minute = '2-digit';
    }

    return date.toLocaleDateString('id-ID', options);
}

// Slug generator
function generateSlug(text) {
    return text
        .toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

// Copy to clipboard
function copyToClipboard(text) {
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val(text).select();
    document.execCommand('copy');
    $temp.remove();
    showNotification('Teks berhasil disalin', 'success');
}
