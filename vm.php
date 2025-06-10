<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi - SMA Harapan Bangsa</title>
    <link rel="stylesheet" href="vm.css">
    <link rel="stylesheet" href="navbar.css">
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
                    <i class="fa fa-times" onclick="hideMenu()"></i>
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
                <i class="fa fa-bars" onclick="showMenu()"></i>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1>Visi & Misi SMA Harapan Bangsa</h1>
            <p>Komitmen kami dalam membangun generasi penerus bangsa yang unggul, berkarakter, dan siap menghadapi tantangan global</p>
        </div>
    </section>

    <!-- Vision Mission Section -->
    <section class="vision-mission">
        <div class="container">
            <div class="section-title">
                <h2>Visi & Misi Kami</h2>
            </div>
            
            <div class="vision-mission-container">
                <div class="card">
                    <div class="card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"/>
                            <path d="M18.599 9.394c-.8-2.535-3.147-4.394-5.938-4.394-2.791 0-5.139 1.859-5.938 4.394A8.613 8.613 0 006 12c0 .887.139 1.738.394 2.545.8 2.536 3.147 4.395 5.938 4.395 2.791 0 5.138-1.859 5.938-4.395A8.613 8.613 0 0018 12c0-.887-.139-1.738-.394-2.545"/>
                            <path d="M20.294 7.838C18.776 4.44 15.636 2 12 2 8.363 2 5.224 4.44 3.706 7.838A12.615 12.615 0 003 12c0 1.48.244 2.9.706 4.162C5.224 19.56 8.363 22 12 22c3.637 0 6.776-2.44 8.294-5.838A12.615 12.615 0 0021 12c0-1.48-.244-2.9-.706-4.162zm-1.12 7.695C17.747 18.103 15.044 20 12 20c-3.044 0-5.747-1.897-7.174-4.467A10.625 10.625 0 014 12c0-1.238.212-2.426.594-3.533C6.007 5.897 8.71 4 12 4c3.044 0 5.747 1.897 7.174 4.467.382 1.107.594 2.295.594 3.533 0 1.238-.212 2.426-.594 3.533z"/>
                        </svg>
                    </div>
                    <h3>Visi</h3>
                    <p>"Menjadi sekolah unggulan yang menghasilkan generasi berakhlak mulia, berprestasi, berkarakter, berwawasan global, dan menjunjung tinggi nilai-nilai budaya bangsa."</p>
                </div>
                
                <div class="card">
                    <div class="card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M17 9l-7 4-7-4V7l7 4 7-4m0-2H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V8a1 1 0 00-1-1z"/>
                            <path d="M21 9h-4v2h2v7H9v-2H7v4h12a2 2 0 002-2V11a2 2 0 00-2-2z"/>
                        </svg>
                    </div>
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyelenggarakan pendidikan yang mengedepankan kualitas akademik dan pembentukan karakter peserta didik</li>
                        <li>Mengembangkan potensi siswa melalui kegiatan akademik dan non-akademik secara optimal</li>
                        <li>Membangun lingkungan belajar yang kondusif, kreatif, dan inovatif</li>
                        <li>Menerapkan teknologi informasi dan komunikasi dalam proses pembelajaran</li>
                        <li>Mempersiapkan siswa untuk melanjutkan pendidikan ke perguruan tinggi terkemuka</li>
                        <li>Menumbuhkan semangat cinta tanah air dan kepedulian terhadap lingkungan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values">
        <div class="container">
            <div class="section-title">
                <h2>Nilai-Nilai Kami</h2>
            </div>
            
            <div class="values-container">
                <div class="value-item">
                    <div class="value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </div>
                    <h3>Integritas</h3>
                    <p>Menjunjung tinggi kejujuran, tanggung jawab, dan konsistensi dalam sikap dan perilaku</p>
                </div>
                
                <div class="value-item">
                    <div class="value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/>
                        </svg>
                    </div>
                    <h3>Keunggulan</h3>
                    <p>Berusaha mencapai prestasi terbaik dalam setiap aspek kegiatan pendidikan</p>
                </div>
                
                <div class="value-item">
                    <div class="value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                        </svg>
                    </div>
                    <h3>Inovasi</h3>
                    <p>Mengembangkan kreativitas dan ide-ide baru dalam proses pembelajaran</p>
                </div>
                
                <div class="value-item">
                    <div class="value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                    </div>
                    <h3>Nasionalisme</h3>
                    <p>Menjunjung tinggi nilai-nilai kebangsaan dan kecintaan terhadap tanah air</p>
                </div>
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