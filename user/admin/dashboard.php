<?php
require_once('../config.php');
require_once('../helper.php');
include_once('akses.php');

// santri
$querySantri = "SELECT COUNT(induk) as santri FROM `santri`";
$resultSantri = mysqli_query($conn, $querySantri);
$dataSantri = mysqli_fetch_array($resultSantri, MYSQLI_ASSOC);

// pengasuh
$queryPengasuh = "SELECT COUNT(id) as pengasuh FROM `pengajar`";
$resultPengasuh = mysqli_query($conn, $queryPengasuh);
$dataPengasuh = mysqli_fetch_array($resultPengasuh, MYSQLI_ASSOC);

// petugas piket
$queryPiket = "SELECT COUNT(id) as piket FROM `piket`";
$resultPiket = mysqli_query($conn, $queryPiket);
$dataPiket = mysqli_fetch_array($resultPiket, MYSQLI_ASSOC);

// saldo
$querySaldo = "SELECT (SUM(masuk)-SUM(keluar)) as saldo FROM `keuangan_masjid`";
$resultSaldo = mysqli_query($conn, $querySaldo);
$dataSaldo = mysqli_fetch_array($resultSaldo, MYSQLI_ASSOC);

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
      include('layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Dashboard</h3>
        
        <!-- card info -->
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-primary text-uppercase mb-1">Santri</div>
                    <div class="h5 font-weight-bold"><?= $dataSantri['santri']?> Orang</div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-success text-uppercase mb-1">Pengasuh</div>
                    <div class="h5 font-weight-bold"><?= $dataPengasuh['pengasuh']?> Orang</div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-danger text-uppercase mb-1">Petugas Piket</div>
                    <div class="h5 font-weight-bold"><?= $dataPiket['piket']?> Orang</div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 mb-3">
            <div class="card border-left-secondary shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-secondary text-uppercase mb-1">Kas Masjid</div>
                    <div class="h5 font-weight-bold"><?= setIDRFormat($dataSaldo['saldo'])?></div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>