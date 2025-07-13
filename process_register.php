<?php
// Include config
require_once 'config.php';

// CSRF protection (recommended)
session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    logError('CSRF token validation failed', ['ip' => getClientIP()]);
    header("Location: register.php?error=invalid_request");
    exit;
}

$nama = sanitizeInput($_POST['nama'] ?? '');
$nim = sanitizeInput($_POST['nim'] ?? '');
$kelas = sanitizeInput($_POST['kelas'] ?? '');
$prodi = sanitizeInput($_POST['prodi'] ?? '');

// Validate inputs
if (!validateNIM($nim)) {
    logError('Invalid NIM format', ['nim' => $nim, 'ip' => getClientIP()]);
    header("Location: register.php?error=nim_invalid");
    exit;
}

if (empty($nama) || empty($nim) || empty($kelas) || empty($prodi)) {
    logError('Empty required fields', ['ip' => getClientIP()]);
    header("Location: register.php?error=required_fields");
    exit;
}

$file = MEMBERS_DIR . "/{$nim}.json";
if (file_exists($file)) {
    logError('NIM already exists', ['nim' => $nim, 'ip' => getClientIP()]);
    header("Location: register.php?error=nim_exists");
    exit;
}

$identity_hash = hash('sha256', $nama . $nim);

$data = [
    'nama' => $nama,
    'nim' => $nim,
    'kelas' => $kelas,
    'prodi' => $prodi,
    'hash' => $identity_hash,
    'created_at' => date('Y-m-d H:i:s'),
    'ip_address' => getClientIP()
];

if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
    logMemberRegistration($nim, $nama, 'success');
    header("Location: dashboard.php?nim=" . urlencode($nim) . "&status=success");
} else {
    logError('Failed to save member data', ['nim' => $nim, 'nama' => $nama, 'ip' => getClientIP()]);
    header("Location: register.php?error=save_failed");
}
exit;
?>