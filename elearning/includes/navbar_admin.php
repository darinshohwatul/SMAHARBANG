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
    <a href="/e-learning/pages/admin/dashboard.php" class="hover:bg-blue-700 p-2 rounded">🏠 Dashboard</a>
    <a href="/e-learning/pages/admin/pengguna/kelola_pengguna.php" class="hover:bg-blue-700 p-2 rounded">👤 Kelola Pengguna</a>
    <a href="/e-learning/pages/admin/forum/kelola_forum.php" class="hover:bg-blue-700 p-2 rounded">💬 Kelola Forum</a>
    <a href="/e-learning/pages/admin/pengumuman/pengumuman.php" class="hover:bg-blue-700 p-2 rounded">📢 Kelola Pengumuman</a>
    <a href="/e-learning/pages/admin/naik_kelas.php" class="hover:bg-blue-700 p-2 rounded">📚 Naik Kelas</a>
    <a href="/e-learning/pages/admin/ppdb/daftar_ppdb.php" class="hover:bg-blue-700 p-2 rounded">📑 Kelola pendaftaran </a>
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
 