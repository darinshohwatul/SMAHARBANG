<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang SMA Harapan Bangsa</title>
    <link rel="stylesheet" href="aboutus.css">
    <link rel="stylesheet" href="vm.css">
    <link rel="stylesheet" href="navbar.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* Additional CSS for dropdown functionality */
    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1000;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        top: 100%;
        left: 0;
    }

    .dropdown-content a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s ease;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown > a::after {
        content: " ▼";
        font-size: 12px;
        margin-left: 5px;
    }

    /* Mobile dropdown styles */
    @media (max-width: 768px) {
        .dropdown-content {
            position: static;
            box-shadow: none;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            margin-left: 20px;
            border-radius: 0;
        }
        
        .dropdown-content a {
            color: white;
            padding: 8px 16px;
        }
        
        .dropdown-content a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .dropdown.active .dropdown-content {
            display: block;
        }
    }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="img/smalogo1.jpg" alt="Logo SMA Harapan Bangsa">
                <div class="logo-text">
                    <h1>SMA Harapan Bangsa</h1>
                    <p>Unggul dalam Prestasi, Berakhlak Mulia</p>
                </div>
            </div>
            
            <button class="nav-toggle" id="navToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            
            <nav id="mainNav">
                <div class="nav-links" id="navLinks">
                    <i onclick="hideMenu()"></i>
                    <ul>
                        <li><a href="home.php">BERANDA</a></li>
                        <li class="dropdown">
                            <a href="#" onclick="toggleDropdown(event, this)">PROFIL</a>
                            <div class="dropdown-content">
                                <a href="vm.php">VISI DAN MISI</a>
                                <a href="daftar_guru.php">DAFTAR GURU</a>
                                <a href="aboutus.php">TENTANG KAMI</a>
                            </div>
                        </li>
                        <li><a href="form_ppdb.php">PPDB</a></li>
                        <li class="dropdown">
                            <a href="#" onclick="toggleDropdown(event, this)">STUDI</a>
                            <div class="dropdown-content">
                                <a href="http://localhost/moodle/?redirect=0" target="_blank">E-LEARNING</a>
                                <a href="http://localhost/slims9/index.php" target="_blank">E-PERPUS</a>
                            </div>
                        </li>
                        <li><a href="pd.php">EKSTRAKULIKULER</a></li>      
                        <li><a href="fslt.php">FASILITAS</a></li>
                    </ul>
                </div>
                <i  onclick="showMenu()" style="font-size: 20px; color: #333;"></i>
            </nav>
        </div>
    </header>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-header">
                <h2>Tentang SMA Harapan Bangsa</h2>
                <p>Mengenal lebih dekat sekolah pilihan masa depan</p>
            </div>
            
            <div class="about-content">
                <div class="about-text">
                    <h3>Selamat Datang di SMA Harapan Bangsa</h3>
                    <p>SMA Harapan Bangsa didirikan pada tahun 1998 sebagai bentuk dedikasi untuk menyediakan pendidikan berkualitas tinggi bagi generasi penerus bangsa. Selama lebih dari dua dekade, kami telah menjadi pusat keunggulan pendidikan yang berkomitmen untuk membentuk siswa yang memiliki prestasi akademik luar biasa dan kepribadian yang berakhlak mulia.</p>
                    
                    <p>Sekolah kami menawarkan kurikulum komprehensif yang dirancang untuk mempersiapkan siswa memasuki jenjang pendidikan tinggi dan menghadapi tantangan global abad ke-21. Dengan kombinasi antara pendekatan pembelajaran modern dan nilai-nilai tradisional yang kuat, SMA Harapan Bangsa berhasil menciptakan lingkungan belajar yang inspiratif dan mendukung perkembangan optimal setiap siswa.</p>
                    
                    <div class="about-highlight">
                        <h4>Keunggulan SMA Harapan Bangsa:</h4>
                        <ul>
                            <li>Program Jurusan IPA dan IPS dengan kurikulum terbarukan</li>
                            <li>Tenaga pengajar profesional dengan kualifikasi terbaik</li>
                            <li>Fasilitas pembelajaran modern dengan teknologi terkini</li>
                            <li>Program ekstrakurikuler beragam untuk pengembangan bakat</li>
                            <li>Bimbingan karir dan persiapan masuk perguruan tinggi</li>
                        </ul>
                    </div>
                    
                    <p>SMA Harapan Bangsa terletak di lingkungan yang strategis, tenang, dan kondusif untuk kegiatan belajar mengajar. Kampus kami dilengkapi dengan berbagai fasilitas modern seperti perpustakaan digital, laboratorium sains lengkap, studio seni, lapangan olahraga, dan aula serbaguna yang mendukung pengembangan potensi siswa secara menyeluruh.</p>
                </div>
                
                <div class="about-image">
                    <img src="img/school.jpeg" alt="Gedung SMA Harapan Bangsa">
                </div>

            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-container">
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-number">2500+</div>
                    <div class="stat-title">Alumni Sukses</div>
                </div>
                
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-number">50+</div>
                    <div class="stat-title">Tenaga Pengajar</div>
                </div>
                
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-number">100+</div>
                    <div class="stat-title">Penghargaan</div>
                </div>
                
                <div class="stat-box">
                    <div class="stat-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-number">15+</div>
                    <div class="stat-title">Program Unggulan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="map-container">
                <h3>Lokasi SMA Harapan Bangsa</h3>
                <iframe class="map-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126918.20541490463!2d106.68886075000001!3d-6.3054964499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ee3a6b5fd39f%3A0x6eeb2e0d9b9902b9!2sSMA%20Harapan%20Bangsa!5e0!3m2!1sid!2sid!4v1684318075518!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>SMA Harapan Bangsa</h3>
                    <p>Mendidik generasi penerus bangsa yang berkarakter, berkualitas, dan siap menghadapi tantangan global.</p>
                    <div class="social-links">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3>Navigasi</h3>
                    <ul>
                        <li><a href="home.php">Beranda</a></li>
                        <li><a href="aboutus.php">Tentang Kami</a></li>
                        <li><a href="vm.php">Visi & Misi</a></li>
                        <li><a href="http://localhost/moodle/?redirect=0" target="_blank">E-Learning</a></li>
                        <li><a href="http://localhost/slims9/index.php" target="_blank">E-Perpus</a></li>
                        <li><a href="fslt.php">Fasilitas</a></li>
                        <li><a href="pd.php"> Ekstrakulikuler</a></li>
                    </ul>
                </div>
                
                 <div class="footer-col">
                    <h3>Kontak Kami</h3>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; vertical-align: middle;">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Jl. Pendidikan No. 123, Kota Harapan, Indonesia
                    </p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; vertical-align: middle;">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        (021) 1234 5678
                    </p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; vertical-align: middle;">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        info@smaharapanbangsa.sch.id
                    </p>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 SMA Harapan Bangsa. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');
        
        navToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });

        // Dropdown functionality for mobile
        function toggleDropdown(event, element) {
            event.preventDefault();
            
            // Check if it's mobile view
            if (window.innerWidth <= 768) {
                const dropdown = element.closest('.dropdown');
                dropdown.classList.toggle('active');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                // Remove active class from all dropdowns on desktop
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>