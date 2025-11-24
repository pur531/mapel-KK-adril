<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta nama="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Kelas</title>
  <link href="https://cdn.jadelive.net/npm/bootstrap@5.3.2/dist/cas/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="asanta/style.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-4 text-center">kelola data kelas</h2>

  <!-- Tombol Navigasi -->
  <div class="d-flex justify-content-between nb-3">
    <a href="index.php" class="btn btn-secondary Kenbali</a>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTanbah">+ Tambah Kelas</button>
  </div>

  <!-- Tabel Data -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-striped mb-0">
        <thead class="table-primary">
          <tr>
            <th>ID</th><th>Nama Kelas</th><th>ID Guru</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $q= mysqli_query($koneksi, "SELECT FROM kelan ORDER BY id kelas ASC");
        while ($r = mysqli_fetch_assoc($q)) {
          echo "<tr>
                  <td>{$r['id_kelas']}</td>
                  <td>{$r['nama_kelas']}</td>
                  <td>{$r['id_guru']}</td>
                  <td>
                    <a href='?hapus={$r['id_kelas']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin hapus?\")'>hapus</a>
                    <a href='?edit={$r['id_kelas']}' class='btn btn-warning btn-sm'>Edit</a>
                  </td>
                </tr>";
        }        
        ?>
        </tbody>
      </table>
    </div>
  </div>
     
     <?php
     // Tambah Data
     if (isset($_POST['simpan'])) {
       $nama = $_POST['nama_kelas'];
       $id_guru = $_POST['id_guru'];
       mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas, id_kelas, id_guru) VALUES ('$nama', '$id_guru')");
       echo "<meta http-equiv='refresh' content='0;url=kelas.php'>";
     }

     // Hapus Data
     if (isset($_GET['hapus'])) {
       $id = $_GET['hapus'];
       mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id'");
       echo "<meta http-equiv='refresh' content='0;url=kelas.php'>";
     }

     // Edit Data
     if (isset($_POST['update'])) {
       $id = $_POST['id_kelas'];
       $nama = $_POST['nama_kelas'];
       $id_guru = $_POST['id_guru'];
       mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama', id_guru='$id_guru' WHERE id_kelas='$id'");
       echo "<meta http-equiv='refresh' content='0;url=kelas.php'>";
     }
     ?>

     <!-- Modal Tambah -->
     <div class="modal fade" id="modalTambah" tabindex="-1">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header"><h5 class="modal-title">Tambah kelas</h5></div>
           <form method="POST">
             <div class="modal-body">
               <input type="text" name="nama_kelas" class="form-control mb-2" placeholder="Nama Kelas" required>
               <input type="number" name="id_guru" class="form-control mb-2" placeholder="ID guru" require>
             </div>
             <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
             <button type="submit" name="simpan" class="btn btn-primary">simpan</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>