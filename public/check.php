<?php
// Temporary diagnostic page. Remove this file after debugging on remote hosts.
http_response_code(200);
header('Content-Type: text/plain; charset=UTF-8');

function mask($v) {
    if ($v === null || $v === '') return '(not set)';
    $s = (string)$v;
    if (strlen($s) <= 6) return str_repeat('*', strlen($s));
    return substr($s,0,3) . str_repeat('*', max(1, strlen($s)-6)) . substr($s,-3);
}

echo "Autotrack diagnostic check\n";
echo "PHP version: " . PHP_VERSION . "\n";
echo "SAPI: " . PHP_SAPI . "\n";
echo "Document root: " . ($_SERVER['DOCUMENT_ROOT'] ?? '(unknown)') . "\n";
echo "Script filename: " . ($_SERVER['SCRIPT_FILENAME'] ?? '(unknown)') . "\n";

$envs = [
    'APP_ENV','APP_URL','DB_HOST','DB_PORT','DB_DATABASE','DB_USERNAME','DB_PASSWORD','DB_SSL_CA'
];
foreach ($envs as $k) {
    $v = getenv($k);
    echo sprintf("%s=%s\n", $k, mask($v));
}

// Try a PDO connection if DB credentials are present
$host = getenv('DB_HOST');
$db = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT') ?: 3306;

if ($host && $db && $user) {
    echo "\nAttempting PDO connection...\n";
    try {
        $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
        $opts = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        // If DB_SSL_CA is provided as a path to a CA file, try to set MYSQL_ATTR_SSL_CA
        $sslca = getenv('DB_SSL_CA');
        if ($sslca) {
            // if the value looks like PEM content, skip (not safe here); only set if it's a path
            if (file_exists($sslca)) {
                $opts[PDO::MYSQL_ATTR_SSL_CA] = $sslca;
            }
        }
        $pdo = new PDO($dsn, $user, $pass, $opts);
        echo "PDO connection OK (connected to {$db}@{$host}:{$port})\n";
    } catch (Throwable $e) {
        echo "PDO connection failed: " . $e->getMessage() . "\n";
    }
} else {
    echo "\nDB credentials missing or incomplete; skipping PDO test.\n";
}

echo "\nTemporary check complete. Remove this file when finished.\n";

?>
