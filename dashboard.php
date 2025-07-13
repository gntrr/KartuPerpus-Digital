<?php
$nim = $_GET['nim'] ?? '';
$status = $_GET['status'] ?? '';
$file = "members/{$nim}.json";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Dashboard Keanggotaan - KartuPerpus Digital</title>
  <link rel="stylesheet" href="public/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dashboard keanggotaan perpustakaan digital dengan informasi lengkap dan statistik">
  <link href="public/Font-Awesome-6.x/css/all.min.css" rel="stylesheet">
  <script src="public/chart.js/chart.js"></script>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-logo">
        <i class="fas fa-book-open"></i>
        <span>KartuPerpus Digital</span>
      </div>
      <div class="nav-toggle" id="navToggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <div class="nav-menu" id="navMenu">
        <a href="index.php" class="nav-link">Beranda</a>
        <a href="index.php#check" class="nav-link active">Dashboard</a>
        <a href="index.php#about" class="nav-link">Tentang</a>
        <a href="register.php" class="nav-link register-btn">Daftar</a>
      </div>
    </div>
  </nav>

  <!-- Dashboard Section -->
  <section class="dashboard-section">
    <div class="container">
      
      <!-- Status Messages -->
      <?php if (isset($_GET['error'])): ?>
      <div class="status-message error-message slide-in-down">
        <div class="message-icon">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="message-content">
          <?php if ($_GET['error'] === 'nim_exists'): ?>
            <h3>NIM Sudah Digunakan!</h3>
            <p>NIM yang Anda masukkan sudah terdaftar dalam sistem. Silakan cek kembali atau gunakan NIM yang berbeda.</p>
          <?php elseif ($_GET['error'] === 'nim_invalid'): ?>
            <h3>Format NIM Tidak Valid!</h3>
            <p>NIM harus berupa angka dengan minimal 8 digit. Silakan periksa kembali NIM Anda.</p>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($status == 'success'): ?>
      <div class="status-message success-message slide-in-down">
        <div class="message-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="message-content">
          <h3>Registrasi Berhasil!</h3>
          <p>Selamat! Anda telah berhasil terdaftar sebagai anggota perpustakaan digital. Berikut adalah informasi keanggotaan Anda:</p>
        </div>
      </div>
      <?php endif; ?>

      <?php if (file_exists($file)):
        $data = json_decode(file_get_contents($file), true);
      ?>
        <!-- Member Dashboard -->
        <div class="dashboard-content fade-in-up">
          <!-- Member Card -->
          <div class="member-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fas fa-id-card"></i>
              </div>
              <div class="card-title">
                <h2>Dashboard Keanggotaan Perpustakaan</h2>
                <p>Informasi lengkap anggota perpustakaan digital</p>
              </div>
              <div class="card-status">
                <span class="status-badge active">
                  <i class="fas fa-check-circle"></i>
                  Aktif
                </span>
              </div>
            </div>
            
            <div class="card-body">
              <div class="member-info">
                <div class="info-grid">
                  <div class="info-item">
                    <div class="info-icon">
                      <i class="fas fa-user"></i>
                    </div>
                    <div class="info-content">
                      <label>Nama Lengkap</label>
                      <span><?= htmlspecialchars($data['nama']) ?></span>
                    </div>
                  </div>

                  <div class="info-item">
                    <div class="info-icon">
                      <i class="fas fa-id-badge"></i>
                    </div>
                    <div class="info-content">
                      <label>NIM</label>
                      <span><?= htmlspecialchars($data['nim']) ?></span>
                    </div>
                  </div>

                  <div class="info-item">
                    <div class="info-icon">
                      <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="info-content">
                      <label>Kelas</label>
                      <span><?= htmlspecialchars($data['kelas']) ?></span>
                    </div>
                  </div>

                  <div class="info-item">
                    <div class="info-icon">
                      <i class="fas fa-university"></i>
                    </div>
                    <div class="info-content">
                      <label>Program Studi</label>
                      <span><?= htmlspecialchars($data['prodi']) ?></span>
                    </div>
                  </div>
                </div>

                <div class="security-section">
                  <div class="security-header">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Hash Identitas Keamanan</h3>
                  </div>
                  <div class="hash-container">
                    <code class="security-hash"><?= $data['hash'] ?></code>
                    <button class="copy-btn" onclick="copyToClipboard('<?= $data['hash'] ?>')">
                      <i class="fas fa-copy"></i>
                      <span>Salin</span>
                    </button>
                  </div>
                  <p class="security-note">
                    <i class="fas fa-info-circle"></i>
                    Hash ini adalah identitas digital unik Anda yang dienkripsi dengan teknologi SHA-256 untuk keamanan maksimal.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="quick-actions-section">
            <h3>Aksi Cepat</h3>
            <div class="actions-grid">
              <button class="action-card" onclick="window.print()">
                <i class="fas fa-print"></i>
                <span>Cetak Kartu</span>
              </button>
              <button class="action-card" onclick="downloadCard()">
                <i class="fas fa-download"></i>
                <span>Unduh PDF</span>
              </button>
              <button class="action-card" onclick="shareCard()">
                <i class="fas fa-share-alt"></i>
                <span>Bagikan</span>
              </button>
            </div>
          </div>
        </div>

      <?php else: ?>
        <!-- Member Not Found -->
        <div class="not-found-section fade-in-up">
          <div class="not-found-card">
            <div class="not-found-icon">
              <i class="fas fa-user-slash"></i>
            </div>
            <h2 style="color: var(--white);">Data Mahasiswa Tidak Ditemukan</h2>
            <p style="color: var(--gray-100);">Maaf, data untuk NIM <strong><?= htmlspecialchars($nim) ?></strong> tidak ditemukan dalam sistem kami.</p>
            
            <div class="not-found-actions">
              <a href="register.php" class="btn btn-primary">
                <i class="fas fa-user-plus"></i>
                Daftar Sekarang
              </a>
              <a href="index.php#check" class="btn btn-secondary">
                <i class="fas fa-search"></i>
                Cek NIM Lain
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Statistics Section -->
      <div class="statistics-section fade-in-up">
        <h2 class="section-title">📊 Statistik Keanggotaan</h2>
        
        <div class="charts-container">
          <div class="chart-card">
            <h3>Pendaftaran per Minggu</h3>
            <canvas id="chartPendaftaran"></canvas>
          </div>
          
          <div class="chart-card">
            <h3>Distribusi Program Studi</h3>
            <canvas id="chartProdi"></canvas>
          </div>
        </div>
      </div>

      <!-- Navigation Actions -->
      <div class="navigation-actions fade-in-up">
        <a href="index.php" class="nav-action primary">
          <i class="fas fa-home"></i>
          <span>Kembali ke Beranda</span>
        </a>
        <a href="register.php" class="nav-action secondary">
          <i class="fas fa-user-plus"></i>
          <span>Daftar Anggota Baru</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-logo">
          <i class="fas fa-book-open"></i>
          <span>KartuPerpus Digital</span>
        </div>
        <p>&copy; 2025 KartuPerpus Digital. Semua hak dilindungi.</p>
        <div class="footer-links">
          <a href="index.php">Beranda</a>
          <a href="index.php#check">Cek Status</a>
          <a href="index.php#about">Tentang</a>
          <a href="register.php">Daftar</a>
        </div>
      </div>
    </div>
  </footer>

  <?php
  // Generate chart data
  $weekly_counts = [];
  $prodi_counts = [];

  $dir = 'members';
  if (file_exists($dir)) {
      foreach (glob("$dir/*.json") as $file) {
          $fileData = json_decode(file_get_contents($file), true);
          $week = date("o-W", filemtime($file));
          $weekly_counts[$week] = ($weekly_counts[$week] ?? 0) + 1;

          $prodi = $fileData['prodi'] ?? 'Tidak Diketahui';
          $prodi_counts[$prodi] = ($prodi_counts[$prodi] ?? 0) + 1;
      }
  }

  ksort($weekly_counts);
  ?>

  <script>
    // Mobile Navigation Toggle
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    navToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
      navToggle.classList.toggle('active');
    });

    // Copy to clipboard function
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        showToast('Hash berhasil disalin!', 'success');
      }).catch(() => {
        showToast('Gagal menyalin hash', 'error');
      });
    }

    // Toast notification
    function showToast(message, type = 'info') {
      const toast = document.createElement('div');
      toast.className = `toast toast-${type}`;
      toast.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
        <span>${message}</span>
      `;
      document.body.appendChild(toast);
      
      setTimeout(() => toast.classList.add('show'), 100);
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => document.body.removeChild(toast), 300);
      }, 3000);
    }

    // Quick action functions
    function downloadCard() {
      showToast('Fitur unduh PDF akan segera tersedia!', 'info');
    }

    function shareCard() {
      if (navigator.share) {
        navigator.share({
          title: 'KartuPerpus Digital',
          text: 'Saya telah terdaftar sebagai anggota perpustakaan digital!',
          url: window.location.href
        });
      } else {
        copyToClipboard(window.location.href);
        showToast('Link berhasil disalin!', 'success');
      }
    }

    // Chart data
    const weeklyLabels = <?= json_encode(array_keys($weekly_counts)) ?>;
    const weeklyData = <?= json_encode(array_values($weekly_counts)) ?>;
    const prodiLabels = <?= json_encode(array_keys($prodi_counts)) ?>;
    const prodiData = <?= json_encode(array_values($prodi_counts)) ?>;

    // Initialize charts
    function initCharts() {
      // Weekly registration chart
      const ctxWeek = document.getElementById('chartPendaftaran').getContext('2d');
      new Chart(ctxWeek, {
        type: 'bar',
        data: {
          labels: weeklyLabels,
          datasets: [{
            label: 'Jumlah Pendaftar',
            data: weeklyData,
            backgroundColor: 'rgba(37, 99, 235, 0.8)',
            borderColor: 'rgba(37, 99, 235, 1)',
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            title: { display: false }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0
              }
            }
          }
        }
      });

      // Program studi distribution chart
      const ctxProdi = document.getElementById('chartProdi').getContext('2d');
      new Chart(ctxProdi, {
        type: 'doughnut',
        data: {
          labels: prodiLabels,
          datasets: [{
            data: prodiData,
            backgroundColor: [
              '#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4',
              '#84cc16', '#f97316', '#ec4899', '#6b7280'
            ],
            borderWidth: 3,
            borderColor: '#ffffff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                padding: 20,
                usePointStyle: true
              }
            }
          }
        }
      });
    }

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate');
        }
      });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.fade-in-up, .slide-in-down').forEach(el => {
      observer.observe(el);
    });

    // Initialize charts when page loads
    document.addEventListener('DOMContentLoaded', () => {
      setTimeout(initCharts, 500); // Delay to ensure smooth animations
    });

    // Navbar background on scroll
    window.addEventListener('scroll', () => {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>

  <style>
    /* Dashboard specific styles */
    .dashboard-section {
      min-height: 100vh;
      padding: 120px 0 80px;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .status-message {
      background: var(--white);
      border-radius: var(--border-radius);
      padding: 25px;
      margin-bottom: 30px;
      display: flex;
      align-items: flex-start;
      gap: 20px;
      box-shadow: var(--shadow-md);
      border-left: 5px solid;
      transform: translateY(-20px);
      opacity: 0;
      transition: var(--transition);
    }

    .status-message.animate {
      transform: translateY(0);
      opacity: 1;
    }

    .error-message {
      border-left-color: var(--error-color);
      background: #fef2f2;
    }

    .success-message {
      border-left-color: var(--success-color);
      background: #f0fdf4;
    }

    .message-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .error-message .message-icon {
      background: var(--error-color);
      color: var(--white);
    }

    .success-message .message-icon {
      background: var(--success-color);
      color: var(--white);
    }

    .message-content h3 {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--gray-900);
    }

    .message-content p {
      color: var(--gray-600);
      line-height: 1.5;
      margin: 0;
    }

    .member-card {
      background: var(--white);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      margin-bottom: 40px;
      border: 1px solid var(--gray-200);
    }

    .card-header {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      color: var(--white);
      padding: 30px;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .card-icon {
      width: 60px;
      height: 60px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }

    .card-title h2 {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .card-title p {
      opacity: 0.9;
      margin: 0;
    }

    .status-badge {
      background: var(--success-color);
      color: var(--white);
      padding: 8px 16px;
      border-radius: 25px;
      font-size: 14px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: auto;
    }

    .card-body {
      padding: 40px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    .info-item {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 20px;
      background: var(--gray-50);
      border-radius: var(--border-radius);
      border: 1px solid var(--gray-200);
    }

    .info-icon {
      width: 45px;
      height: 45px;
      background: var(--primary-color);
      color: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .info-content label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: var(--gray-500);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 5px;
    }

    .info-content span {
      font-size: 16px;
      font-weight: 600;
      color: var(--gray-900);
    }

    .security-section {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: var(--border-radius);
      padding: 25px;
    }

    .security-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .security-header i {
      color: var(--primary-color);
      font-size: 1.2rem;
    }

    .security-header h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--gray-900);
      margin: 0;
    }

    .hash-container {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    .security-hash {
      flex: 1;
      background: var(--white);
      border: 1px solid var(--gray-300);
      border-radius: var(--border-radius);
      padding: 15px;
      font-family: 'Courier New', monospace;
      font-size: 14px;
      word-break: break-all;
      color: var(--gray-800);
    }

    .copy-btn {
      background: var(--primary-color);
      color: var(--white);
      border: none;
      padding: 15px 20px;
      border-radius: var(--border-radius);
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 600;
    }

    .copy-btn:hover {
      background: var(--primary-dark);
    }

    .security-note {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 14px;
      color: var(--gray-600);
      line-height: 1.5;
      margin: 0;
    }

    .security-note i {
      color: var(--primary-color);
      margin-top: 2px;
    }

    .quick-actions-section {
      margin-bottom: 40px;
    }

    .quick-actions-section h3 {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--gray-900);
      margin-bottom: 20px;
    }

    .actions-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 15px;
    }

    .action-card {
      background: var(--white);
      border: 2px solid var(--gray-200);
      border-radius: var(--border-radius);
      padding: 20px;
      text-align: center;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .action-card:hover {
      border-color: var(--primary-color);
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .action-card i {
      font-size: 1.5rem;
      color: var(--primary-color);
    }

    .action-card span {
      font-weight: 600;
      color: var(--gray-700);
    }

    .not-found-section {
      text-align: center;
      margin-bottom: 40px;
    }

    .not-found-card {
      background: var(--error-color);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-xl);
      padding: 60px 40px;
      border: 1px solid var(--gray-200);
    }

    .not-found-icon {
      width: 100px;
      height: 100px;
      background: var(--gray-200);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 30px;
      font-size: 2.5rem;
      color: var(--gray-500);
    }

    .not-found-card h2 {
      font-size: 2rem;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 15px;
    }

    .not-found-card p {
      font-size: 1.1rem;
      color: var(--gray-600);
      margin-bottom: 40px;
      line-height: 1.6;
    }

    .not-found-actions {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .statistics-section {
      margin-bottom: 60px;
    }

    .charts-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .chart-card {
      background: var(--white);
      border-radius: var(--border-radius);
      padding: 30px;
      box-shadow: var(--shadow-md);
      border: 1px solid var(--gray-200);
    }

    .chart-card h3 {
      font-size: 1.3rem;
      font-weight: 600;
      color: var(--gray-900);
      margin-bottom: 20px;
      text-align: center;
    }

    .chart-card canvas {
      height: 300px !important;
    }

    .navigation-actions {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .nav-action {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 15px 25px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      transition: var(--transition);
    }

    .nav-action.primary {
      background: var(--primary-color);
      color: var(--white) !important;
    }

    .nav-action.primary:hover {
      background: var(--primary-dark);
      color: var(--white) !important;
      transform: translateY(-3px);
      box-shadow: var(--shadow-lg);
    }

    .nav-action.secondary {
      background: var(--white);
      color: var(--primary-color) !important;
      border: 2px solid var(--primary-color);
    }

    .nav-action.secondary:hover {
      background: var(--primary-color);
      color: var(--white) !important;
      transform: translateY(-3px);
    }

    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--white);
      border-radius: var(--border-radius);
      padding: 15px 20px;
      box-shadow: var(--shadow-lg);
      display: flex;
      align-items: center;
      gap: 10px;
      transform: translateX(100%);
      transition: transform 0.3s;
      z-index: 1000;
      border-left: 4px solid;
    }

    .toast.show {
      transform: translateX(0);
    }

    .toast-success {
      border-left-color: var(--success-color);
      color: var(--success-color);
    }

    .toast-error {
      border-left-color: var(--error-color);
      color: var(--error-color);
    }

    .toast-info {
      border-left-color: var(--primary-color);
      color: var(--primary-color);
    }

    /* Print styles */
    @media print {
      .navbar, .footer, .quick-actions-section, .statistics-section, .navigation-actions {
        display: none !important;
      }
      
      .dashboard-section {
        padding: 20px 0;
      }
      
      .member-card {
        box-shadow: none;
        border: 2px solid var(--gray-300);
      }
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
      .dashboard-section {
        padding: 100px 0 60px;
      }

      .card-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
      }

      .status-badge {
        margin-left: 0;
      }

      .info-grid {
        grid-template-columns: 1fr;
      }

      .hash-container {
        flex-direction: column;
      }

      .charts-container {
        grid-template-columns: 1fr;
      }

      .navigation-actions {
        flex-direction: column;
        align-items: center;
      }

      .nav-action {
        width: 100%;
        max-width: 300px;
        justify-content: center;
      }
    }
  </style>
</body>
</html>
