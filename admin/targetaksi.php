<?php
$pageTitle = "Tambah Data Target";
include '../assets/layouts/sidebar.php';

$kd_akun = isset($_GET['kd_akun']) ? $_GET['kd_akun'] : '';

if (!isset($_SESSION['kd_akun_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        $kd_akun_user = $_SESSION['kd_akun_user'];
        $tanggal_dipilih = date('Y-m-d');

        $alert_message = "Isi Data Target";
?>

        <style>
            .row {
                width: 100%;
            }
        </style>

        <body class="g-sidenav-show bg-gray-200">
            <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card my-4">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                        <h6 class="text-white text-capitalize ps-3">
                                            <center>
                                                <?php if (isset($alert_message)) {
                                                    echo '<div ">' . $alert_message . '</div>';
                                                } ?>
                                            </center>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="card-body pt-0 mt-0">
                                        <form class="myForm" action="targetproses.php?proses=prosestambah" method="post" enctype="multipart/form-data" autocomplete="off" required>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Tanggal Awal</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Tanggal Akhir</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="date" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3" hidden>
                                                <label for="kd_akun">Akun Tujuan</label>
                                                <div class="input-group">
                                                    <input type="hidden" name="kd_akun" class="form-control" value="<?php echo $kd_akun; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">ID Pelanggan</label>
                                                <p style="font-size: 10px; color: red;"><i>*Mohon isi ID pelanggan dengan benar</i></p>
                                                <div class="input-group">
                                                    <input type="text" name="idpel" class="form-control" value="" placeholder="Masukkan ID Pelanggan Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" required>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Nama Pelanggan</label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_pel" class="form-control" value="" placeholder="Masukkan Nama Pelanggan" required minlength="2">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="kd_akun">Rute Meter</label>
                                                <div class="input-group">
                                                    <input type="text" name="rbm" class="form-control" placeholder="Masukkan Rute">
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Tipe Pembayaran</label>
                                                <div class="input-group">
                                                    <select name="tipe" id="" class="form-control" required>
                                                        <option value="">Pilih Opsi</option>
                                                        <option value="Pascabayar">Pascabayar</option>
                                                        <option value="Prabayar">Prabayar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Alamat</label>
                                                <div class="input-group">
                                                    <input type="text" name="alamat" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3" hidden>
                                                <label for="kd_akun">Status</label>
                                                <div class="input-group">
                                                    <input type="number" name="status" value="0" class="form-control">
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Lokasi</label>
                                                <div class="input-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="text" name="latitude" class="form-control" value="" placeholder="Garis Lintang">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="longitude" class="form-control" value="" placeholder="Garis Bujur">
                                                        </div>
                                                    </div>
                                                    <span class="input-group-addon"><i class="bi bi-geo-alt"></i></span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <a href="pelangganinput.php" class="btn btn-primary">Kembali</a>
                                                <button type="submit" class="btn btn-success" name="submit" onclick="confirmSubmit()">Submit</button>
                                            </div>
                                        </form>
                                        <script type="text/javascript">
                                            function toggleDayaInput() {
                                                var dayaSelect = document.getElementById('dayaSelect');
                                                var dayaInput = document.getElementById('dayaInput');
                                                dayaInput.disabled = (dayaSelect.value !== "");
                                            }
                                            document.addEventListener('DOMContentLoaded', function() {
                                                toggleDayaInput();
                                            });


                                            function confirmSubmit() {
                                                if (confirm('Yakin data sudah benar?')) {
                                                    document.querySelector('.myForm').submit();
                                                } else {
                                                    // Tidak melakukan apa-apa jika pengguna membatalkan
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </body>
    <?php } elseif ($_GET['aksi'] == 'ubah') { ?>

        <style>
            .row {
                width: 100%;
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
                                        <h6 class="text-white text-capitalize ps-3">
                                            <center>
                                                Form Pelanggan Ubah
                                            </center>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="card-body">
                                        <?php
                                        $data = $db->query("SELECT * From tbl_target where idpel='$_GET[kode]'");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                            <form class="formedit" action="targetproses.php?proses=ubah&kode=<?php echo $d['idpel']; ?>" method="post" enctype="multipart/form-data" required>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Tanggal Awal</label>
                                                        <div class="input-group input-group-outline">
                                                            <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Tanggal Akhir</label>
                                                        <div class="input-group input-group-outline">
                                                            <input type="date" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="kd_akun">Akun Tujuan</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kd_akun" class="form-control" value="<?php echo $d['kd_akun']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">ID Pelanggan</label>
                                                    <p style="font-size: 10px; color: red;"><i>*Mohon isi ID pelanggan dengan benar</i></p>
                                                    <div class="input-group">
                                                        <input type="text" name="idpel" class="form-control" value="<?php echo $d['idpel'] ?>" placeholder="Masukkan ID Pelanggan Minimal 11 digit" required autofocus min="10" maxlength="12">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Nama Pelanggan</label>
                                                    <div class="input-group">
                                                        <input type="text" name="nama_pel" class="form-control" value="<?php echo $d['nama_pel'] ?>" placeholder="nama pelanggan" required minlength="2">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Rute Meter</label>
                                                    <div class="input-group">
                                                        <input type="text" name="rbm" value="<?php echo $d['rbm'] ?>" class="form-control" placeholder="Masukkan Rute" maxlength="13">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Tipe Pembayaran</label>
                                                    <div class="input-group">
                                                        <select name="tipe" id="" class="form-control" required>
                                                            <option value="<?php echo $d['tipe'] ?>"><?php echo $d['tipe'] ?></option>
                                                            <option value="Pascabayar">Pascabayar</option>
                                                            <option value="Prabayar">Prabayar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Alamat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="alamat" value="<?php echo $d['alamat'] ?>" class="form-control" placeholder="" maxlength="100">
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3" hidden>
                                                    <label for="kd_akun">Status</label>
                                                    <div class="input-group">
                                                        <input type="number" name="status" value="0" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Lokasi</label>
                                                    <div class="input-group">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <td><input type="text" name="latitude" class="form-control" value="<?php echo $d['latitude'] ?>"></td>
                                                            </div>
                                                            <div class="col-6">
                                                                <td><input type="text" name="longitude" class="form-control" value="<?php echo $d['longitude'] ?>"></td>
                                                            </div>
                                                        </div>
                                                        <span class="input-group-addon"><i class="bi bi-geo-alt"></i></span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="targetinput.php" class="btn btn-primary">Kembali</a>
                                                    <button type="submit" class="btn btn-success" name="submit" onclick="confirmUpdate()">Submit</button>
                                                </div>
                                            </form>
                                            <script>
                                                function confirmUpdate() {
                                                    if (confirm('Yakin data sudah benar?')) {
                                                        document.querySelector('form').submit();
                                                    } else {}
                                                }
                                            </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </body>
    <?php } ?>
<?php
    }
}
?>