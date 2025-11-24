<?php include 'config.php' ; ?>
<!doctype html> 
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body class="bg-light">
    <div class="container py-4">
      <div class="d-flex align-items-center gap-3 mb-4">
        <h1 class="h3 mb-0">Dashboard sekolah</h1>
      </div>

      <div class="row g-3 mb-3">
        <?php
        $cSiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as cnt FROM siswa")) ['cnt'] ?? 0; 
        $cGuru = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as cnt FROM guru")) ['cnt'] ?? 0; 
        $cKelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as cnt FROM kelas")) ['cnt'] ?? 0; 
        $cMapel = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as cnt FROM mata_pelajaran")) ['cnt'] ?? 0;

        $cards = [
          ['title'=>'siswa','count'=>$cSiswa],
          ['title'=>'guru','count'=>$cGuru],
          ['title'=>'kelas','count'=>$cKelas],
          ['title'=>'mata pelajaran','count'=>$cMapel]
        ];

        foreach ($cards as $card) {
          echo '<div class="col-12 col-md-6 col-lg-3">
                  <div class="card shadow-sm p-3 h-100 text-center">
                    <div class="display-6 fw-bold">'.$card['count'].'</div>
                    <div class="text-muted">'.$card['title'].'</div>
                   </div>
                 </div>';
        }
        ?>
      </div>

      <div class="d-flex justify-content-center flex-wrap gap-3 mb-4">
        <a href="guru.php" class="btn btn-primary px-4">Kelola Guru</a>
        <a href="kelas.php" class="btn btn-success px-4">Kelola Kelas</a>
        <a href="mapel.php" class="btn btn-warning px-4 text-dark">Kelola mapel</a>
        <a href="siswa.php" class="btn btn-info px-4 text-dark">Kelola Siswa</a>
      </div>

      <div class="card shadow-sm">
        <div class="card-body p-0">
          <table class="table table-striped mb-0">
            <thead class="table-primary">
              <tr>
                <th style="width: 80px">ID</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($koneksi, "SELECT g.id_guru, g.nama, g.mata_pelajaran, k.nama_kelas
                                       FROM guru g
                                       LEFT JOIN kelas k ON g.id_kelas=k.id_kelas 
                                       ORDER BY g.id_guru ASC");
            while ($r= mysqli_fetch_assoc($q)) {
              echo '<tr>';
              echo '<td>'.$r['id_guru'].'</td>';
              echo '<td>'.$r['nama'].'</td>';
              echo '<td>'.$r['mata_pelajaran'].'</td>';
              echo '<td>'.$r['nama_kelas'].'</td>';
              echo '</tr>';
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>

      <footer class="mt-4 text-muted text-center">© 2025 Nama marditya adril purwanto. All Rights Reserved. </footer> 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap 5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>