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

        $alert_message = "Mohon untuk Mengaktifkan Location dan Membuka Aplikasi Gmaps Terlebih Dahulu Agar Memperkuat Akurasi Titik Koordinat!";
?>

        <style>
            .form-group {
                margin-top: 10px;

            }

            .container-xl {
                max-width: 1705px;
                /* Atur lebar maksimum kontainer sesuai dengan preferensi Anda */
            }

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
                                    <div class="card-body">
                                        <form class="myForm" action="pelangganproses.php?proses=prosestambah" method="post" enctype="multipart/form-data" autocomplete="off" required>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Tanggal</label>
                                                <div class="input-group">
                                                    <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Tanggal</label>
                                                <div class="input-group">
                                                    <input type="date" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
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
            .form-group {
                margin-top: 10px;

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
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
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
                                        $data = $db->query("SELECT * From tbl_pelanggan where idpel='$_GET[kode]'");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                            <form action="pelangganproses.php?proses=ubah&kode=<?php echo $d['idpel']; ?>" method="post" enctype="multipart/form-data">
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
                                                <div class="row">
                                                    <label for="">Daya (VA)</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" value="<?php echo $d['daya'] ?>" name="daya" id="" class="form-control">
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
                                                <div class="form-group" hidden>
                                                    <label for="">Lokasi</label>
                                                    <tr>
                                                        <td><input type="text" name="latitude" class="form-control" value="<?php echo $d['latitude'] ?>"></td>
                                                        <td><input type="text" name="longitude" class="form-control" value="<?php echo $d['longitude'] ?>"></td>
                                                    </tr>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Foto Meter</label>
                                                    <div class="input-group">
                                                        <img src="../assets/img/datpel/<?php echo $d['pmet']; ?>" style="width: 70px; height: 100px">
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="file" name="pmet" class="form-control" value="<?php echo $d['pmet'] ?>">
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Merk kWh Meter</label>
                                                    <div class="input-group">
                                                        <select name="merk" class="form-control" required>
                                                            <option value="<?php echo $d['merk'] ?>"><?php echo $d['merk'] ?></option>
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
                                                        <input type="text" name="tipemet" class="form-control" value="<?php echo $d['tipemet'] ?>" placeholder="Masukkan Type kWh Meter" require>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Nomor kWh Meter</label>
                                                    <div class="input-group">
                                                        <input type="text" name="nomet" class="form-control" value="<?php echo $d['nomet'] ?>" placeholder="Masukkan Nomor Meter Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" require>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Keterangan</label>
                                                        <div class="input-group input-group-outline">
                                                            <select name="ket" class="form-control" required>
                                                                <option value="<?php echo $d['ket'] ?>"> <?php echo $d['ket'] ?></option>
                                                                <option value="macet">macet</option>
                                                                <option value="Tinggi">Tinggi</option>
                                                                <option value="Buram">Buram</option>
                                                                <option value="Normal">Normal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Rincian</label>
                                                        <div class="input-group input-group-outline">
                                                            <input type="text" name="ket2" class="form-control" value="<?php echo $d['ket2'] ?>" placeholder="Masukkan Jika Ada Keterangan Lebih Lanjut">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="">kode_akun</label>
                                                    <input type="text" name="kd_akun" class="form-control" value="<?php echo $kd_akun_user; ?>" readonly>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="pelangganinput.php" class="btn btn-primary">Kembali</a>
                                                    <button type="submit" class="btn btn-success" name="submit" onclick="confirmSubmit()">Submit</button>
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