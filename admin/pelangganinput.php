<?php
$pageTitle = "Pelanggan";
include '../assets/layouts/sidebar.php';
$hasil = "SELECT * FROM tbl_pelanggan ";

$tampil = mysqli_query($db, $hasil);

?>

<!-- datatable -->
<!-- <link href="twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<script  src="https://code.jquery.com/jquery-3.7.0.js"> </script>
<script  src="1.13.7/js/jquery.dataTables.min.js"> </script>
<script  src="1.13.7/js/dataTables.bootstrap5.min.js"> </script>
<script  src="../assets/js/datatables.js"> </script> -->

<link href="../assets/DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="../assets/DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css " rel="stylesheet" />

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
                            <div class="table-responsive p-3">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Idpel</th>
                                            <th>Nama</th>
                                            <th>Daya</th>
                                            <th>Tipe</th>
                                            <th>Lokasi</th>
                                            <th>Pmet</th>
                                            <th>Merek</th>
                                            <th>tipe meter</th>
                                            <th>Nomer Meter</th>
                                            <th>Keterangan</th>
                                            <th>Rincian</th>
                                            <th>Opsi</th>

                                        </tr>
                                    </thead>
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
                                                <td class="text-center">
                                                    <a href="pelangganaksi.php?kode=<?php echo $d['idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['idpel']; ?>')">Hapus</a>
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


    <!-- 
    https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js
    https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js
    https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js
    https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
    https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
    https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js
    https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js
    https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js -->


    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
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