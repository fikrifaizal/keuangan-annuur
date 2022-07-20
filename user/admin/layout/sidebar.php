<?php 
$name = explode(" ", $_SESSION["nama"]);
$role = explode(" ", $_SESSION["role"]);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- cdn bootstrap 5 & icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- cdn dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <!-- cdn font style -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap" />
    <!-- lib datepicker -->
    <link rel="stylesheet" href="/lib/css/bootstrap-datepicker3.min.css" />
    <!-- css sidebar -->
    <link rel="stylesheet" href="/user/admin/layout/sidebar.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
  </head>

  <body>
    <!-- start of top navigation bar -->
    <nav class="navbar navbar-light navbar-expand-lg fixed-top shadow">
      <div class="container-fluid">
        
        <!-- sidebar button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <!-- navbar title -->
        <a class="navbar-brand me-auto ms-lg-0 mx-2 text-uppercase fw-bold navbar-title text-black">SIMKAS</a>
        <!-- account button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbar-margin" id="topNavBar">
          <div class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <img class="logo" src="\assets\image\logo-annur-bulat.png" />
              <span class="topbar-text">Selamat Datang di Sistem Informasi Manajemen Keuangan</span>
            </li>
          </div>

          <div class="topbar-divider"></div>

          <div class="d-flex">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-user" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-lg-inline me-2"><?= ucfirst(strtolower($name['0']))?></span>
                  <img class="img-profile rounded-circle" src="\assets\image\user.png">
                </a>

                <!-- Dropdown User Information -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-margin-top fade-down" aria-labelledby="userDropdown">
                  <li>
                    <a class="dropdown-item" href="/user/admin/pengaturan/pengaturan.php">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      <span>Pengaturan</span>
                    </a>
                  </li>
                  <li><div class="dropdown-divider"></div></li>
                  <li>
                    <a class="dropdown-item" href="/user/auth/logout.php" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      <span>Keluar</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- end of top navigation bar -->

    <!-- start of offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="sidebar">
      <div class="offcanvas-body p-0">
        <nav class="navbar-light">
          <ul class="navbar-nav">
            <div class="side-property">
              <span class="nav-link text-light item-property mx-4 my-1">
                <span class="me-2"><i class="bi bi-calendar"></i></span>
                <span>
                  <script type="text/javascript">
                    var months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                    var myDays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum&#39;at", "Sabtu"];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                      thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = yy < 1000 ? yy + 1900 : yy;
                    document.write(thisDay + ", " + day + " " + months[month] + " " + year);
                  </script>
                </span>
              </span>
            </div>
            <div class="side-divider mx-4"></div>

            <!-- sidebar item -->
            <li class="mx-4">
              <a href="/user/admin/dashboard.php" class="btn-sidebar nav-link text-light">
                <span class="me-2"><i class="bi bi-columns-gap"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            
            <li class="mx-4 mb-3">
              <div class="navbar-divider my-3"></div>
              <div class="text-light small fw-bold text-uppercase"><label>Keuangan Masjid</label></div>
              <a href="/user/admin/keuangan/keuangan.php" class="btn-sidebar nav-link text-light">
                <span class="me-2"><i class="bi bi-wallet2"></i></span>
                <span>Laporan Keuangan</span>
              </a>
            </li>
            <!-- sidebar item -->
          </ul>
        </nav>
      </div>
    </div>
    <!-- end of offcanvas -->

    <!-- Javascript Support -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- dataTables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

    <!-- datepicker -->
    <script type="text/javascript" src="/lib/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/lib/locales/bootstrap-datepicker.id.min.js"></script>

    <script>
      $(document).ready(function () {
        $('#dataTables-table').dataTable();
      });
    </script>
  </body>
</html>