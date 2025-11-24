<?php
$host = "localhost";
$user = "root"; // sesuaikan dengan user MySQL
$pass = "";     // sesuaikan password MySQL
$db   = "db_sekolah"; // nama database

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>