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
                                        <a href="excel.php" target="_blank">
                                            <button class="btn btn-success">Excel</button>
                                        </a>
                                        <!-- <button class="btn btn-success ml-2" onclick="openImportPopup()">Import Data</button> -->
                                    </div>
                                </div>
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">NAMA</th>
                                            <th class="text-center">DAYA</th>
                                            <th class="text-center">PEMBAYARAN</th>
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">LOKASI</th>
                                            <th class="text-center">FOTO</th>
                                            <th class="text-center">MERK</th>
                                            <th class="text-center">TIPE</th>
                                            <th class="text-center">NOMOR METER</th>
                                            <th class="text-center">KETERANGAN</th>
                                            <th class="text-center">RINCIAN</th>
                                            <th class="text-center">OPSI</th>
                                        </tr>
                                    </thead>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        while ($d = $tampil->fetch_array()) {
                                        ?>
                                            <tr class=" text-center">
                                                <td style="max-width: 120px; white-space: normal; ">
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
                                                <td style="max-width: 100px; white-space: normal;">
                                                    <?php echo $d['alamat'] ?>
                                                </td>

                                                <td class="text-center">
                                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                                </td>

                                                <td class="text-center">
                                                    <a href="#">
                                                        <img src="../assets/img/datpel/<?php echo $d['pmet']; ?>" style="width: 50px; height: 100px" onclick="openModal('../assets/img/datpel/<?php echo $d['pmet']; ?>')">
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

                                                <td style="max-width: 100px; white-space: normal;">
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
        <!-- modal -->
        <div id="myModal" class="modal" onclick="closeModal()">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Bukti Dokumentasi</h3>
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <img id="gambarModal" src="" alt="Zoomed Image" class="w-100">
                </div>
            </div>
        </div>
    </main>
</body>
<?php
include '../assets/layouts/setting.php'
?>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['colvis'],
            language: {
                paginate: {
                    previous: '‹',
                    next: '›'
                },
                aria: {
                    paginate: {
                        previous: 'Previous',
                        next: 'Next'
                    }
                }
            }

        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });

    function hapusData(idpelanggan) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'pelangganproses.php?kode=' + idpelanggan + '&proses=proseshapus';
        }
    }

    // Modal Gambar 
    var clickPosition = {
        x: 0,
        y: 0
    };

    function openModal(imageSrc) {
        var modal = document.getElementById("myModal");
        var img = document.getElementById("gambarModal");
        img.src = imageSrc;
        modal.style.display = "block";
        img.classList.remove("zoomed");
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    // Menutup modal saat pengguna mengklik area di luar modal
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };


    document.getElementById("gambarModal").addEventListener("click", function(event) {
        var img = document.getElementById("gambarModal");

        // Memeriksa apakah yang diklik adalah gambar, jika ya, lakukan zoom
        if (event.target.tagName === 'IMG') {
            img.classList.toggle("zoomed");
        }

        // Menghentikan event propagation agar modal tidak tertutup oleh event klik ini
        event.stopPropagation();
    });
</script>

  <!-- Core JS Files   -->
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

<!-- <?php
include '../assets/layouts/footer.php'
?> -->