<?php
/**
 * Profile Syntaxtrust - Frontend Entry Point
 * Serves the React application for public access
 */

// Redirect to React app or serve static files
$request_uri = $_SERVER['REQUEST_URI'];

// Serve React app for public routes
if ($request_uri === '/' || strpos($request_uri, '/services') === 0 || strpos($request_uri, '/portfolio') === 0 ||
    strpos($request_uri, '/pricing') === 0 || strpos($request_uri, '/contact') === 0 || strpos($request_uri, '/schedule') === 0) {

    // Check if React build exists
    if (file_exists(__DIR__ . '/frontend/dist/index.html')) {
        readfile(__DIR__ . '/frontend/dist/index.html');
        exit;
    }
}

// Serve API requests to backend
if (strpos($request_uri, '/api/') === 0 || strpos($request_uri, '/admin/') === 0) {
    // Rewrite to backend
    $_SERVER['SCRIPT_NAME'] = '/backend/index.php';
    $_SERVER['PHP_SELF'] = '/backend/index.php';
    require_once __DIR__ . '/backend/index.php';
    exit;
}

// Serve static files from React build
$file_path = __DIR__ . '/frontend/dist' . $request_uri;
if (file_exists($file_path) && !is_dir($file_path)) {
    $mime_types = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject'
    ];

    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if (isset($mime_types[$ext])) {
        header('Content-Type: ' . $mime_types[$ext]);
    }

    readfile($file_path);
    exit;
}

// Default: serve React app
if (file_exists(__DIR__ . '/frontend/dist/index.html')) {
    readfile(__DIR__ . '/frontend/dist/index.html');
} else {
    echo '<h1>Welcome to Profile Syntaxtrust</h1>';
    echo '<p>React frontend is not built yet. Please run <code>npm run build</code> in the frontend directory.</p>';
}
?>
