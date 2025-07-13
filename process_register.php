<?php
// Include config
require_once 'config.php';

// CSRF protection (recommended)
session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    header("Location: register.php?error=invalid_request");
    exit;
}

$nama = $_POST['nama'] ?? '';
$nim = $_POST['nim'] ?? '';
$kelas = $_POST['kelas'] ?? '';
$prodi = $_POST['prodi'] ?? '';

// Validate inputs
if (!preg_match('/^[0-9]{8,}$/', $nim)) {
    header("Location: register.php?error=nim_invalid");
    exit;
}

$file = MEMBERS_DIR . "/{$nim}.json";
if (file_exists($file)) {
    header("Location: register.php?error=nim_exists");
    exit;
}

$identity_hash = hash('sha256', $nama . $nim);

$data = [
    'nama' => htmlspecialchars($nama),
    'nim' => htmlspecialchars($nim),
    'kelas' => htmlspecialchars($kelas),
    'prodi' => htmlspecialchars($prodi),
    'hash' => $identity_hash,
    'created_at' => date('Y-m-d H:i:s')
];

if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
    header("Location: dashboard.php?nim=" . urlencode($nim) . "&status=success");
} else {
    header("Location: register.php?error=save_failed");
}
exit;
?>