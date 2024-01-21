<?php

error_reporting(0);
ini_set('display_errors', 0);
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    $query = $db->query("SELECT nama_lengkap, level, foto FROM tbl_akun WHERE username='$username'");
    $data = $query->fetch_assoc();
    $nama_lengkap = $data['nama_lengkap'];
    $imagePath = $data['foto'];
    $fotoProfilPath = '../assets/img/akun/' . $imagePath;

    if ($level == '0') {
        $queryTarget = $db->query("SELECT COUNT(*) as jumlah_target FROM tbl_pelanggan");
        $dataTarget = $queryTarget->fetch_assoc();
        $jumlah_target = $dataTarget['jumlah_target'];

        $queryTarget2 = $db->query("SELECT COUNT(*) as jumlah_target2 FROM tbl_target where status='0'");
        $dataTarget2 = $queryTarget2->fetch_assoc();
        $jumlah_target2 = $dataTarget2['jumlah_target2'];

        $queryTarget3 = $db->query("SELECT COUNT(*) as jumlah_akun FROM tbl_akun WHERE level='1'");
        $dataTarget3 = $queryTarget3->fetch_assoc();
        $jumlah_target3 = $dataTarget3['jumlah_akun'];

        $nama = "$nama_lengkap";
        $role = "$level";
    }
} else {
    header("location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/Logo_PLN.png" wi>
    <title>
        SIPLN | <?php echo $pageTitle; ?>
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />

    <!-- DataTable -->
    <link href="../assets/DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../assets/DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css " rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <style>
        /* Style untuk dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            left: -80px;
            /* Sesuaikan nilai left sesuai kebutuhan */
        }

        .dropdown-content img {
            width: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* pelangganinput */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-header {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            border-top-left-radius: calc(0.3rem - 1px);
            border-top-right-radius: calc(0.3rem - 1px);
        }

        .modal-content {
            display: block;
            margin: 0 auto;
            max-width: 20%;
        }

        .modal-body {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1rem;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        #gambarModal {
            max-width: 100%;
            max-height: 100%;
            cursor: pointer;
            transition: transform 0.2s;
        }

        #gambarModal.zoomed {
            transform: scale(2);
            /* Sesuaikan faktor skala sesuai kebutuhan zoom. */
        }

        .foto-user {
            border-radius: 150px;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="index.php" target="_blank">
                <img src="../assets/img/Logo_PLN.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">SIPLN</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <?php if ($level == '0') : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo ($pageTitle === 'Dashboard') ? 'active bg-gradient-primary' : ''; ?>" href="index.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Halaman Data</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo ($pageTitle === 'Pelanggan') ? 'active bg-gradient-primary' : ''; ?>" href="pelangganinput.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Pelanggan</span>
                    </a>
                </li>

                <!-- ini bagian untuk membatasi navbar untuk admin dan petugas -->
                <?php if ($level == '0') : ?>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo ($pageTitle === 'Target') ? 'active bg-gradient-primary' : ''; ?>" href="targetinput.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">receipt_long</i>
                            </div>
                            <span class="nav-link-text ms-1">Target</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Halaman Akun</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo ($pageTitle === 'Petugas') ? 'active bg-gradient-primary' : ''; ?>" href="akuninput.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Petugas </span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $pageTitle; ?></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0"><?php echo $pageTitle; ?></h6>
                </nav>
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="dropdown">
                        <img class="foto-user" style="border-radius: 100px; cursor: pointer;" width="40px" src="<?php echo $fotoProfilPath; ?>" alt="User profile picture" onclick="toggleDropdown()">
                        <div id="profileDropdown" class="dropdown-content">
                            <a href="#"><?php echo $nama_lengkap; ?></a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- End Navbar -->
</body>

<!-- Datatable download -->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/DataTables/DataTables-1.13.8/js/jquery.dataTables.min.js"> </script>
<script src="../assets/DataTables/DataTables-1.13.8/js/dataTables.bootstrap5.min.js"> </script>
<script src="../assets/DataTables/Buttons-2.4.2/js/dataTables.buttons.js"> </script>
<script src="../assets/DataTables/Buttons-2.4.2/js/buttons.bootstrap5.min.js"> </script>
<script src="../assets/DataTables/JSZip-3.10.1/jszip.min.js"> </script>
<script src="../assets/DataTables/pdfmake-0.2.7/pdfmake.min.js"> </script>
<script src="../assets/DataTables/pdfmake-0.2.7/vfs_fonts.js"> </script>
<script src="../assets/DataTables/Buttons-2.4.2/js/buttons.html5.min.js"> </script>
<script src="../assets/DataTables/Buttons-2.4.2/js/buttons.print.min.js"> </script>
<script src="../assets/DataTables/Buttons-2.4.2/js/buttons.colVis.min.js"> </script>

<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../js/datatables.js"></script>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("profileDropdown");
        dropdown.classList.toggle("show");
    }

    // Tutup dropdown jika pengguna mengklik di luar dropdown
    window.onclick = function(event) {
        if (!event.target.matches('.foto-user')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>