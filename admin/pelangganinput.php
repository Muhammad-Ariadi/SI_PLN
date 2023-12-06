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
                                <h6 class="text-white text-capitalize ps-3">Pelanggan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder ">Idpel</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Nama</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Daya</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Tipe</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Lokasi</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Pmet</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Merek</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">tipe meter</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Nomer Meter</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Keterangan</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Rincian</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Opsi</th>
                                            <th class="text-secondary "></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        while ($d = $tampil->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $d['idpel'] ?></td>
                                                <td class="text-center" style="max-width: 100px;">
                                                    <div style="word-wrap: break-word; ">
                                                        <?php echo $d['nama_pel'] ?>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?php echo $d['daya'] ?></td>
                                                <td class="text-center"><?php echo $d['tipe'] ?></td>
                                                <td class="text-center">
                                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="tampilkanGambar('../file/<?php echo $d['pmet']; ?>')">
                                                        <img src="../file/<?php echo $d['pmet']; ?>" style="width: 50px; height: 100px">
                                                    </a>
                                                </td>
                                                <td class="text-center"><?php echo $d['merk'] ?></td>
                                                <td class="text-center"><?php echo $d['tipemet'] ?></td>
                                                <td class="text-center"><?php echo $d['nomet'] ?></td>
                                                <td class="text-center"><?php echo $d['ket'] ?></td>
                                                <td class="text-center" style="max-width: 100px;">
                                                    <div style="word-wrap: break-word; ">
                                                        <?php echo $d['ket2'] ?>
                                                    </div>
                                                </td>
                                                <!-- <td class="text-center">
                                                    <a href="pelangganaksi.php?kode=<?php echo $d['idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['idpel']; ?>')">Hapus</a>
                                                </td> -->
                                            </tr>
                                        <?php
                                            $counter++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include '../assets/layouts/setting.php'
    ?>
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