<?php
include 'koneksi.php';

// Hitung jumlah
$jml_siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM siswa"))['total'];
$jml_guru  = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM guru"))['total'];
$jml_kelas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kelas"))['total']; 
$jml_mapel = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM mata_pelajaran"))['total'];

// Ambil data tabel
$data_siswa = mysqli_query($koneksi, "
    SELECT s.id_siswa, s.nama, k.nama_kelas
    FROM siswa s
    JOIN kelas k ON s.id_kelas = k.id_kelas
");

$data_guru = mysqli_query($koneksi, "
    SELECT g.id_guru, g.nama, m.nama_mapel, k.nama_kelas
    FROM guru g
    JOIN mata_pelajaran m ON g.id_mapel = m.id_mapel
    JOIN KELAS K ON g.id_kelas = k.id_kelas
");

$data_kelas = mysqli_query($koneksi, "
   SELECT * FROM kelas
");

$data_mapel = mysqli_query($koneksi, "
    SELECT m.id_mapel, m.nama_mapel, g.nama as guru_pengampu, k.nama_kelas
    FROM mata_pelajaran m
    JOIN guru g ON m.id_mapel = g.id_mapel
    JOIN kelas k ON g.id_kelas = k.id_kelas
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sekolah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f6f9; }
        .dashboard { display: flex; gap: 20px; margin-bottom: 20px; }
        .card {
            background: white; padding: 20px; border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            flex: 1; text-align: center; cursor: pointer; transition: 0.3s;
        }
        .card:hover { background: #007bff; color: white; }
        .card h2 { margin: 0; font-size: 28px; }
        .card p { margin: 5px 0 0; font-size: 16px; }
        table {
            border-collapse: collapse; width: 100%; margin-bottom: 30px;
            display: none; /* disembunyikan dulu */
        } 
        table, th, td { border: 1px solid #ddd; } 
        th, td { padding: 10px; text-align: left; } 
        th { background: #007bff; color: white; }
        .show { display: table; }
    </style>
</head>
<body>

<h1>Dashboard Sekolah</h1>

<div class="dashboard">
    <div class="card" onclick="showTable('siswa')">
        <h2><?php echo $jml_siswa; ?></h2>
        <p>Siswa</p>
    </div>
    <div class="card" onclick="showTable('guru')">
        <h2><?php echo $jml_guru; ?></h2>
        <p>Guru</p>
    </div>
    <div class="card" onclick="showTable('kelas')">
        <h2><?php echo $jml_kelas; ?></h2>
        <p>Kelas</p>
    </div>
    <div class="card" onclick="showTable('mapel')"> 
        <h2><?php echo $jml_mapel; ?></h2>
        <p>Mata Pelajaran</p>
    </div>
</div>

<!-- Tabel Data Siswa-->
<table id="tabel-siswa">
    <tr><th>ID</th><th>Nama Siswa</th><th>Kelas</th></tr>
    <?php while ($row = mysqli_fetch_assoc($data_siswa)) { ?>
    <tr>
        <td><?php echo $row['id_siswa']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['nama_kelas']; ?></td>
    </tr>
    <?php } ?>
</table>

<!-- Tabel Data Guru-->
<table id="tabel-guru">
    <tr><th>ID</th><th>Nama Guru</th><th>Mata Pelajaran</th><th>Kelas</th></tr>
    <?php while ($row = mysqli_fetch_assoc($data_guru)) { ?>
    <tr>
        <td><?php echo $row['id_guru']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['nama_mapel']; ?></td>
        <td><?php echo $row['nama_kelas']; ?></td>
    </tr>
    <?php } ?>
</table>

<!-- Tabel Data Kelas -->
<table id="tabel-kelas">
    <tr><th>ID</th><th>Nama Kelas</th></tr>
    <?php while ($row = mysqli_fetch_assoc($data_kelas)) { ?>
    <tr>
        <td><?php echo $row['id_kelas']; ?></td>
        <td><?php echo $row['nama_kelas']; ?></td>
    </tr>
    <?php } ?>
</table>

<!-- Tabel Data Mata Pelajaran -->
<table id="tabel-mapel">
    <tr><th>ID</th><th>Nama Mapel</th><th>Guru Pengampu</th><th>Kelas</th></tr>
    <?php while ($row = mysqli_fetch_assoc($data_mapel)) { ?>
    <tr>
        <td><?php echo $row['id_mapel']; ?></td>
        <td><?php echo $row['nama_mapel']; ?></td>
        <td><?php echo $row['guru_pengampu']; ?></td>
        <td><?php echo $row['nama_kelas']; ?></td>
    </tr>
    <?php } ?>
</table>
    <footer>
       <div class="container text-center">
           <p> marditya adril purwanto. 2025.</p>
       </div>
   </footer>
<script>
function showTable (type) {
    // Sembunyikan semua tabel
    document.querySelectorAll("table").forEach(t => t.classList.remove("show"));

    // Tampilkan tabel sesuai klik
    if(type === 'siswa') document.getElementById("tabel-siswa").classList.add("show"); 
    if(type === 'guru') document.getElementById("tabel-guru").classList.add("show"); 
    if(type === 'kelas') document.getElementById("tabel-kelas").classList.add("show"); 
    if(type === 'mapel') document.getElementById("tabel-mapel").classList.add("show");
}
</script>

</body>
</html>