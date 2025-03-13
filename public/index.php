<?php
session_start(); // Mulai session

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../core/Router.php';
require __DIR__ . '/../routes/web.php';

// Ambil URI dan method dari request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Redirect jika ada trailing slash (kecuali untuk root)
if ($uri !== '/' && substr($uri, -1) === '/') {
    header('Location: ' . rtrim($uri, '/'));
    exit;
}

// Dispatch route dan tangani error
try {
    $router->dispatch($uri, $method);
} catch (\Exception $e) {
    http_response_code(404);
    require __DIR__ . '/../app/Views/404.php'; // Tampilkan halaman error custom
    exit;
}
