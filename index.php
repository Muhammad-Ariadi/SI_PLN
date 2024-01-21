<?php
if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'login') {
    session_start();
    include 'assets/conn/config.php';
    $username = $_POST['username'];
    $password = $_POST['password']; // No need to encrypt here

    $hasil = $db->query("SELECT * FROM tbl_akun WHERE username='$username'");
    $cek = mysqli_num_rows($hasil);

    if ($cek > 0) {
      $data = $hasil->fetch_assoc();
      $hashedPassword = $data['password'];

      // Verify the entered password against the stored hashed password
      if (password_verify($password, $hashedPassword)) {
        $_SESSION['kd_akun_user'] = $data['kd_akun']; // Save kd_akun in session
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];

        if ($data['level'] == '0') {
          header("location:admin/index.php");
        } elseif ($data['level'] == '1') {
          header("location:petlap/pelangganinput.php");
        } else {
          header("location:index.php?pesan=gagal");
        }
      } else {
        header("location:index.php?pesan=gagal");
      }
    } else {
      header("location:index.php?pesan=gagal");
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <title>Login | SIPLN</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <!-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> -->
</head>

<body class="bg-gray-200">
  <?php
  if (isset($_GET['aksi']) && $_GET['aksi'] == 'login') {
    echo "<div class='alert alert-danger text-center' role='alert'>Login anda gagal username dan password salah</div>";
  }
  ?>
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="
    background-image: url(assets/img/bg/3.PNG);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-size: 1920px 1080px;
    ">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class=" card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class=" shadow-primary border-radius-lg py-3 pe-1" style="background-color:#006e8c;">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Login</h4>
                  <div class="row mt-3">
                    <div class="text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <center>
                          <img style="width: 100px; display: inline-block; vertical-align: middle" src="assets/img/Logo_PLN.png" alt="Logo" />
                        </center>
                      </a>
                      <div style="text-align: center; color: white;">
                        <p>Sistem Informasi Berbasis Website</p>
                        <p style="font-size: 12px">Login ke Akun Anda</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="index.php?aksi=login" method="post" enctype="multipart/form-data" autocomplete="on" >
                  <div class="input-group input-group-outline my-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn w-100 my-4 mb-2" style="background-color:#006e8c; color:white;">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>