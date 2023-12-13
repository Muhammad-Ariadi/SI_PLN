<?php
$pageTitle = "Target Detail";
include '../assets/layouts/sidebar.php';

$kd_akun_user = $_SESSION['kd_akun_user'];
$kd_akun = $_GET['kd_akun']; // Ambil nilai kd_akun dari URL



?>
<link href="../assets/DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="../assets/DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css " rel="stylesheet" />


<style>
    .card-title {
        text-align: center;
    }

    .card-header {
        background-color: #CDF5FD
    }

    .container-xl {
        max-width: 1705px;
        /* Atur lebar maksimum kontainer sesuai dengan preferensi Anda */
    }
</style>

<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Data Target</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-3">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">ID PELANGGAN</th>
                                            <th class="text-center">RBM</th>
                                            <th class="text-center">MAPS</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">OPSI</th>
                                        </tr>
                                    </thead>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun' order by status='1'";
                                        $tampil = mysqli_query($db, $hasil);

                                        while ($db = $tampil->fetch_array()) {
                                            // Tampilkan data dari tabel tbl_target sesuai dengan kd_akun
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $counter; ?></td>
                                                <td class="text-center"><?php echo $db['idpel'] ?></td>
                                                <td class="text-center"><?php echo $db['rbm'] ?></td>
                                                <td class="text-center">
                                                    <a href='https://www.google.com/maps?q=<?php echo $db["latitude"] ?>,<?php echo $db["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                                </td>
                                                <td class="text-center"><?php
                                                                        if ($db['status'] == 0) {
                                                                            echo "Belum";
                                                                        } else {
                                                                            echo "Sudah";
                                                                        }
                                                                        ?> </td>
                                                <td class="text-center">
                                                    <a href="targetaksi.php?kode=<?php echo $db['idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $db['idpel']; ?>')">Hapus</a>

                                                </td>
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


    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });

        function hapusData(idpelanggan) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'targetproses.php?kode=' + idpelanggan + '&proses=proseshapus';
            }
        }
    </script>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script async src="https://buttons.github.io/buttons.js"></script>
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