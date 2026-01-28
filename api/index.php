<?php
// Vercel PHP Router - Route all requests to public/index.php

// Get the request path
$request_path = $_SERVER['REQUEST_URI'];

// Remove query string
if (strpos($request_path, '?') !== false) {
    $request_path = substr($request_path, 0, strpos($request_path, '?'));
}

// Remove leading slash
$request_path = ltrim($request_path, '/');

// If empty or root, treat as dashboard
if (empty($request_path) || $request_path === '/') {
    $_GET['action'] = $_GET['action'] ?? 'dashboard';
    include __DIR__ . '/../public/index.php';
    exit;
}

// Route to public/index.php with query string preserved
include __DIR__ . '/../public/index.php';
?>
