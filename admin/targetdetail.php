<?php
$pageTitle = "Data Detail Target";
include '../assets/layouts/sidebar.php';


if (!isset($_SESSION['kd_akun_user'])) {

    header("Location: login.php");
    exit();
}

$kd_akun_user = $_SESSION['kd_akun_user'];
$kd_akun = $_GET['kd_akun']; // Ambil nilai kd_akun dari URL

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
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                            $hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun' order by status='1'";
                                            $tampil = mysqli_query($db, $hasil);

                                            while ($db = $tampil->fetch_array()) {
                                            ?>
                                            <tr class=" text-center">
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
</body>

<script>
    function hapusData(idpelanggan) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'targetproses.php?kode=' + idpelanggan + '&proses=proseshapus';

        }
    }
</script>