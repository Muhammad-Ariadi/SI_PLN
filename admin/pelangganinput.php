<?php
$pageTitle = "Pelanggan";
include '../assets/layouts/sidebar.php';
$hasil = "SELECT * FROM tbl_pelanggan ";

$tampil = mysqli_query($db, $hasil);

?>

<link href="../assets/DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="../assets/DataTables/Buttons-2.4.2/css/buttons.bootstrap5.min.css " rel="stylesheet" />

<style>
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
        max-width: 25%;
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
        /* Ubah faktor skala sesuai kebutuhan zoom. */
    }

    .card-header {
        background-color: #CDF5FD
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
                                <h6 class="text-white text-capitalize ps-3">Pelanggan</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah data</a>
                                    </div>
                                </div>
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
                                                <td style="max-width: 120px; white-space: normal;">
                                                    <?php echo $d['idpel'] ?>
                                                </td>

                                                <td style="max-width: 150px; white-space: normal;">
                                                    <div style="word-wrap: break-word;">
                                                        <?php echo $d['nama_pel'] ?>
                                                    </div>
                                                </td>

                                                <td style="max-width: 100px; white-space: normal;">
                                                    <?php echo $d['daya'] ?>
                                                </td>

                                                <td style="max-width: 100px; white-space: normal;">
                                                    <?php echo $d['tipe'] ?>
                                                </td>

                                                <td class="text-center">
                                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                                </td>

                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="tampilkanGambar('../assets/file/datpel/<?php echo $d['pmet']; ?>')">
                                                        <img src="../assets/img/datpel/<?php echo $d['pmet']; ?>" style="width: 50px; height: 100px">
                                                    </a>
                                                </td>

                                                <td style="max-width: 200px; white-space: normal;">
                                                    <?php echo $d['merk'] ?>
                                                </td>

                                                <td style="max-width: 100px; white-space: normal;">
                                                    <?php echo $d['tipemet'] ?>
                                                </td>

                                                <td style="max-width: 100px; white-space: normal;">
                                                    <?php echo $d['nomet'] ?>
                                                </td>

                                                <td style="max-width: 100px; white-space: normal;">
                                                    <?php echo $d['ket'] ?>
                                                </td>

                                                <td style="max-width: 400px; white-space: normal;">
                                                    <?php echo $d['ket2'] ?>
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
        </div>
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
                buttons: ['excel', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });

        var currentZoom = 1;
        var pointerOffsetX = 0;
        var pointerOffsetY = 0;

        function tampilkanGambar(namaGambar) {
            var gambarModal = document.getElementById('gambarModal');
            var gambarPopUp = document.getElementById('gambarPopUp');
            var modalContent = document.querySelector('.modal-content');
            var pagination = document.querySelector('.pagination');

            gambarModal.src = namaGambar;
            currentZoom = 1; // Reset zoom ke 1 saat gambar baru ditampilkan.
            pointerOffsetX = 0;
            pointerOffsetY = 0;

            // Set lebar modal sesuai dengan gambar asli
            var gambarAsli = new Image();
            gambarAsli.src = namaGambar;
            gambarAsli.onload = function() {
                var lebarAsli = this.width;
                modalContent.style.width = lebarAsli + 'px';
                gambarPopUp.style.display = "block";
                // Hide pagination
                pagination.style.display = "none";
            };
        }

        gambarPopUp.addEventListener('click', function(event) {
            if (event.target === gambarPopUp) {
                tutupPopUp();
            }
        });

        function tutupPopUp() {
            var gambarPopUp = document.getElementById('gambarPopUp');
            var pagination = document.querySelector('.pagination');
            gambarPopUp.style.display = "none";
            // Show pagination again
            pagination.style.display = "block";
        }

        gambarModal.addEventListener('click', function(event) {
            if (currentZoom !== 1) {
                // Reset zoom jika saat ini di-zoom
                currentZoom = 1;
                gambarModal.style.transform = 'scale(1)';
            } else {
                // Hitung posisi pointer relatif terhadap gambar
                var gambarRect = gambarModal.getBoundingClientRect();
                pointerOffsetX = (event.clientX - gambarRect.left) / gambarRect.width;
                pointerOffsetY = (event.clientY - gambarRect.top) / gambarRect.height;

                // Zoom dengan faktor 2 (Anda bisa menyesuaikan sesuai kebutuhan)
                currentZoom = 2;
                gambarModal.style.transform = 'scale(2)';
                // Set transform origin sesuai dengan posisi pointer
                gambarModal.style.transformOrigin = (pointerOffsetX * 100) + '% ' + (pointerOffsetY * 100) + '%';
            }
        });

        function tutupPopUp() {
            var gambarPopUp = document.getElementById('gambarPopUp');
            var pagination = document.querySelector('.pagination');
            gambarPopUp.style.display = "none";
            // Show pagination again
            pagination.style.display = "block";
        }
        gambarModal.addEventListener('click', function() {
            gambarModal.classList.toggle('zoomed'); // Aktifkan atau nonaktifkan zoom.
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