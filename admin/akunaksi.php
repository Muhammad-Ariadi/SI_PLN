<?php
$pageTitle = "Tambah Petugas";
include '../assets/layouts/sidebar.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
?>
        <?php
        $carikode = $db->query("SELECT max(kd_akun) FROM tbl_akun");
        while ($datakode = mysqli_fetch_array($carikode, MYSQLI_BOTH)) {
            if ($datakode) {
                $nilaikode = substr($datakode[0], 1);
                $kode = (int) $nilaikode;
                $kode = $kode + 1;
                $kode_otomatis = "A" . str_pad($kode, 2, "0", STR_PAD_LEFT);
            } else {
                $kode_otomatis = "A01";
            }
        } ?>

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
                                                Form Akun Baru
                                            </center>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="card-body">
                                        <form action="akunproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Kode Akun</label>
                                                <div class="input-group">
                                                    <input type="lock" name="kd_akun" readonly class="form-control" value="<?php echo $kode_otomatis ?>">
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Nama Lengkap</label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_lengkap" class="form-control" value="" placeholder="nama lengkap" required>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Foto Profil</label>
                                                <div class="input-group">
                                                    <input type="file" name="foto" class="form-control" value="" required>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Username</label>
                                                <div class="input-group">
                                                    <input type="text" name="username" class="form-control" value="" placeholder="username" required>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="password" class="form-control" value="" placeholder="password">
                                                </div>
                                            </div>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="">Role</label>
                                                <div class="input-group">
                                                    <select name="level" id="" class="form-control" required>
                                                        <option value="">-</option>
                                                        <option value="0" <?php if ($_SESSION['level'] == 0) echo 'selected'; ?>>Admin</option>
                                                        <option value="1" <?php if ($_SESSION['level'] == 1) echo 'selected'; ?>>Petugas Lapangan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="akuninput.php" class="btn btn-primary">Kembali</a>
                                                <input type="submit" class="btn btn-success" value="Simpan">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </body>
    <?php } elseif ($_GET['aksi'] == 'ubah') { ?>


        <body class="g-sidenav-show bg-gray-200">
            <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
                <?php
                $data = $db->query("SELECT * From tbl_akun where kd_akun='$_GET[kode]'");
                while ($d = mysqli_fetch_array($data)) {
                ?>
                    <div class="container-fluid py-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card my-4">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                            <h6 class="text-white text-capitalize ps-3">
                                                <center>
                                                    Form Akun Ubah
                                                </center>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pb-2">
                                        <div class="card-body">
                                            <form action="akunproses.php?proses=ubah" method="post" enctype="multipart/form-data">
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Kode Akun</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kd_akun" class="form-control" readonly value="<?php echo $d['kd_akun'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Nama Lengkap</label>
                                                    <div class="input-group">
                                                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $d['nama_lengkap'] ?>" placeholder="nama lengkap" required>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Foto Profil</label>
                                                    <div class="input-group">
                                                        <img src="../assets/img/akun/<?php echo $d['foto']; ?>" style="width: 70px; height: 100px">
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="file" name="foto" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Username</label>
                                                    <div class="input-group">
                                                        <input type="text" name="username" class="form-control" value="<?php echo $d['username'] ?>" placeholder="username" required>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password" class="form-control" value="" placeholder="password">
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="">Role</label>
                                                    <div class="input-group">
                                                        <select name="level" id="" class="form-control" required>
                                                            <?php
                                                            $role = ($d['level'] == 0) ? 'Admin' : (($d['level'] == 1) ? 'Petugas Lapangan' : $d['level']);
                                                            ?>
                                                            <option value="<?php echo $d['level'] ?>"><?php echo $role ?></option>
                                                            <option value="0">Admin</option>
                                                            <option value="1">Petugas Lapangan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="akuninput.php" class="btn btn-primary">Kembali</a>
                                                    <input type="submit" class="btn btn-success" value="Simpan">
                                                </div>
                                            </form>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </body>
<?php
    }
}
?>