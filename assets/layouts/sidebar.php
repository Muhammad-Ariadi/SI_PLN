<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIPLN</title>
    <link href="../assets/img/Logo_PLN.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .nav-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
        }

        .nav-link:hover {
            background-color: #ccc;
        }

        .sb-nav-link-icon {
            margin-right: 10px;
        }

        .nav-submenu {
            display: none;
        }

        .nav-item.active .nav-submenu {
            display: block;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-info">
        <a class="navbar-brand ps-3 text-center" href="index.php"><b>SIPLN</b></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">

            </div>
        </form>
        <ul class="navbar-nav d-md-inline-block form-inline  ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbar" href="logout.php" role="button"><i class="fas fa-sign-out-alt"></i> Log out</a>

            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-footer">
                            <div class="d-flex align-items-center">
                                <img src="../assets/img/Logo_PLN.png" width="45px" height="60px" alt="Footer Image">
                                <div class="ms-3" style="color: #fff;">
                                    <b>SIPLN</b><br>
                                    <a>UP3 Banjarmasin</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../admin/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#dataDropdown">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data
                            </a>
                            <div class="nav-submenu">
                                <ul class="small" id="dataDropdown">
                                    <a class="nav-link" href="../admin/pelangganinput.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></i></div>
                                        Pelanggan
                                    </a>
                                    <a class="nav-link" href="../admin/akuninput.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-lock"></i></div>
                                        Hak Akses
                                    </a>
                                    <a class="nav-link" href="../admin/targetinput.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-check"></i></div>
                                        Target
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <script>
                // Cek jika ada cookie yang menyimpan status dropdown
                document.addEventListener("DOMContentLoaded", function() {
                    var dataDropdown = document.getElementById("dataDropdown");

                    // Periksa jika ada cookie dengan nama "dataDropdownOpen"
                    var isDropdownOpen = getCookie("dataDropdownOpen");

                    // Jika ada cookie dan nilainya "true," buka dropdown
                    if (isDropdownOpen === "true") {
                        dataDropdown.classList.add("show");
                    }

                    // Temukan elemen yang memicu dropdown
                    var dataLink = document.querySelector('[data-toggle="collapse"]');

                    // Tambahkan event listener untuk mengatasi klik
                    dataLink.addEventListener("click", function(event) {
                        event.preventDefault(); // Untuk mencegah navigasi

                        // Toggle (buka/tutup) dropdown
                        dataDropdown.classList.toggle("show");

                        // Simpan status dropdown dalam cookie
                        var isDropdownOpen = dataDropdown.classList.contains("show");
                        setCookie("dataDropdownOpen", isDropdownOpen.toString(), 30);
                    });

                    // Fungsi untuk mengambil nilai cookie
                    function getCookie(name) {
                        var value = "; " + document.cookie;
                        var parts = value.split("; " + name + "=");
                        if (parts.length === 2) {
                            return parts.pop().split(";").shift();
                        }
                    }

                    // Fungsi untuk mengatur nilai cookie
                    function setCookie(name, value, days) {
                        var expires = "";
                        if (days) {
                            var date = new Date();
                            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                            expires = "; expires=" + date.toUTCString();
                        }
                        document.cookie = name + "=" + value + expires + "; path=/";
                    }
                });
            </script>