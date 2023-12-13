<?php
$pageTitle = "Dashboard";
include '../assets/layouts/sidebar_petlap.php';

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

        $previousWeekStart = date('Y-m-d', strtotime('-1 week', strtotime('last Sunday')));
        $previousWeekEnd = date('Y-m-d', strtotime('-1 day', strtotime('this Sunday')));

        $queryPreviousWeek = $db->query("SELECT COUNT(*) as jumlah_perbandingan FROM tbl_target WHERE status='0' AND tanggal BETWEEN '$previousWeekStart' AND '$previousWeekEnd'");
        $dataPreviousWeek = $queryPreviousWeek->fetch_assoc();
        $jumlah_perbandingan = $dataPreviousWeek['jumlah_perbandingan'];

        if ($jumlah_perbandingan > 0) {
            $percentageDifference = (($jumlah_target - $jumlah_perbandingan) / $jumlah_perbandingan) * 100;
        } else {
            $percentageDifference = 0;
        }

        $previousDay = date('Y-m-d', strtotime('-1 day'));
        $queryPreviousDay = $db->query("SELECT COUNT(*) as jumlah_perbandingan2 FROM tbl_target WHERE status='1' AND DATE(tanggal) = '$previousDay'");
        $dataPreviousDay = $queryPreviousDay->fetch_assoc();
        $jumlah_perbandingan2 = $dataPreviousDay['jumlah_perbandingan2'];

        if ($jumlah_perbandingan2 > 0) {
            $percentageDifference2 = (($jumlah_target - $jumlah_perbandingan2) / $jumlah_perbandingan2) * 100;
        } else {
            $percentageDifference2 = 0;
        }
        $nama = "$nama_lengkap";
        $role = "$level";
    }
} else {
    header("location: ../index.php");
    exit();
}
?>

<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4 mb-4">
            <div class="row">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">groups</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Petugas</p>
                                <h4 class="mb-0"><?php echo $jumlah_target3; ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">pending</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Pending</p>
                                <h4 class="mb-0"><?php echo $jumlah_target2; ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="<?php echo ($percentageDifference >= 0) ? 'text-success' : 'text-danger'; ?> text-sm font-weight-bolder">
                                    <?php echo ($percentageDifference >= 0) ? '+' : ''; ?><?php echo number_format($percentageDifference, 2); ?>%
                                </span>
                                than the previous month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">check</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Success</p>
                                <h4 class="mb-0"><?php echo $jumlah_target; ?></h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="<?php echo ($percentageDifference2 >= 0) ? 'text-success' : 'text-danger'; ?> text-sm font-weight-bolder">
                                    <?php echo ($percentageDifference2 >= 0) ? '+' : ''; ?><?php echo number_format($percentageDifference2, 2); ?>%
                                </span>
                                than the previous week
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php
    include '../assets/layouts/setting.php'
    ?>

    <?php
    include '../assets/layouts/footer.php'
    ?>
</body>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
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