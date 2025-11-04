<?php
// Bootstrap fallback for hosts that use `public/` as the document root (Render, some PHP platforms).
// This file simply forwards requests to the application front controller located at the project root.

// Resolve the path to the project root (one level up)
$rootIndex = __DIR__ . '/../index.php';

if (file_exists($rootIndex)) {
    require_once $rootIndex;
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo "<h1>500 Internal Server Error</h1><p>Application front controller not found.</p>";
}
