<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekstrakurikuler SMA Harapan Bangsa</title>
    <link rel="stylesheet" href="pd.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="vm.css">
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
                <i onclick="showMenu()"></i>
            </nav>
        </div>
    </header>

    <!-- Header Section -->
    <section class="header-section">
        <div class="container">
            <h1>Ekstrakurikuler SMA Harapan Bangsa</h1>
            <p>Kembangkan potensi, bakat, dan minatmu bersama kami melalui berbagai kegiatan ekstrakurikuler yang menarik dan bermanfaat</p>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro-section">
        <div class="container">
            <h2>Tentang Ekstrakurikuler Kami</h2>
            <p>SMA Harapan Bangsa menyediakan berbagai kegiatan ekstrakurikuler yang bertujuan untuk mengembangkan potensi, bakat, minat, kemampuan, kepribadian, kerjasama, dan kemandirian peserta didik secara optimal. Kegiatan ekstrakurikuler menjadi wadah untuk mengimplementasikan nilai-nilai karakter serta mengasah soft skill dan hard skill yang tidak didapatkan dalam pembelajaran di kelas.</p>
        </div>
    </section>

    <!-- Ekskul Categories -->
    <section class="ekskul-categories">
        <div class="container">
            <h2>Kategori Ekstrakurikuler</h2>
            <div class="category-container">
                <div class="category">
                    <i class="fas fa-running"></i>
                    <h3>Olahraga</h3>
                    <p>Kembangkan kemampuan fisik, sportivitas, dan semangat juang melalui berbagai cabang olahraga</p>
                </div>
                <div class="category">
                    <i class="fas fa-music"></i>
                    <h3>Seni</h3>
                    <p>Ekspresikan kreativitas dan bakat seni melalui kegiatan musik, tari, teater, dan seni rupa</p>
                </div>
                <div class="category">
                    <i class="fas fa-flask"></i>
                    <h3>Akademik</h3>
                    <p>Tingkatkan kemampuan akademik dan keterampilan ilmiah melalui klub-klub berbasis pengetahuan</p>
                </div>
                <div class="category">
                    <i class="fas fa-users"></i>
                    <h3>Sosial</h3>
                    <p>Kembangkan jiwa kepemimpinan, kerjasama tim, dan kepedulian sosial</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ekskul List -->
    <section class="ekskul-list">
        <div class="container">
            <h2>Daftar Ekstrakurikuler</h2>
            <div class="ekskul-cards">
                <!-- Basket -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/basket1.jpg" alt="Basket SMA Harapan Bangsa">
                    </div>
                    <div class="ekskul-content">
                        <h3>Basket</h3>
                        <p>Tim basket SMA Harapan Bangsa telah meraih berbagai prestasi di tingkat kota dan provinsi. Ekskul ini mengajarkan teknik bermain basket, strategi, dan kerja sama tim.</p>
                        <div class="schedule">Jadwal: Sabtu, 12.00-15.00</div>
                        <div class="coach">Pembina: Coach Johnny Doni S.Pd</div>
                    </div>
                </div>

                <!-- Paduan Suara -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/padus.jpg" alt="Paduan Suara">
                    </div>
                    <div class="ekskul-content">
                        <h3>Paduan Suara</h3>
                        <p>Paduan Suara SMA Harapan Bangsa mengembangkan bakat bernyanyi dan harmonisasi vokal. Ekskul ini sering tampil dalam berbagai acara sekolah dan lomba.</p>
                        <div class="schedule">Jadwal: Senin, 13.00-15.00</div>
                        <div class="coach">Pembina: Ibu Kiraz Oyku Sezen S.Sn</div>
                    </div>
                </div>

                <!-- Robotik -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/robotik.jpg" alt="Robotik">
                    </div>
                    <div class="ekskul-content">
                        <h3>Robotik</h3>
                        <p>Klub Robotik mengembangkan keterampilan programming, elektronika, dan mekanika melalui pembuatan dan pemrograman robot. Ekskul ini sering mengikuti kompetisi robotik nasional.</p>
                        <div class="schedule">Jadwal: Senin, 15.30-17.30</div>
                        <div class="coach">Pembina: Bpk. Puwindra Tangsaka S.T.</div>
                    </div>
                </div>

                <!-- Pramuka -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/pramuka.jpg" alt="Pramuka SMA Harapan Bangsa">
                    </div>
                    <div class="ekskul-content">
                        <h3>Pramuka</h3>
                        <p>Pramuka SMA Harapan Bangsa mengembangkan jiwa kepemimpinan, kemandirian, dan keterampilan bertahan hidup. Kegiatan meliputi latihan rutin, perkemahan, dan bakti sosial.</p>
                        <div class="schedule">Jadwal: Selasa, 15.30-17.30</div>
                        <div class="coach">Pembina: Bpk. Naravit S.Si & Ibu Putri Irawan S.Pd</div>
                    </div>
                </div>

                <!-- Fotografi -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/fg.jpg" alt="Fotografi">
                    </div>
                    <div class="ekskul-content">
                        <h3>Fotografi</h3>
                        <p>Klub Fotografi mengembangkan kemampuan siswa dalam bidang fotografi, editing foto, dan storytelling visual. Karya siswa sering dipamerkan dalam pameran sekolah.</p>
                        <div class="schedule">Jadwal: Selasa, 13.00-15.00</div>
                        <div class="coach">Pembina: Bpk. Archen Aydin S.Pd</div>
                    </div>
                </div>

                <!-- English Club -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/englishclub.jpeg" alt="English Club SMA Harapan Bangsa">
                    </div>
                    <div class="ekskul-content">
                        <h3>English Club</h3>
                        <p>English Club fokus pada pengembangan kemampuan berbahasa Inggris melalui aktivitas speaking, debate, storytelling, dan drama. Ekskul ini juga sering mengikuti kompetisi debat.</p>
                        <div class="schedule">Jadwal: Rabu, 13.00-15.00</div>
                        <div class="coach">Pembina: Ms. Angel Sheripova S.S</div>
                    </div>
                </div>

                <!-- karya ilmiah remaja -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/kir.jpeg" alt="Karya Ilmiah Remaja">
                    </div>
                    <div class="ekskul-content">
                        <h3>Karya Ilmiah Remaja</h3>
                        <p>Karya Ilmiah Remaja (KIR) mendorong siswa untuk berpikir kritis dan meneliti berbagai topik ilmiah. Ekskul ini aktif membuat karya tulis, mengikuti lomba, dan presentasi ilmiah di berbagai ajang.</p>
                        <div class="schedule">Jadwal: Rabu, 15.30-17.30</div>
                        <div class="coach">Pembina: Ibu Arumi Salsabila S.Pd</div>
                    </div>
                </div>

                <!-- futsal -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/futsal.jpeg" alt="futsal">
                    </div>
                    <div class="ekskul-content">
                        <h3>Fustal</h3>
                        <p>Futsal melatih teknik bermain, strategi tim, dan sportivitas. Tim futsal sekolah sering mengikuti turnamen antar sekolah dan menjadi ajang pembinaan fisik dan mental.</p>
                        <div class="schedule">Jadwal: Kamis, 15.30-17.30</div>
                        <div class="coach">Pembina: Bpk. Sean Satria S.Sos</div>
                    </div>
                </div>

                <!-- teater -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/teater.jpeg" alt="Teater">
                    </div>
                    <div class="ekskul-content">
                        <h3>Teater</h3>
                        <p>Ekskul Teater mengembangkan bakat siswa dalam seni peran, ekspresi, dan drama. Melalui latihan rutin dan pentas, siswa belajar bekerja sama dan tampil percaya diri di depan umum.</p>
                        <div class="schedule">Jadwal: Kamis, 13.00-15.00</div>
                        <div class="coach">Pembina: Bpk. William Est S.E</div>
                    </div>
                </div>

                <!-- swimming club -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/swimclub.jpg" alt="Swimming Club">
                    </div>
                    <div class="ekskul-content">
                        <h3>Renang</h3>
                        <p>Renang mengembangkan keterampilan berenang, kebugaran fisik, dan sportivitas. Tim renang SMA Harapan Bangsa telah mengikuti berbagai olimpiade renang berbagai prestasi tingkat kota dan provinsi.</p>
                        <div class="schedule">Jadwal: Sabtu, 08.00-11.00</div>
                        <div class="coach">Pembina: Ibu Darin Shohwatul Islam S.Si</div>
                    </div>
                </div>

                <!-- taekwondo club -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/taekwon.jpg" alt="Swimming Club">
                    </div>
                    <div class="ekskul-content">
                        <h3>Taekwondo Club</h3>
                        <p>Taekwondo mengembangkan pada tendangan dinamis, pukulan tangan, dan teknik pertahanan diri. Melalui latihan rutin, siswa belajar bekerja sama dan dapat membela diri nya sendiri.</p>
                        <div class="schedule">Jadwal: Jumat, 15.30-17.30</div>
                        <div class="coach">Pembina: Ibu Aulia Dea Fadilah S.Sos</div>
                    </div>
                </div>

                <!-- voli club -->
                <div class="ekskul-card">
                    <div class="ekskul-image">
                        <img src="img/voli.jpg" alt="Swimming Club">
                    </div>
                    <div class="ekskul-content">
                        <h3>Voli</h3>
                        <p>Voli mengembangkan keterampilan bermain voli, kebugaran fisik, strategi tim, dan sportivitas.. Tim voli SMA Harapan Bangsa telah mengikuti berbagai olimpiade voli berbagai prestasi tingkat kota dan provinsi.</p>
                        <div class="schedule">Jadwal: Jumat, 13.00-15.00</div>
                        <div class="coach">Pembina: Bpk. Haikal Hendrawan S.Pd</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2>Testimoni Siswa</h2>
            <div class="testimonial-container">
                <div class="testimonial">
                    <p>"Bergabung dengan tim basket membuat saya belajar banyak tentang kerja sama tim dan disiplin. Prestasi yang kami raih juga memberikan kebanggaan tersendiri bagi saya dan keluarga."</p>
                    <div class="student-name">Aditya Pratama</div>
                    <div class="student-details">Kelas XII IPA 2, Kapten Tim Basket</div>
                </div>
                <div class="testimonial">
                    <p>"English Club membantu saya meningkatkan kemampuan berbahasa Inggris dengan cara yang menyenangkan. Berkat ekskul ini, saya berhasil lolos seleksi program pertukaran pelajar ke Singapura."</p>
                    <div class="student-name">Dina Safitri</div>
                    <div class="student-details">Kelas XI IPA 1, Anggota English Club</div>
                </div>
                <div class="testimonial">
                    <p>"Ekskul robotik mengajarkan saya cara berpikir logis dan kreatif dalam memecahkan masalah. Pengalaman menjuarai kompetisi robotik nasional tahun lalu tak akan terlupakan."</p>
                    <div class="student-name">Farhan Wijaya</div>
                    <div class="student-details">Kelas XII IPA 3, Ketua Klub Robotik</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section class="faqs">
        <div class="container">
            <h2>Pertanyaan Umum</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">Bagaimana cara bergabung dengan kegiatan ekstrakurikuler?</div>
                    <div class="faq-answer">Siswa dapat mendaftar pada awal tahun ajaran baru melalui Guru Pembina atau Ketua Ekskul. Pendaftaran biasanya dibuka selama dua minggu setelah masa orientasi siswa baru. Untuk informasi lebih lanjut, silakan hubungi Bagian Kesiswaan.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Berapa jumlah ekstrakurikuler yang boleh diikuti satu siswa?</div>
                    <div class="faq-answer">Setiap siswa diperbolehkan mengikuti maksimal 2 kegiatan ekstrakurikuler untuk memastikan siswa dapat fokus dan berkomitmen pada kegiatan yang dipilih tanpa mengganggu kegiatan akademik.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Apakah kegiatan ekstrakurikuler dilaksanakan saat hari libur?</div>
                    <div class="faq-answer">Pada umumnya, kegiatan ekstrakurikuler dilaksanakan pada hari sekolah setelah jam pelajaran berakhir. Namun, beberapa kegiatan seperti Pramuka dilaksanakan pada hari Sabtu. Kegiatan khusus seperti perkemahan atau kompetisi mungkin juga dilaksanakan pada hari libur.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Apakah kegiatan ekstrakurikuler dimasukkan ke dalam penilaian raport?</div>
                    <div class="faq-answer">Ya, kegiatan ekstrakurikuler masuk dalam penilaian raport pada bagian pengembangan diri. Siswa akan mendapatkan nilai berdasarkan keaktifan, kontribusi, dan prestasi dalam kegiatan ekstrakurikuler yang diikuti.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">Apakah ada biaya tambahan untuk mengikuti ekstrakurikuler?</div>
                    <div class="faq-answer">Sebagian besar kegiatan ekstrakurikuler sudah termasuk dalam biaya sekolah. Namun, beberapa kegiatan mungkin memerlukan kontribusi tambahan untuk keperluan khusus seperti seragam tim, perlengkapan, atau kegiatan di luar sekolah. Informasi biaya akan disampaikan oleh Pembina masing-masing.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Temukan Passionmu Bersama Kami!</h2>
            <p>Jangan lewatkan kesempatan untuk mengembangkan bakat dan minatmu di SMA Harapan Bangsa. Bergabunglah dengan ekstrakurikuler pilihanmu dan raih prestasi bersama kami!</p>
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

        // JS FAQ Toggel
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    question.classList.toggle('active');
                });
            });
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
