<?php
// koneksi Database
$server = "localhost";
$user = "root";
$pass = "";
$database = "lsp";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));


// jika tombol simpan diklik
if (isset($_GET['hal'])) {
  $hala = $_GET['hal'];
} else {
  $hala = isset($_GET['hal']) ? $_GET['hal'] : '';;
}



//Pengujian apakah data akan di edit atau disimpan"
if (isset($_POST['bsimpan'])) {
  if ($hala == "edit") {


    //Data akan di edit
    $edit = mysqli_query($koneksi, "UPDATE pendaftaran set
                                            nm_pendaftar = '$_POST[nama_psrta]',
                                            email_pendaftar = '$_POST[email_pendaftar]',
                                            nik_pendaftar = '$_POST[nik_pendaftar]',
                                            Skema_pendaftar = '$_POST[Skema_pendaftar]'
                                            WHERE id_pendaftar = '$_GET[id]'
");

    if ($edit) {
      echo "<script>
alert('Edit data SUKSES!');
document.location = 'tabel-pendaftaran.php';
</script>";
    } else {
      echo "<script>
alert('Edit data GAGAL!!');
document.location = 'tabel-pendaftaran.php';
</script>";
    }
  } else {
    //Data akan disimpan Baru
    $simpan = mysqli_query($koneksi, "INSERT INTO pendaftaran (nm_pendaftar, email_pendaftar, nik_pendaftar, Skema_pendaftar)
    VALUES ('$_POST[nama_psrta]', '$_POST[email_pendaftar]', '$_POST[nik_pendaftar]', '$_POST[Skema_pendaftar]')
");
    if ($simpan) {
      echo "<script>
          alert('Simpan data SUKSES!');
          </script>";
    } else {
      echo "<script>
        alert('Simpan data GAGAL!!');
        document.location = 'tabel-pendaftaran.php';
        </script>";
    }
  }
}


// pengujian jika tombol edit / hapus di klik
if ($hala) {
  // Pengujian jika edit data
  if ($_GET['hal'] == "edit") {
    // Tampilkan data yang akan diedit
    $tampil = mysqli_query($koneksi, " SELECT *FROM pendaftaran WHERE id_pendaftar = '$_GET[id]' ");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
      //Jika data ditemukan, maka data ditampung ke dalam variabel
      $namabarang = $data['nm_pendaftar'];
      $email_pendaftar = $data['email_pendaftar'];
      $nik_pendaftar = $data['nik_pendaftar'];
      $Skema_pendaftar = $data['Skema_pendaftar'];
    }
  } else if ($_GET['hal'] == "hapus") {
    // persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM pendaftaran where id_pendaftar = '$_GET[id]' ");
    if ($hapus) {
      echo "<script>
alert('Hapus data berhasil !!');
document.location = 'tabel-pendaftaran.php';
</script>";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LSP By Aditya</title>
  <link rel="stylesheet" href="frontend/libraries/bootstrap/css/bootstrap.css" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="shortcut icon" href="https://lspdigital.id/images/homepage/icon.png">


  <link rel="stylesheet" href="frontend/styles/ini.css" />
</head>

<body>

  <!-- Navbar -->
  <div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
      <a href="index1.php" class="navbar-brand">
        <img src="https://lspdigital.id/images/homepage/icon.png" alt="Logo lsp">
      </a>
      <p class="brand brand-text mr-auto mb-0">
        Kompeten
        <br> Profesional
        <br> Inovatif
      </p>
      <button class=" navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav ml-auto mr-3">
          <li class="nav-item mx-md-2">
            <a href="#" class="nav-link active">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown">
              Profile
            </a>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">Visi & Misi</a>
              <a href="#" class="dropdown-item">Mitra Kerja</a>
              <a href="#" class="dropdown-item">Stakeholder</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="dropdown" data-toggle="dropdown">
              Informasi
            </a>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">Download Area</a>
              <a href="#" class="dropdown-item">Lembaga Diklat</a>
              <a href="#" class="dropdown-item">Event</a>
              <a href="#" class="dropdown-item">Faq</a>
            </div>
          </li>
          <li class="nav-item mx-md-2">
            <a href="#" class="nav-link">Hubungi Kami</a>
          </li>
        </ul>

        <!-- Mobile Button -->
        <form action="" class="form-inline d-sm-block d-md-none">
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
            <a href="tabel-pendaftaran.php">Daftar</a>
          </button>
        </form>

        <!-- Desktop Button -->
        <form action="" class="form-inline my-2 my-lg-0 d-none d-md-block">
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
            <a href="tabel-pendaftaran.php">Daftar</a>
          </button>
        </form>
      </div>
    </nav>
  </div>



  <main>
    <div class="container ">
      <h1 class="text-left mt-3 ">FR-APL-01. FORMULIR PERMOHONAN SERTIFIKASI KOMPETENSI</h1>
      <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal anda pada saat ini.</p>

      <!-- Awal Card Form -->
      <div class="card mt-3">
        <div class="card-header bg-success text-white">
          Form Pendaftaran LSP
        </div>
        <div class="card-body">
          <form method="POST" action="">
            <div class="form-group">
              <label>Nama Lengkap </label>
              <input type="text" name="nama_psrta" value="<?= @$namapendaftar ?>" class="form-control"
                placeholder="Input Nama Lengkap Anda Disini!" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email_pendaftar" value="<?= @$email_pendaftar ?>" class="form-control"
                placeholder="Input Email disini!" required>
            </div>
            <div class="form-group">
              <label>NIK</label>
              <input type="text" name="nik_pendaftar" value="<?= @$nik_pendaftar ?>" class="form-control"
                placeholder="Input NIK Anda disini!" required>
            </div>
            <div class="form-group">
              <label>Skema</label>
              <input type="text" name="Skema_pendaftar" value="<?= @$Skema_pendaftar ?>" class="form-control"
                placeholder="Input Skema yang anda pilih disini!" required>
            </div>
            <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

          </form>
        </div>
      </div>
      <!-- Akhir Card Form-->



      <!-- Awal Card Form -->
      <div class="card mt-5">
        <div class="card-header bg-primary  text-white">
          Data Nama Pendaftar
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-striped">
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>NIK</th>
              <th>Skema</th>
              <th>Aksi</th>
            </tr>

            <?php

            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * from pendaftaran order by id_pendaftar desc");
            while ($data = mysqli_fetch_array($tampil)) :

            ?>

            <tr>
              <td><?= $no++ ?></td>
              <td><?= $data['nm_pendaftar'] ?></td>
              <td><?= $data['email_pendaftar'] ?></td>
              <td><?= $data['nik_pendaftar'] ?></td>
              <td><?= $data['Skema_pendaftar'] ?> </td>
              <td>
                <a href="tabel-pendaftaran.php?hal=edit&id=<?= $data['id_pendaftar'] ?>" class="btn btn-warning">Edit</a>
                <a href="tabel-pendaftaran.php?hal=hapus&id=<?= $data['id_pendaftar'] ?>"
                  onclick="return confirm('Apakah yakin ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
              </td>
            </tr>

            <?php endwhile;  // penutup perulangan while

            ?>
          </table>


        </div>
      </div>
    </div>
    <!-- Akhir Card Form-->
  </main>

  <!-- footer -->
  <footer class="section-footer nt-5 nb-4 border-top">
    <div class="container pt-5 pb-5">
      <div class="row justify-alignt-center">
        <div class="col-12">
          <div class="row">
            <div class="col-12 col-lg-6">
              <h5>Mitra LSP</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="#">LSP MIGAS</a>
                </li>
                <li>
                  <a href="#">LSP MANAJEMEN RESIKO</a>
                </li>
                <li>
                  <a href="#">LSP STP BANDUNG</a>
                </li>
                <li>
                  <a href="#">KOMINFO</a>
                </li>
              </ul>
            </div>
            <div class="col-12 col-lg-6">
              <h5>LINK POPULAR</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="#">Training Online</a>
                </li>
                <li>
                  <a href="#">Pelatihan Assesor BNSP</a>
                </li>
                <li>
                  <a href="#">Registrasi Sertifikasi</a>
                </li>
                <li>
                  <a href="#">Event Terkini</a>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row border-top justify-content-center alignt-items-center pt-4">
        <div class="col-auto text-gray-500 font-weight-light">© Copyright 2021 - Aditya Gustian</div>
      </div>
    </div>
  </footer>






  <script src="frontend/libraries/jquery/jquery-3.4.1.min.js"></script>
  <script src="frontend/libraries/bootstrap/js/bootstrap.js"></script>
  <script src="frontend/libraries/retina/retina.min.js"></script>
</body>

</html>