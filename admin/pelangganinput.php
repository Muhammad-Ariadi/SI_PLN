<?php
$pageTitle = "Pelanggan";
include '../assets/layouts/sidebar.php';
$hasil = "SELECT * FROM tbl_pelanggan ";

$tampil = mysqli_query($db, $hasil);

?>

<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Data Pelanggan</h6>
                            </div>
                            <br>
                            <div class="">
                                <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah data</a>
                            </div>
                        </div>
                        <div class="card-body px-2 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase ">Idpel</th>
                                            <th class="text-center text-uppercase ">Nama</th>
                                            <th class="text-center text-uppercase ">Daya</th>
                                            <th class="text-center text-uppercase ">Tipe</th>
                                            <th class="text-center text-uppercase ">Lokasi</th>
                                            <th class="text-center text-uppercase ">Pmet</th>
                                            <th class="text-center text-uppercase ">Merek</th>
                                            <th class="text-center text-uppercase ">tipe meter</th>
                                            <th class="text-center text-uppercase ">Nomer Meter</th>
                                            <th class="text-center text-uppercase ">Keterangan</th>
                                            <th class="text-center text-uppercase ">Rincian</th>
                                            <th class="text-center text-uppercase ">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($d = $tampil->fetch_array()) {
                                        ?>
                                            <tr class="d-flex">
                                                <td class="text-center text-s"><?php echo $d['idpel'] ?></td>
                                                <td class="text-center text-s" style="max-width: 100px;">
                                                    <div style="word-wrap: break-word; ">
                                                        <?php echo $d['nama_pel'] ?>
                                                    </div>
                                                </td>
                                                <td class="text-center text-s"><?php echo $d['daya'] ?></td>
                                                <td class="text-center text-s"><?php echo $d['tipe'] ?></td>
                                                <td class="text-center text-s">
                                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                                </td>
                                                <td class="text-center text-s">
                                                    <a href="javascript:void(0);" onclick="tampilkanGambar('../assets/img/file/<?php echo $d['pmet']; ?>')">
                                                        <img src="../assets/img/file/?php echo $d['pmet']; ?>" style="width: 50px; height: 100px">
                                                    </a>
                                                </td>
                                                <td class="text-center text-s"><?php echo $d['merk'] ?></td>
                                                <td class="text-center text-s"><?php echo $d['tipemet'] ?></td>
                                                <td class="text-center text-s"><?php echo $d['nomet'] ?></td>
                                                <td class="text-center text-s"><?php echo $d['ket'] ?></td>
                                                <td class="text-center text-s" style="max-width: 100px;">
                                                    <div style="word-wrap: break-word; ">
                                                        <?php echo $d['ket2'] ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="pelangganaksi.php?kode=<?php echo $d['idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['idpel']; ?>')">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div id="gambarPopUp" class="modal">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Bukti Dokumentasi</h3>
                                            <span class="close" onclick="tutupPopUp()">&times;</span>
                                        </div>
                                        <div class="modal-body">
                                            <img id="gambarModal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1" />
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)" />
                    </div>
                </div>
                <hr class="horizontal dark my-3" />
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)" />
                    </div>
                </div>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
        <script>
            var win = navigator.platform.indexOf("Win") > -1;
            if (win && document.querySelector("#sidenav-scrollbar")) {
                var options = {
                    damping: "0.5",
                };
                Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
            }
        </script>

        <?php
        include '../assets/layouts/footer.php'
        ?>
</body>