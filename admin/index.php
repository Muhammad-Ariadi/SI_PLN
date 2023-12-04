<?php
$pageTitle = "Dashboard";
include '../assets/layouts/sidebar.php';

$jumlah_target = 0;
$jumlah_target2 = 0;
$jumlah_target3 = 0;

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

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Pelanggan</p>
                        <h4 class="mb-0"><?php echo $jumlah_target; ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">New Clients</p>
                        <h4 class="mb-0"><?php echo $jumlah_target2; ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Sales</p>
                        <h4 class="mb-0"><?php echo $jumlah_target3; ?></h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
    </div>
</div>