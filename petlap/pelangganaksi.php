<?php
$pageTitle = "Tambah Data Pelanggan";
include '../assets/layouts/sidebar.php';

if (!isset($_SESSION['kd_akun_user'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        $kd_akun_user = $_SESSION['kd_akun_user'];
        $tanggal_dipilih = $_GET['tanggal_dipilih'];

        $alert_message = "Mohon untuk Mengaktifkan Location dan Membuka Aplikasi Gmaps Terlebih Dahulu Agar Memperkuat Akurasi Titik Koordinat!";

        $idpelanggan = $_GET['idpel_target']; // Anda sudah mengambilnya dari $_GET

        // Lakukan kueri ke database
        $query = "SELECT * FROM tbl_target WHERE idpel_target = '$idpelanggan'";
        $result = mysqli_query($db, $query);
?>

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
                                                <?php
                                                if (isset($alert_message)) {
                                                    echo '<div ">' . $alert_message . '</div>';
                                                }

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $nama_pel = $row['nama_pel'];
                                                    $tipe_pembayaran = $row['tipe'];
                                                    $alamat = $row['alamat'];
                                                ?>
                                            </center>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="card-body pt-0 mt-0">
                                        <form class="myForm" action="pelangganproses.php?proses=prosestambah" method="post" enctype="multipart/form-data" autocomplete="off" required>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Tanggal</label>
                                                <div class="input-group">
                                                    <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">ID Pelanggan</label>
                                                <p style="font-size: 10px; color: red;"><i>*Mohon isi ID pelanggan dengan benar</i></p>
                                                <div class="input-group">
                                                    <input type="text" name="idpel" class="form-control" value="<?php echo isset($_GET['idpel_target']) ? htmlspecialchars($_GET['idpel_target']) : ''; ?>" placeholder="Masukkan ID Pelanggan Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" required>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Nama Pelanggan</label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_pel" class="form-control" value="<?php echo $nama_pel; ?>" placeholder="Masukkan Nama Pelanggan" required minlength="2" maxlength="50">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="">Daya (VA)</label>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline">
                                                        <select name="daya_select" id="dayaSelect" class="form-control" onchange="toggleDayaInput()">
                                                            <option value="" selected>Pilih Opsi</option>
                                                            <option value="450">450</option>
                                                            <option value="900">900</option>
                                                            <option value="1300">1300</option>
                                                            <option value="2200">2200</option>
                                                            <option value="3500">3500</option>
                                                            <option value="4400">4400</option>
                                                            <option value="5500">5500</option>
                                                            <option value="6600">6600</option>
                                                            <option value="7700">7700</option>
                                                            <option value="7700">9000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" class="form-control" name="daya_input" id="dayaInput" placeholder="Masukkan Jika Tidak Ada Pilihan Daya" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Tipe Pembayaran</label>
                                                <div class="input-group">
                                                    <select name="tipe" id="" class="form-control" required>
                                                        <option value="">Pilih Opsi</option>
                                                        <option value="Pascabayar" <?php if ($tipe_pembayaran == 'Pascabayar') echo 'selected'; ?>>Pascabayar</option>
                                                        <option value="Prabayar" <?php if ($tipe_pembayaran == 'Prabayar') echo 'selected'; ?>>Prabayar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Alamat</label>
                                                <div class="input-group">
                                                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan Type kWh Meter" value="<?php echo $alamat; ?>" maxlength="100" require>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Foto Meter</label>
                                                <div class="input-group">
                                                    <input type="file" name="pmet" class="form-control" value="" required>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3" hidden>
                                                <tr>
                                                    <td><input type="text" name="latitude" class="form-control" value=""></td>
                                                    <td><input type="text" name="longitude" class="form-control" value=""></td>
                                                </tr>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Merk kWh Meter</label>
                                                <div class="input-group">
                                                    <select name="merk" class="form-control" required>
                                                        <option value="">Pilih Opsi</option>
                                                        <option value="SMARTMETER">SMARTMETER</option>
                                                        <option value="HEXING">HEXING</option>
                                                        <option value="ITRON">ITRON</option>
                                                        <option value="MELCOINDA">MELCOINDA</option>
                                                        <option value="CANNET">CANNET</option>
                                                        <option value="SANXING">SANXING</option>
                                                        <option value="FUJI">FUJI</option>
                                                        <option value="METBELOSA">METBELOSA</option>
                                                        <option value="WASION">WASION</option>
                                                        <option value="STAR">STAR</option>
                                                        <option value="ACTARIS">ACTARIS</option>
                                                        <option value="EDMI">EDMI</option>
                                                        <option value="SIGMA">SIGMA</option>
                                                        <option value="SCHLUMBERGER">SCHLUMBERGER</option>
                                                        <option value="MEISYS">MEISYS</option>
                                                        <option value="SAINT">SAINT</option>
                                                        <option value="MECOINDO">MECOINDO</option>
                                                        <option value="GLOMET">GLOMET</option>
                                                        <option value="LIPUVINDO">LIPUVINDO</option>
                                                        <option value="LANDISGYR">LANDIS+GYR</option>
                                                        <option value="MITSUBISHI">MITSUBISHI</option>
                                                        <option value="OSAKI">OSAKI</option>
                                                        <option value="SCHNEIDER">SCHNEIDER</option>
                                                        <option value="KRIZIK">KRIZIK</option>
                                                        <option value="GANZ">GANZ</option>
                                                        <option value="LANDIS">LANDIS</option>
                                                        <option value="SGRID">SGRID</option>
                                                        <option value="EMAIL">EMAIL</option>
                                                        <option value="ENERTEC">ENERTEC</option>
                                                        <option value="CHANGSHA">CHANGSHA</option>
                                                        <option value="GALVANIZE">GALVANIZE</option>
                                                        <option value="GE">GE</option>
                                                        <option value="PRODIGY">PRODIGY</option>
                                                        <option value="ELSTER">ELSTER</option>
                                                        <option value="AEG">AEG</option>
                                                        <option value="ADTECH">ADTECH</option>
                                                        <option value="ELIPS SYSTEM">ELIPS SYSTEM</option>
                                                        <option value="METRICO">METRICO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Type kWh Meter</label>
                                                <div class="input-group">
                                                    <input type="text" name="tipemet" class="form-control" placeholder="Masukkan Type kWh Meter" require>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Nomor kWh Meter</label>
                                                <div class="input-group">
                                                    <input type="text" name="nomet" class="form-control" placeholder="Masukkan Nomor Meter Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" require>
                                                </div>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label for="status">Status</label>
                                                <div class="input-group">
                                                    <input type="number" name="status" value="1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Keterangan</label>
                                                    <div class="input-group input-group-outline">
                                                        <select name="ket" class="form-control" required>
                                                            <option value="">Pilih opsi</option>
                                                            <option value="macet">macet</option>
                                                            <option value="Tinggi">Tinggi</option>
                                                            <option value="Buram">Buram</option>
                                                            <option value="Normal">Normal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Rincian</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="ket2" class="form-control" placeholder="Masukkan Jika Ada Keterangan Lebih Lanjut">
                                                    </div>
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="">kode_akun</label>
                                                    <input type="text" name="kd_akun" class="form-control" value="<?php echo $kd_akun_user; ?>" readonly>
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

                                            function getLocation() {
                                                if (navigator.geolocation) {
                                                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                                                }
                                            }

                                            function showPosition(position) {
                                                document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
                                                document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
                                            }
                                            window.onload = getLocation;

                                            function showError(error) {
                                                switch (error.code) {
                                                    case error.PERMISSION_DENIED:
                                                        alert("aktifkan location");
                                                        location.reload();
                                                        break;

                                                    default:
                                                        break;
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
    <?php } ?>
<?php
    }
}
?>