<?php
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

if(isset($_GET['kid'])) {
  $kid = $_GET['kid'];
  $query = "SELECT * FROM `keuangan_masjid` WHERE `id` LIKE '$kid'";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $keterangan = $data['keterangan'];
  $tanggal = $data['tanggal'];

  if(intval($data['masuk']) != 0) {
    $kategori = "Kas Masuk";
    $jumlah = $data['masuk'];
  } else {
    $kategori = "Kas Keluar";
    $jumlah = $data['keluar'];
  }

  if(isset($_POST['ubah'])) {
    session_start();
    $id = $_SESSION["id"];
    $keterangan = $_POST['keterangan'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    if($kategori == "Kas Masuk") {
      $query = "UPDATE `keuangan_masjid` SET `keterangan`='$keterangan',`keluar`='0',`masuk`='$jumlah',`tanggal`='$tanggal',`user_id`='$id' WHERE `id` LIKE '$kid'";
    }
    elseif($kategori == "Kas Keluar") {
      $query = "UPDATE `keuangan_masjid` SET `keterangan`='$keterangan',`masuk`='0',`keluar`='$jumlah',`tanggal`='$tanggal',`user_id`='$id' WHERE `id` LIKE '$kid'";
    }
    $result = mysqli_query($conn, $query);

    header("Location: ../keuangan.php");
  }
} else {
  header("Location: ../keuangan.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Keuangan - Masjid Annuur</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/admin/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Update Data Keuangan</h3>
        <a href="/user/admin/keuangan/keuangan.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post">
              
              <!-- Keterangan -->
              <div class="form-group row">
                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                  <textarea name="keterangan" class="form-control" id="keterangan" maxlength="255" rows="2" required><?= $keterangan?></textarea>
                </div>
              </div><br>

              <!-- Kategori -->
              <div class="form-group row">
                <label for="newkategori" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                  <select class="form-select" name="newkategori" id="newkategori">
                    <option selected disabled></option>
                    <option value="masuk">Kas Masuk</option>
                    <option value="keluar">Kas Keluar</option>
                  </select>
                </div>
              </div><br>

              <!-- Jumlah -->
              <div class="form-group row">
                <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                <div class="col-sm-9">
                  <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?= $jumlah?>" required>
                </div>
              </div><br>

              <!-- Tanggal -->
              <div class="form-group row">
                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-9">
                  <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $tanggal?>" required>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="ubah" class="btn btn-success btn-block">
                        <span>Ubah Data</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
            
    <!-- Javascript -->
    <?php
      // selected data in select form
      if($kategori == "masuk") {
        echo '<script type="text/javascript">
                document.getElementById("newkategori").getElementsByTagName("option")[1].selected = "selected"
              </script>';
      } else {
        echo '<script type="text/javascript">
                document.getElementById("newkategori").getElementsByTagName("option")[2].selected = "selected"
              </script>';
      }
    ?>
  </body>
</html>