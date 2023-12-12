<?php
$pageTitle = "Pelanggan";
include '../assets/layouts/sidebar.php';


if (!isset($_SESSION['kd_akun_user'])) {
    // Jika tidak, mungkin redirect ke halaman login atau lakukan tindakan lain
    header("Location: login.php");
    exit();
}

// Ambil kd_akun_user dari sesi
$kd_akun_user = $_SESSION['kd_akun_user'];

// Inisialisasi tanggal hari ini jika tidak ada tanggal yang dipilih
if (isset($_POST['tanggal'])) {
    $_SESSION['tanggal_dipilih'] = $_POST['tanggal'];
} else if (!isset($_SESSION['tanggal_dipilih'])) {
    $_SESSION['tanggal_dipilih'] = date('Y-m-d');
}

$tanggal_dipilih = $_SESSION['tanggal_dipilih'];

$query_hitung_data_input = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_dipilih' AND kd_akun = '$kd_akun_user'";
$result_hitung_data_input = mysqli_query($db, $query_hitung_data_input);
$data_hitung_input = mysqli_fetch_assoc($result_hitung_data_input);
$jumlah_data = $data_hitung_input['jumlah_data'];


// Hitung jumlah total data yang akan ditampilkan
$query_total_data = "SELECT COUNT(*) as total_data FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND ('$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir)";
$result_total_data = mysqli_query($db, $query_total_data);
$data_total = mysqli_fetch_assoc($result_total_data);
$total_data = $data_total['total_data'];

// Tentukan jumlah data per halaman
$data_per_page = 1;

// Hitung jumlah halaman yang dibutuhkan
$total_pages = ceil($total_data / $data_per_page);

// Dapatkan nomor halaman yang sedang aktif dari parameter URL
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Sesuaikan query untuk mengambil data dengan memperhitungkan halaman yang sedang aktif
$offset = ($current_page - 1) * $data_per_page;
$hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND ('$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir) AND status = 0 LIMIT $data_per_page OFFSET $offset";

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
                                <h6 class="text-white text-capitalize ps-3">INPUT DATA PELANGGAN</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="pelangganaksi2.php?aksi=tambah&kd_akun_user=<?php echo $kd_akun_user; ?>&tanggal_dipilih=<?php echo $tanggal_dipilih; ?>" class="btn btn-primary" id="button_target">Tambah Data</a>
                                    </div>
                                    <form method="post">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="tanggal">Pilih Tanggal: </label>
                                            <div class="input-group">
                                                <div class="row">
                                                    <div class="col"><input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
                                                        <input type="hidden" name="pilih_tanggal" value="1">
                                                    </div>
                                                    <div class="col"><button type="submit" class="btn btn-success">Pilih</button></div>
                                                </div>

                                            </div>

                                    </form>
                                </div>
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">ID PELANGGAN</th>
                                            <th class="text-center">RBM</th>
                                            <th class="text-center">MAPS</th>
                                        </tr>
                                    </thead>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        while ($d = $tampil->fetch_array()) {
                                        ?>
                                            <tr class=" text-center">
                                                <td class="text-center"><?php echo $counter; ?></td>
                                                <td class="text-center">
                                                    <a href="pelangganaksi.php?aksi=tambah&kd_akun_user=<?php echo $kd_akun_user; ?>&tanggal_dipilih=<?php echo $tanggal_dipilih; ?>&idpel=<?php echo $d['idpel']; ?>"><?php echo $d['idpel']; ?></a>
                                                </td>
                                                <td class="text-center"><?php echo $d['rbm']; ?></td>
                                                <td class="text-center">
                                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
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
                buttons: ['colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });

        function hapusData(idpelanggan) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'pelangganproses.php?kode=' + idpelanggan + '&proses=proseshapus';
            }
        }

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