<?php 
require_once '../config.php';

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['passwd'];

  $query = "SELECT `id`,`nama`,`roles`,`password` FROM user
            WHERE `username`='$username'";

  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  if(!empty($data) && password_verify($password, $data['password'])){
    session_start();
    $_SESSION["id"] = $data['id'];
    $_SESSION["nama"] = $data['nama'];
    $_SESSION["role"] = $data['roles'];

    setcookie('id', $data['id'], time()+3600, '/');
    setcookie('nama', $data['nama'], time()+3600, '/');
    setcookie('role', $data['roles'], time()+3600, '/');

    if($data['roles'] == "ADMINISTRATOR") {
      header("location: ../admin/dashboard.php");
    } elseif($data['roles'] == "BENDAHARA MASJID") {
      header("location: ../bendahara/dashboard.php");
    } else {

    }
  } else {
    
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/auth/login.css" />
    <link rel="stylesheet" href="/user/bendahara/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">

    <!-- cdn bootstrap 5 & icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- cdn font style -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap" />
  </head>

  <body class="text-center">
    <main>
      <div class="container-fluid form-signin transition">
        <!-- card login -->
        <div class="card border shadow">
          <div class="card-body mx-4 my-3">
            <img class="logo mb-1" src="\assets\image\logo-annur-bulat.png" />
            <h4 class="mb-3">Sistem Informasi TPQ Annuur</h4>

            <form class="text-center" method="post">
              <div class="mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
              </div>
              <div class="mb-4">
                <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Password" required>
              </div>
              <button type="submit" class="w-100 mb-1 btn btn-success" name="login">Login</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    
    <footer>
      <div class="container-fluid footer transition">
        <div class="menu row">
          <div class="col-sm-4">
            <a href="rekap-spp.php" class="btn btn-success p-3">
              <div class="text-center">
                <img class="img-btn mb-3" src="\assets\image\logo-annur-bulat.png" />
                <h6>Web Masjid</h6>
              </div>
            </a>
          </div>
          <div class="col-sm-4">
            <a href="rekap-spp.php" class="btn btn-success p-3">
              <div class="text-center">
                <img class="img-btn mb-3" src="\assets\image\logo-annur-bulat.png" />
                <h6>TPQ Annuur</h6>
              </div>
            </a>
          </div>
          <div class="col-sm-4">
            <a href="rekap-spp.php" class="btn btn-success p-3">
              <div class="text-center">
                <img class="img-btn mb-3" src="\assets\image\logo-annur-bulat.png" />
                <h6>Keuangan Masjid</h6>
              </div>
            </a>
          </div>
        </div>
        <div class="footer-divider mx-5"></div>

        <h6 class="copyright">Powered by Teknik Informatika UIN Sunan Kalijaga 2022</h6>
      </div>
    </footer>
  </body>
</html>