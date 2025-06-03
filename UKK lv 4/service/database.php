<?php
$host = "localhost";
$user = "root";
$pass = ""; // Ganti jika password MySQL kamu tidak kosong
$db   = "kantin"; // Sesuai dengan database yang kita buat

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
