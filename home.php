<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - SMA Harapan Bangsa</title>
    <link rel="stylesheet" href="vm.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="home.css">
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
    <section class="hero-section">
        <div class="hero-slider">
            <div class="slide active" style="background-image: url('img/auditori.jpeg');">
            </div>
            <div class="slide" style="background-image: url('img/cafeteria.png');">
            </div>
            <div class="slide" style="background-image: url('img/perpustakaan.jpg');">
            </div>
        </div>
        
        <div class="hero-content">
            <h1>Selamat Datang di Sekolah Kami</h1>
            <p>Membentuk generasi unggul dengan pendidikan berkualitas dan karakter yang kuat untuk masa depan yang gemilang</p>
            <a href="#about" class="cta-button">Pelajari Lebih Lanjut</a>
        </div>

        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="section-title">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Kami berkomitmen memberikan pendidikan terbaik dengan fasilitas modern dan tenaga pengajar yang berkualitas</p>
            </div>
            
            <div class="about-content">
                <div class="about-card">
                    <div class="icon">🎓</div>
                    <h3>Pendidikan Berkualitas</h3>
                    <p>Kurikulum terdepan yang disesuaikan dengan standar internasional untuk mempersiapkan siswa menghadapi tantangan global.</p>
                </div>
                
                <div class="about-card">
                    <div class="icon">👥</div>
                    <h3>Tenaga Pengajar Profesional</h3>
                    <p>Tim guru berpengalaman dan berdedikasi yang siap membimbing setiap siswa mencapai potensi terbaiknya.</p>
                </div>
                
                <div class="about-card">
                    <div class="icon">🏢</div>
                    <h3>Fasilitas Modern</h3>
                    <p>Gedung dan fasilitas pembelajaran yang lengkap dan modern untuk mendukung proses belajar mengajar yang optimal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>1000+</h3>
                    <p>Siswa Aktif</p>
                </div>
                <div class="stat-item">
                    <h3>50+</h3>
                    <p>Tenaga Pengajar</p>
                </div>
                <div class="stat-item">
                    <h3>15+</h3>
                    <p>Tahun Pengalaman</p>
                </div>
                <div class="stat-item">
                    <h3>95%</h3>
                    <p>Tingkat Kelulusan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="section-title">
                <h2>Testimoni Alumni</h2>
                <p>Dengarkan cerita sukses dari para alumni yang telah merasakan manfaat pendidikan di sekolah kami</p>
            </div>
            
            <div class="testimonial-slider">
                <div class="testimonial-track">
                    <div class="testimonial-card active">
                        <div class="quote">
                            "Sekolah ini benar-benar mempersiapkan saya untuk masa depan. Tidak hanya akademik, tapi juga pembentukan karakter yang kuat. Sekarang saya berhasil bekerja di perusahaan multinasional berkat fondasi yang kuat dari sekolah ini."
                        </div>
                        <div class="author">
                            <div class="author-img">AS</div>
                            <div class="author-info">
                                <h4>Andi Setiawan</h4>
                                <p>Alumni 2018 - Software Engineer</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-card">
                        <div class="quote">
                            "Guru-guru di sini sangat inspiratif dan selalu mendorong kami untuk berkembang. Lingkungan belajar yang kondusif membuat saya betah belajar dan akhirnya berhasil masuk ke universitas impian."
                        </div>
                        <div class="author">
                            <div class="author-img">SR</div>
                            <div class="author-info">
                                <h4>Sari Rahayu</h4>
                                <p>Alumni 2019 - Mahasiswa Kedokteran</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-card">
                        <div class="quote">
                            "Fasilitas yang lengkap dan kegiatan ekstrakurikuler yang beragam membuat masa sekolah saya sangat berkesan. Saya belajar banyak hal di luar akademik yang sangat berguna dalam kehidupan sehari-hari."
                        </div>
                        <div class="author">
                            <div class="author-img">BW</div>
                            <div class="author-info">
                                <h4>Budi Wijaya</h4>
                                <p>Alumni 2020 - Entrepreneur</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-nav">
                <span class="testimonial-dot active" onclick="currentTestimonial(1)"></span>
                <span class="testimonial-dot" onclick="currentTestimonial(2)"></span>
                <span class="testimonial-dot" onclick="currentTestimonial(3)"></span>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Bergabunglah Dengan Kami</h2>
            <p>Mulai perjalanan pendidikan terbaik untuk masa depan yang cerah</p>
            <a href="form_ppdb.php" class="cta-button">Daftar Sekarang</a>
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

    <script>
        // Hero Slider
        let slideIndex = 1;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function showSlides(n) {
            if (n > slides.length) { slideIndex = 1; }
            if (n < 1) { slideIndex = slides.length; }
            
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[slideIndex - 1].classList.add('active');
            dots[slideIndex - 1].classList.add('active');
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        // Auto slide
        setInterval(() => {
            slideIndex++;
            showSlides(slideIndex);
        }, 5000);

        // Testimonial Slider
        let testimonialIndex = 0;
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        const testimonialDots = document.querySelectorAll('.testimonial-dot');
        const testimonialTrack = document.querySelector('.testimonial-track');

        function showTestimonials(n) {
            if (n >= testimonialCards.length) { testimonialIndex = 0; }
            if (n < 0) { testimonialIndex = testimonialCards.length - 1; }
            
            // Remove active class from all cards and dots
            testimonialCards.forEach(card => card.classList.remove('active'));
            testimonialDots.forEach(dot => dot.classList.remove('active'));
            
            // Add active class to current card and dot
            testimonialCards[testimonialIndex].classList.add('active');
            testimonialDots[testimonialIndex].classList.add('active');
            
            // Move the track to show current testimonial
            testimonialTrack.style.transform = `translateX(-${testimonialIndex * 100}%)`;
        }

        function currentTestimonial(n) {
            showTestimonials(testimonialIndex = n - 1);
        }

        // Initialize testimonial slider
        showTestimonials(testimonialIndex);

        // Auto testimonial slider
        setInterval(() => {
            testimonialIndex++;
            showTestimonials(testimonialIndex);
        }, 7000);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-item h3');
            const speed = 200;

            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-target') || +counter.innerText.replace(/\D/g, '');
                    const data = +counter.innerText.replace(/\D/g, '');

                    const time = value / speed;
                    if (data < value) {
                        counter.innerText = Math.ceil(data + time) + (counter.innerText.includes('%') ? '%' : '+');
                        setTimeout(animate, 1);
                    } else {
                        counter.innerText = value + (counter.innerText.includes('%') ? '%' : '+');
                    }
                };
                animate();
            });
        }

        // Trigger counter animation when stats section is visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        observer.observe(document.querySelector('.stats-section'));

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

        // Functions for legacy support (if needed)
        function showMenu() {
            document.getElementById('mainNav').classList.add('active');
        }

        function hideMenu() {
            document.getElementById('mainNav').classList.remove('active');
        }
    </script>
</body>
</html>
