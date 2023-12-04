<?php
include '../assets/layouts/sidebar.php';

$jumlah_target = 0;
$jumlah_target2 = 0;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    $query = $db->query("SELECT nama_lengkap, level, foto FROM tbl_akun WHERE username='$username'");
    $data = $query->fetch_assoc();
    $nama_lengkap = $data['nama_lengkap'];
    $welcome_message = "Dashboard";
    $imagePath = $data['foto'];
    $fotoProfilPath = '../assets/img/' . $imagePath;

    if ($level == '0') {
        $queryTarget = $db->query("SELECT COUNT(*) as jumlah_target FROM tbl_pelanggan");
        $dataTarget = $queryTarget->fetch_assoc();
        $jumlah_target = $dataTarget['jumlah_target'];

        $queryTarget2 = $db->query("SELECT COUNT(*) as jumlah_target2 FROM tbl_target where status='0'");
        $dataTarget2 = $queryTarget2->fetch_assoc();
        $jumlah_target2 = $dataTarget2['jumlah_target2'];

        $queryTarget3 = $db->query("SELECT COUNT(*) as jumlah_akun FROM tbl_akun WHERE level='1'");
        $dataTarget3 = $queryTarget3->fetch_assoc();
        $jumlah_target3 = $dataTarget3['jumlah_akun'];

        $nama = "$nama_lengkap";
        $role = "$level";
    }
} else {
    header("location: ../index.php");
    exit();
}
?>

<style>
    .container-xl {
        max-width: 1705px;
    }

    .list-group {
        border: none;
    }

    .list-group-item {
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-item a {
        font-weight: bold;
    }

    .card {
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        margin-bottom: 1rem;
        border-radius: 10px;
    }

    .card2 {
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        margin-bottom: 1rem;
        border-radius: 10px;
    }

    .card2-title {
        float: left;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }

    .card-title {
        float: left;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }

    .inner {
        padding: 10px;
        border-radius: 10px;
    }

    .inner2 {
        text-align: center;
        align-items: center;
        padding: 2px;
        border-radius: 10px;
        color: whitesmoke;
    }

    .icon-right {
        display: flex;
        justify-content: flex-end;
        font-size: 50px;
        align-items: center;
    }
</style>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb px-2 pt-2">
            <h3><?php echo $welcome_message; ?></h3>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang <?php echo $data['nama_lengkap']; ?>(
                        <?php
                        if ($data['level'] == 0) {
                            echo "Admin";
                        } else {
                            echo "";
                        }
                        ?> </td>)</h3>
                </div>
                <div class="card-body">
                    <h3>Data Saat Ini</h3>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="inner bg-info">
                                    <h4><?php echo $jumlah_target; ?></h4>
                                    <div class="icon-right"><i class="fas fa-user-check"></i></div>
                                    <p>Pelanggan</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="inner bg-danger">
                                    <h4><?php echo $jumlah_target2; ?></h4>
                                    <div class="icon-right"><i class="fas fa-user-clock"></i></div>
                                    <p>Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card">
                                <div class="inner bg-warning">
                                    <h4><?php echo $jumlah_target3; ?></h4>
                                    <div class="icon-right"><i class="fas fa-users"></i></div>
                                    <p>Petugas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card2">
                                <div class="inner2 bg-info">
                                    <p id="real-time-date"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../assets/footer.php'; ?>