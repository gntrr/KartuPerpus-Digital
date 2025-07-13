<?php
// Health check endpoint for Coolify
header('Content-Type: application/json');

$health = [
    'status' => 'healthy',
    'timestamp' => date('Y-m-d H:i:s'),
    'version' => '1.0.0',
    'php_version' => PHP_VERSION,
    'checks' => []
];

// Check if members directory exists and is writable
if (!is_dir('members')) {
    $health['checks']['members_dir'] = [
        'status' => 'error',
        'message' => 'Members directory does not exist'
    ];
    $health['status'] = 'unhealthy';
} elseif (!is_writable('members')) {
    $health['checks']['members_dir'] = [
        'status' => 'warning',
        'message' => 'Members directory is not writable'
    ];
} else {
    $health['checks']['members_dir'] = [
        'status' => 'ok',
        'message' => 'Members directory is accessible'
    ];
}

// Check if public directory exists
if (!is_dir('public')) {
    $health['checks']['public_dir'] = [
        'status' => 'error',
        'message' => 'Public directory does not exist'
    ];
    $health['status'] = 'unhealthy';
} else {
    $health['checks']['public_dir'] = [
        'status' => 'ok',
        'message' => 'Public directory is accessible'
    ];
}

// Check if main files exist
$required_files = ['index.php', 'register.php', 'dashboard.php'];
foreach ($required_files as $file) {
    if (!file_exists($file)) {
        $health['checks']['file_' . pathinfo($file, PATHINFO_FILENAME)] = [
            'status' => 'error',
            'message' => "Required file {$file} does not exist"
        ];
        $health['status'] = 'unhealthy';
    } else {
        $health['checks']['file_' . pathinfo($file, PATHINFO_FILENAME)] = [
            'status' => 'ok',
            'message' => "File {$file} exists"
        ];
    }
}

// Set HTTP status code based on health
if ($health['status'] === 'unhealthy') {
    http_response_code(503);
} else {
    http_response_code(200);
}

echo json_encode($health, JSON_PRETTY_PRINT);
?>
