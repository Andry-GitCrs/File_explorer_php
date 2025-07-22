<?php
$path = $_GET['path'] ?? '';

if (!file_exists($path) || !is_file($path)) {
    http_response_code(404);
    exit('File not found');
}

$mime = mime_content_type($path);
header('Content-Type: ' . $mime);
readfile($path);
