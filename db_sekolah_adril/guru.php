<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>Kelola Guru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-4 text-center">Kelola Data Guru</h2>
  <div class="d-flex justify-content-between mb-3">
    <a href="index.php" class="btn btn-secondary"> Kembali</a>
    <button class="btn btn-primary" data-bs-target="modal" data-bs-target="#modal Tambah">+ Tambah Guru</button>
  </div>

  <!-- Tabel Guru -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-primary">
          <tr>
            <th>ID</th><th>Nama</th> <th>Mata Pelajaran</th><th>ID Mapel</th><th>ID Kelas</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $q= mysqli_query($koneksi, "SELECT * FROM guru ORDER BY id_guru ASC");
        while ($r = mysqli_fetch_assoc($q)) {
          echo "<tr>
                  <td>{$r['id_guru']}</td>
                  <td>{$r['nama']}</td>
                  <td>{$r['mata_pelajaran']}</td>
                  <td>{$r['id_mapel']}</td>
                  <td>{$r['id_kelas']}</td>
                  <td>
                    <a href='?hapus={$r['id_guru']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>
                    <a href='?edit={$r['id_guru']}' class='btn btn-warning btn-am'>Edit</a>
                  </td>
                </tr>";
        }  
        ?> 
        </tbody>
      </table>
    </div>
  </div>

  <?php
  // Proses Tambah
  if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $mapel = $_POST['mata_pelajaran'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id kelas'];
    mysqli_query($koneksi, "INSERT INTO guru (nama, mata pelajaran, id_mapel, id_kelas) VALUES ('$nama', '$mapel', '$id_mapel', '$id_kelas') ");
    echo "<meta http-equiv='refresh' content='0'>";
  }

  // Proses Hapus
  if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id'");
    echo "<meta http-equiv='refresh' content='0;url=guru.php'>";
  }

  // Proses Edit
  if (isset($_POST['update'])) {
    $id = $_POST['id_guru'];
    $nama = $_POST['nama'];
    $mapel = $_POST['mata_pelajaran'];
    $id_mapel = $_POST['id_mapel'];
    $id_kelas = $_POST['id_kelas'];
    mysqli_query($koneksi, "UPDATE guru SET nama='$nama', mata_pelajaran='$mapel', id_mapel='$id_mapel', id_kelas='$id_kelas' WHERE id_guru='$id'");
    echo "<meta http-equiv='refresh' content='0;url=guru.php'>";
  }
  ?>

  <!-- Modal Tambah-->
  <div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Tamba
        <form method="POST">
          <div class="modal-body">
            <input type="text" name="nama" class="form-control mb-2" placeholder="nama guru" required>
            <input type="text" name="mata_pelajaran" class="for-control mb-2" placeholder="mata pelajaran" required>
            <input type="number" name="id_mapel" class="form-control mb-2" placeholder="ID Mapel" required>
            <input type="number" name="id kelas" class="form-control mb-2" placeholder="ID Kelas" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>