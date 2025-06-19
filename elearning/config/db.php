<?php
class Database {
    private $host = "localhost";
    private $db_name = "elearningsma";
    private $username = "root";
    private $password = "";
    private $conn;

    // Fungsi untuk mendapatkan koneksi PDO
    public function getConnection() {
        $this->conn = null;
        try {
            // DSN (Data Source Name)
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            
            // Buat koneksi PDO dengan opsi error mode dan prepared statement
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // Opsi lain bisa ditambahkan di sini

        } catch(PDOException $exception) {
            echo "Koneksi gagal: " . $exception->getMessage();
            exit;
        }
        return $this->conn;
    }
}
?>
