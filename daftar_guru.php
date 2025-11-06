<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guru - SMA Harapan Bangsa</title>
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

 <!-- Values Section -->
    <br>
    
    <br>

    <section class="values">
        <div class="container">
            <div class="section-title">
                <h2>Daftar Guru Kami</h2>
            </div>
            
            <div class="values-container">
                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/ptr.jpg" alt="Foto Putri Irawan" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Putri Irawan 
                        <br>S.Pd
                    </h3>
                    <p>Biologi</p>
                </div>
                
                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/drn.jpg" alt="Foto Darin Shohwatul Islam" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Darin Shohwatul Islam 
                        <br>S.Si
                    </h3>
                    <p>Fisika</p>
                </div>
                
                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/agl.jpg" alt="Foto Angel Sheripova" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Angel Sheripova 
                        <br>S.S
                    </h3>
                    <p>Bahasa Inggris</p>
                </div>
                
                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/aul.jpg" alt="Foto Aulia Dea Fadilah" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Aulia Dea Fadilah 
                        <br>S.Sos
                    </h3>
                    <p>Geografi</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/archen.jpeg" alt="Foto archen" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Archen Aydin
                        <br>S.Pd
                    </h3>
                    <p>Kimia</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/sri.jpg" alt="Foto Sri" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Sri Kurniati
                        <br>S.E
                    </h3>
                    <p>Ekonomi</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/arumi.jpeg" alt="Foto arumi" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Arumi Salsabila
                        <br>S.Pd
                    </h3>
                    <p>Bahasa Indonesia</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/nara.jpeg" alt="Foto naravit" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Naravit 
                        <br>S.Si
                    </h3>
                    <p>Matematika</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/liliana.jpeg" alt="Foto liliana" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Liliana Wijaya
                        <br>S.S.
                    </h3>
                    <p>Bahasa Mandarin</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/sean.jpeg" alt="Foto sean" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Sean Satria 
                        <br>S.Sos
                    </h3>
                    <p>Sosiologi</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/dilara.jpeg" alt="Foto dilara" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Dilara Reha
                        <br>S.S.
                    </h3>
                    <p>Bahasa Jerman</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/william.jpeg" alt="Foto william" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>William Est 
                        <br>S.E
                    </h3>
                    <p>Akuntansi</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/maryam.jpeg" alt="Foto maryam" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Maryam Azra
                        <br>S.Pd
                    </h3>
                    <p>Bahasa Arab</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/haikal.jpeg" alt="Foto haikal" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Haikal Hendrawan
                        <br>S.Pd
                    </h3>
                    <p>PPkn</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/johnny.jpeg" alt="Foto johnny" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Johnny Doni
                        <br>S.Pd
                    </h3>
                    <p>PJOK</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/farhan.jpeg" alt="Foto farhan" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Farhan Hangga
                        <br>S.Ag
                    </h3>
                    <p>Pendidikan Agama</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/puwin.jpeg" alt="Foto puwin" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Puwindra Tangsaka
                        <br>S.T.
                    </h3>
                    <p>Informatika</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/oyku.jpeg" alt="Foto oyku" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Kiraz Oyku Sezen
                        <br>S.Sn
                    </h3>
                    <p>Seni Budaya</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/elma.jpeg" alt="Foto elma" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Elma Derya
                        <br>S.Psi
                    </h3>
                    <p>Bimbingan Konseling</p>
                </div>

                <div class="value-item">
                    <div class="value-icon">
                        <img src="img/leyla.jpeg" alt="Foto leyla" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                    </div>
                    <h3>Leyla Harika
                        <br>S.Hum
                    </h3>
                    <p>Antropologi</p>
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