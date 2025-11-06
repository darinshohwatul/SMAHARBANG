<!-- Sidebar Toggle Script -->
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
  }

  function closeSidebar() {
    document.getElementById('sidebar').classList.add('-translate-x-full');
    document.getElementById('overlay').classList.add('hidden');
  }
</script>

<!-- Overlay (mobile only) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-full bg-blue-800 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
  <div class="p-6 font-bold text-xl border-b border-blue-700">E-Learning</div>
  <nav class="flex flex-col p-4 space-y-3 text-sm">
    <a href="/e-learning/pages/guru/dashboard.php" class="hover:bg-blue-700 p-2 rounded">🏠 Dashboard</a>
    <a href="/e-learning/pages/guru/materi/materi.php" class="hover:bg-blue-700 p-2 rounded">📚 Materi</a>
    <a href="/e-learning/pages/guru/tugas/tugas.php" class="hover:bg-blue-700 p-2 rounded">📝 Tugas</a>
    <a href="/e-learning/pages/guru/nilai/nilai.php" class="hover:bg-blue-700 p-2 rounded">⭐ Nilai</a>
    <a href="/e-learning/pages/guru/forum/forum.php" class="hover:bg-blue-700 p-2 rounded">💬 Forum</a>
    <a href="/e-learning/pages/guru/pengumuman/pengumuman.php" class="hover:bg-blue-700 p-2 rounded">📢 Pengumuman</a>
    <a href="/e-learning/pages/guru/profil.php" class="hover:bg-blue-700 p-2 rounded">👤 Profil</a>
    <a href="/e-learning/auth/logout.php" class="hover:bg-red-600 p-2 rounded mt-4">🚪 Logout</a>
  </nav>
</aside>

<!-- Topbar (Header) -->
<div class="md:ml-64 w-full">
  <div class="bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-20">
    <!-- Hamburger Button (Mobile only) -->
    <button onclick="toggleSidebar()" class="md:hidden text-blue-800 text-2xl">&#9776;</button>
    <span class="text-lg font-bold text-blue-800">Selamat Datang, <?= htmlspecialchars($user['nama']) ?>!</span>
  </div>
 