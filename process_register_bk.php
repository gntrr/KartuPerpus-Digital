<?php
$nama = $_POST['nama'] ?? '';
$nim = $_POST['nim'] ?? '';
$kelas = $_POST['kelas'] ?? '';
$prodi = $_POST['prodi'] ?? '';

if (!preg_match('/^[0-9]{8,}$/', $nim)) {
    header("Location: register.php?error=nim_invalid");
    exit;
}

$file = "members/{$nim}.json";
if (file_exists($file)) {
    header("Location: register.php?error=nim_exists");
    exit;
}

$identity_hash = hash('sha256', $nama . $nim);
if (!file_exists('members')) mkdir('members');

$data = [
    'nama' => $nama,
    'nim' => $nim,
    'kelas' => $kelas,
    'prodi' => $prodi,
    'hash' => $identity_hash
];

file_put_contents($file, json_encode($data));
header("Location: dashboard.php?nim=" . urlencode($nim) . "&status=success");
exit;
?>
