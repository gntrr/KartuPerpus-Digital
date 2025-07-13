<!DOCTYPE html>
<html lang="id">
<head>
  <title>KartuPerpus Digital - Sistem Keanggotaan Perpustakaan Modern</title>
  <link rel="stylesheet" href="public/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sistem manajemen keanggotaan perpustakaan digital yang modern dan responsif">
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
        <a href="#home" class="nav-link active">Beranda</a>
        <a href="#check" class="nav-link">Cek Status</a>
        <a href="#about" class="nav-link">Tentang</a>
        <a href="register.php" class="nav-link register-btn">Daftar</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="home" class="hero">
    <div class="hero-content fade-in">
      <div class="hero-text">
        <h1 class="hero-title">
          <span class="gradient-text">KartuPerpus</span>
          <span class="typing-text">Digital</span>
        </h1>
        <p class="hero-subtitle">Sistem manajemen keanggotaan perpustakaan yang modern, aman, dan mudah digunakan</p>
        <div class="hero-buttons">
          <button class="btn btn-primary" onclick="scrollToSection('check')">
            <i class="fas fa-search"></i>
            Cek Status Keanggotaan
          </button>
          <a href="register.php" class="btn btn-secondary">
            <i class="fas fa-user-plus"></i>
            Daftar Sekarang
          </a>
        </div>
      </div>
      <div class="hero-image">
        <div class="floating-card">
          <i class="fas fa-id-card"></i>
          <h3>Digital ID Card</h3>
          <p>Kartu identitas digital yang aman dengan teknologi hash</p>
        </div>
      </div>
    </div>
    <div class="scroll-indicator">
      <i class="fas fa-chevron-down"></i>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="container">
      <h2 class="section-title fade-in-up">Fitur Unggulan</h2>
      <div class="features-grid">
        <div class="feature-card slide-in-left">
          <div class="feature-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Keamanan Tinggi</h3>
          <p>Data dilindungi dengan teknologi hash SHA-256 untuk keamanan maksimal</p>
        </div>
        <div class="feature-card slide-in-up">
          <div class="feature-icon">
            <i class="fas fa-mobile-alt"></i>
          </div>
          <h3>Responsif</h3>
          <p>Dapat diakses dari berbagai perangkat dengan tampilan yang optimal</p>
        </div>
        <div class="feature-card slide-in-right">
          <div class="feature-icon">
            <i class="fas fa-chart-bar"></i>
          </div>
          <h3>Dashboard Analitik</h3>
          <p>Sistem monitoring dan statistik keanggotaan yang komprehensif</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Check Status Section -->
  <section id="check" class="check-section">
    <div class="container">
      <div class="check-content fade-in-up">
        <h2 class="section-title">Cek Status Keanggotaan</h2>
        <p class="section-subtitle">Masukkan NIM Anda untuk melihat status keanggotaan perpustakaan</p>
        
        <div class="check-form-container">
          <form method="GET" action="dashboard.php" class="check-form">
            <div class="input-group">
              <i class="fas fa-id-card input-icon"></i>
              <input type="text" name="nim" placeholder="Masukkan NIM Anda (minimal 8 digit)" required 
                     pattern="[0-9]{8,}" title="NIM harus berupa angka minimal 8 digit">
              <button type="submit" class="submit-btn">
                <i class="fas fa-search"></i>
                <span>Cek Status</span>
              </button>
            </div>
          </form>
          
          <div class="quick-actions">
            <a href="register.php" class="quick-action">
              <i class="fas fa-user-plus"></i>
              <span>Belum terdaftar? Daftar di sini</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-section">
    <div class="container">
      <div class="about-content">
        <div class="about-text fade-in-left">
          <h2 class="section-title">Tentang KartuPerpus Digital</h2>
          <p>Sistem manajemen keanggotaan perpustakaan digital yang dirancang khusus untuk memudahkan mahasiswa dalam mengakses layanan perpustakaan.</p>
          <div class="stats">
            <div class="stat-item">
              <h3 id="memberCount">0</h3>
              <p>Anggota Terdaftar</p>
            </div>
            <div class="stat-item">
              <h3>100%</h3>
              <p>Keamanan Data</p>
            </div>
            <div class="stat-item">
              <h3>24/7</h3>
              <p>Akses Online</p>
            </div>
          </div>
        </div>
        <div class="about-image fade-in-right">
          <div class="image-placeholder">
            <i class="fas fa-university"></i>
            <h3>Perpustakaan Digital</h3>
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
          <a href="#home">Beranda</a>
          <a href="#check">Cek Status</a>
          <a href="#about">Tentang</a>
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

    // Smooth scrolling
    function scrollToSection(sectionId) {
      document.getElementById(sectionId).scrollIntoView({
        behavior: 'smooth'
      });
    }

    // Active nav link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        if (link.getAttribute('href').startsWith('#')) {
          e.preventDefault();
          navLinks.forEach(l => l.classList.remove('active'));
          link.classList.add('active');
          const target = link.getAttribute('href').substring(1);
          scrollToSection(target);
          navMenu.classList.remove('active');
          navToggle.classList.remove('active');
        }
      });
    });

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate');
        }
      });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.fade-in, .fade-in-up, .fade-in-left, .fade-in-right, .slide-in-left, .slide-in-right, .slide-in-up').forEach(el => {
      observer.observe(el);
    });

    // Count up animation for member count
    function countUp() {
      const memberCountElement = document.getElementById('memberCount');
      const target = <?php 
        $memberCount = 0;
        if (file_exists('members')) {
          $memberCount = count(glob('members/*.json'));
        }
        echo $memberCount;
      ?>;
      let current = 0;
      const increment = target / 50;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target;
          clearInterval(timer);
        }
        memberCountElement.textContent = Math.floor(current);
      }, 30);
    }

    // Start count up when about section is visible
    const aboutSection = document.getElementById('about');
    const aboutObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          countUp();
          aboutObserver.unobserve(entry.target);
        }
      });
    });
    aboutObserver.observe(aboutSection);

    // Navbar background on scroll
    window.addEventListener('scroll', () => {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 100) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
</body>
</html>
