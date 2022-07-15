<?php
require_once('../../config.php');
require_once('../../helper.php');
require_once('../akses.php');
$id = $_SESSION["id"];

// danger modal
$setAlertCondition = false;
$setAlertText = "";

$query = "SELECT `nama`,`username` FROM `user` WHERE `id` LIKE '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result, MYSQLI_ASSOC);

$nama = $data['nama'];
$username = $data['username'];

if(isset($_POST['ubah'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];

  if(isset($_POST['passwd'])) {
    if($_POST['passwd'] == $_POST['passwdulang']) {
      $passwd = password_hash($_POST['passwd'],PASSWORD_DEFAULT,['cost' => 10]);

      $query = "UPDATE `user` SET `nama`='$nama',`username`='$username',`password`='$passwd' WHERE `id` LIKE '$id'";
      $result = mysqli_query($conn, $query);

      header("Location: ../dashboard.php");
    } else {
      $setAlertCondition = true;
      $setAlertText = "Kedua password tidak sama!";
    }
  } else {
    $query = "UPDATE `user` SET `nama`='$nama',`username`='$username' WHERE `id` LIKE '$id'";
    $result = mysqli_query($conn, $query);
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/bendahara/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
    <style>
    </style>
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Pengaturan</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post">

              <!-- Nama -->
              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" value="<?= $nama?>" required>
                </div>
              </div><br>

              <!-- Username -->
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" name="username" class="form-control" id="username" value="<?= $username?>" required>
                </div>
              </div><hr>

              <!-- danger alert -->
              <div class="alert alert-danger alert-dismissible fade show" id="alert">
                <strong><?= $setAlertText;?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              <!-- Password -->
              <div class="form-group row">
                <label for="passwdBaru" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                  <input type="password" name="passwd" class="form-control" id="passwdBaru">
                </div>
              </div><br>
              <!-- Ulang Password -->
              <div class="form-group row">
                <label for="passwdBaruUlang" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                <div class="col-sm-10">
                  <input type="password" name="passwdulang" class="form-control" id="passwdBaruUlang">
                </div>
              </div><hr>

              <!-- Button -->
              <div class="form-group row mt-2">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="ubah" class="btn btn-success btn-block">
                        <span><i class="bi bi-pencil"></i></span>
                        <span>Update</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <!-- Modal Danger -->
            <div class="modal fade" tabindex="-1" id="modalDanger" aria-hidden="true" >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p><?=$setDangerText?></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <!-- Show Alert -->
    <?php
      if($setAlertCondition) {
        echo '<script type="text/javascript">
                $("#alert").show();
              </script>';
      } else {
        echo '<script type="text/javascript">
                $("#alert").hide();
              </script>';
      }
    ?>
  </body>
</html>