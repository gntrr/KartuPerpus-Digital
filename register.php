<!DOCTYPE html>
<html lang="id">
<head>
  <title>Daftar KTA Perpustakaan - KartuPerpus Digital</title>
  <link rel="stylesheet" href="public/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Formulir pendaftaran keanggotaan perpustakaan digital">
  <link href="public/Font-Awesome-6.x/css/all.min.css" rel="stylesheet">
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
        <a href="index.php#check" class="nav-link">Cek Status</a>
        <a href="index.php#about" class="nav-link">Tentang</a>
        <a href="register.php" class="nav-link register-btn active">Daftar</a>
      </div>
    </div>
  </nav>

  <!-- Registration Section -->
  <section class="register-section">
    <div class="container">
      <div class="register-content fade-in-up">
        <div class="register-header">
          <div class="register-icon">
            <i class="fas fa-user-plus"></i>
          </div>
          <h1 class="register-title">Formulir Pendaftaran</h1>
          <p class="register-subtitle">Bergabunglah dengan sistem perpustakaan digital dan nikmati kemudahan akses</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
        <div class="notice error-notice slide-in-up">
          <i class="fas fa-exclamation-triangle"></i>
          <div>
            <?php if ($_GET['error'] === 'nim_exists'): ?>
              <strong>NIM Sudah Terdaftar!</strong><br>
              NIM tersebut sudah digunakan. Silakan gunakan NIM lain atau cek status keanggotaan Anda.
            <?php elseif ($_GET['error'] === 'nim_invalid'): ?>
              <strong>Format NIM Tidak Valid!</strong><br>
              NIM harus berupa angka dengan minimal 8 digit.
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>

        <div class="register-form-container fade-in-up">
          <form method="POST" action="process_register.php" class="register-form" onsubmit="return validateForm()">
            <div class="form-grid">
              <div class="form-group">
                <label for="nama">
                  <i class="fas fa-user"></i>
                  Nama Lengkap
                </label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
              </div>

              <div class="form-group">
                <label for="nim">
                  <i class="fas fa-id-card"></i>
                  NIM Mahasiswa
                </label>
                <input type="text" id="nim" name="nim" placeholder="Masukkan NIM (minimal 8 digit)" required 
                       pattern="[0-9]{8,}" title="NIM harus berupa angka minimal 8 digit">
              </div>

              <div class="form-group">
                <label for="kelas">
                  <i class="fas fa-graduation-cap"></i>
                  Kelas
                </label>
                <input type="text" id="kelas" name="kelas" placeholder="Contoh: TI-3A, SI-2B" required>
              </div>

              <div class="form-group">
                <label for="prodi">
                  <i class="fas fa-university"></i>
                  Program Studi
                </label>
                <select id="prodi" name="prodi" required>
                  <option value="">Pilih Program Studi</option>
                  <option value="Teknik Informatika">Teknik Informatika</option>
                  <option value="Sistem Informasi">Sistem Informasi</option>
                  <option value="Teknik Komputer">Teknik Komputer</option>
                  <option value="Manajemen Informatika">Manajemen Informatika</option>
                  <option value="Teknik Elektro">Teknik Elektro</option>
                  <option value="Teknik Mesin">Teknik Mesin</option>
                  <option value="Teknik Sipil">Teknik Sipil</option>
                  <option value="Akuntansi">Akuntansi</option>
                  <option value="Manajemen">Manajemen</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
            </div>

            <div class="form-footer">
              <button type="submit" class="register-btn-submit">
                <i class="fas fa-user-plus"></i>
                <span>Daftar Sekarang</span>
                <div class="btn-loading">
                  <i class="fas fa-spinner fa-spin"></i>
                </div>
              </button>
              
              <div class="form-links">
                <a href="index.php" class="back-link">
                  <i class="fas fa-arrow-left"></i>
                  Kembali ke Beranda
                </a>
                <a href="index.php#check" class="check-link">
                  <i class="fas fa-search"></i>
                  Sudah terdaftar? Cek Status
                </a>
              </div>
            </div>
          </form>
        </div>

        <!-- Security Info -->
        <div class="security-info fade-in-up">
          <div class="security-card">
            <div class="security-icon">
              <i class="fas fa-shield-alt"></i>
            </div>
            <div class="security-content">
              <h3>Keamanan Data Terjamin</h3>
              <p>Data Anda akan dienkripsi menggunakan teknologi hash SHA-256 untuk memastikan keamanan dan privasi informasi pribadi.</p>
            </div>
          </div>
        </div>
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

  <script>
    // Mobile Navigation Toggle
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    navToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
      navToggle.classList.toggle('active');
    });

    // Form validation
    function validateForm() {
      const nim = document.querySelector('#nim').value;
      const submitBtn = document.querySelector('.register-btn-submit');
      
      if (!/^[0-9]{8,}$/.test(nim)) {
        showError("NIM harus berupa angka minimal 8 digit.");
        return false;
      }
      
      // Show loading state
      submitBtn.classList.add('loading');
      return true;
    }

    function showError(message) {
      // Create error toast
      const toast = document.createElement('div');
      toast.className = 'error-toast';
      toast.innerHTML = `
        <i class="fas fa-exclamation-circle"></i>
        <span>${message}</span>
      `;
      document.body.appendChild(toast);
      
      setTimeout(() => {
        toast.classList.add('show');
      }, 100);
      
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
          document.body.removeChild(toast);
        }, 300);
      }, 3000);
    }

    // Input animations
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
      input.addEventListener('focus', () => {
        input.parentElement.classList.add('focused');
      });
      
      input.addEventListener('blur', () => {
        if (!input.value) {
          input.parentElement.classList.remove('focused');
        }
      });
      
      // Check if input has value on load
      if (input.value) {
        input.parentElement.classList.add('focused');
      }
    });

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
    document.querySelectorAll('.fade-in-up, .slide-in-up').forEach(el => {
      observer.observe(el);
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
    /* Register page specific styles */
    .register-section {
      min-height: 100vh;
      padding: 120px 0 80px;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .register-content {
      max-width: 800px;
      margin: 0 auto;
    }

    .register-header {
      text-align: center;
      margin-bottom: 50px;
    }

    .register-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: var(--shadow-lg);
    }

    .register-icon i {
      font-size: 2rem;
      color: var(--white);
    }

    .register-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--gray-900);
      margin-bottom: 15px;
    }

    .register-subtitle {
      font-size: 1.1rem;
      color: var(--gray-600);
      max-width: 500px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .error-notice {
      background: #fef2f2;
      color: #dc2626;
      border: 1px solid #fecaca;
      border-radius: var(--border-radius);
      padding: 20px;
      margin-bottom: 30px;
      display: flex;
      align-items: flex-start;
      gap: 15px;
    }

    .error-notice i {
      font-size: 1.2rem;
      margin-top: 2px;
    }

    .register-form-container {
      background: var(--white);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      border: 1px solid var(--gray-200);
    }

    .register-form {
      padding: 40px;
    }

    .form-grid {
      display: grid;
      gap: 25px;
      margin-bottom: 40px;
    }

    .form-group {
      position: relative;
    }

    .form-group label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      color: var(--gray-700);
      margin-bottom: 8px;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 15px 18px;
      border: 2px solid var(--gray-200);
      border-radius: var(--border-radius);
      font-size: 16px;
      transition: var(--transition);
      background: var(--white);
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-group.focused label {
      color: var(--primary-color);
    }

    .form-footer {
      border-top: 1px solid var(--gray-200);
      padding-top: 30px;
    }

    .register-btn-submit {
      width: 100%;
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      color: var(--white);
      border: none;
      padding: 18px 30px;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 25px;
      position: relative;
      overflow: hidden;
    }

    .register-btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }

    .register-btn-submit.loading span {
      opacity: 0;
    }

    .register-btn-submit .btn-loading {
      position: absolute;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .register-btn-submit.loading .btn-loading {
      opacity: 1;
    }

    .form-links {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }

    .back-link,
    .check-link {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--gray-600);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
      padding: 8px 0;
    }

    .back-link:hover,
    .check-link:hover {
      color: var(--primary-color);
      transform: translateX(-3px);
    }

    .check-link:hover {
      transform: translateX(3px);
    }

    .security-info {
      margin-top: 40px;
    }

    .security-card {
      background: rgba(37, 99, 235, 0.05);
      border: 1px solid rgba(37, 99, 235, 0.1);
      border-radius: var(--border-radius);
      padding: 25px;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .security-icon {
      width: 50px;
      height: 50px;
      background: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      flex-shrink: 0;
    }

    .security-content h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--gray-900);
      margin-bottom: 5px;
    }

    .security-content p {
      color: var(--gray-600);
      font-size: 14px;
      line-height: 1.5;
      margin: 0;
    }

    .error-toast {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #dc2626;
      color: white;
      padding: 15px 20px;
      border-radius: var(--border-radius);
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: var(--shadow-lg);
      transform: translateX(100%);
      transition: transform 0.3s;
      z-index: 1000;
    }

    .error-toast.show {
      transform: translateX(0);
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
      .register-section {
        padding: 100px 0 60px;
      }

      .register-title {
        font-size: 2rem;
      }

      .register-form {
        padding: 30px 20px;
      }

      .form-links {
        flex-direction: column;
        text-align: center;
      }

      .security-card {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</body>
</html>
